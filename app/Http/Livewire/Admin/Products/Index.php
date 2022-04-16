<?php

namespace App\Http\Livewire\Admin\Products;

use App\Jobs\AttachMediaToProductJob;
use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Index extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $maderas;
    public $categories;
    public $focusedProduct;
    public $cover;

    public $dir             = 'asc';
    public $search          = '';
    public $gallery         = [];
    public $perPage         = 10;
    public $orderBy         = 'name';
    public $openEdit        = false;
    public $openDelete      = false;
    public $openGallery     = false;
    public $method          = 'Actualizar';

    public function mount()
    {
        $this->categories = \App\Models\Category::pluck('name', 'id');
        $this->maderas    = \App\Models\WoodType::pluck('name', 'id');
    }

    public function rules()
    {
        return [
            'focusedProduct.name'          => ['required',],
            'focusedProduct.slug'          => ['required', Rule::unique('products', 'slug')->ignore($this->focusedProduct)],
            'focusedProduct.price'         => ['required', 'numeric', 'min:100'],
            'focusedProduct.stock'         => ['required', 'numeric', 'min:0'],
            'focusedProduct.description'   => ['required',],
            'focusedProduct.category_id'   => ['required', 'exists:categories,id'],
            'focusedProduct.wood_type_id'  => ['required', 'exists:wood_types,id'],
        ];
    }

    public function render()
    {
        $products = Product::where('name', 'LIKE', '%' . $this->search . '%')
            ->orderBy($this->orderBy, $this->dir)
            ->paginate($this->perPage);

        return  view('livewire.admin.products.index', [
                    'products'  => $products,
                ])->layout('layouts.admin', [
                    'title'     => 'Productos',
                    'pageName'  => 'Productos'
        ]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function order($field)
    {
        if ($this->orderBy == $field) {
            $this->dir = $this->dir == 'asc' ? 'desc' : 'asc';
        } else {
            $this->orderBy = $field;
            $this->dir = 'asc';
        }
    }

// ------------ Preparacion de los modales -----------
    public function createModal()
    {
        $this->focusedProduct = new Product();
        $this->method         = 'Crear';
        $this->openEdit       = true;
    }

    public function editModal($product_id)
    {
        $this->getFocusProduct($product_id);
        $this->openEdit = true;
    }

    public function deleteModal($product_id)
    {
        $this->getFocusProduct($product_id);
        $this->openDelete = true;
    }

    public function mediaModal($product_id)
    {
        $this->getFocusProduct($product_id);
        $this->focusedProduct->load('media');
        $this->openGallery = true;
    }
// --------------------------------------------------

    public function updateProduct()
    {
        $this->validate();
        try {
            $this->focusedProduct->slug = Str::slug($this->focusedProduct->name);
            $this->validate();
            $this->focusedProduct->save();
            $this->emit('nice', 'Actualizacion hecha correctamente.');
        } catch (\Throwable $th) {
            $this->emit('error', 'Ha ocurrido un error al actualizar. Intenta Luego.');
        }

        $this->resetData();
    }

    public function deleteProduct()
    {
        try {
            $this->focusedProduct->delete();
            $this->emit('nice', 'Eliminacion Correcta!');

        } catch (\Exception $e) {
            $this->emit('error', 'Ha ocurrido un error. Intenta Luego.');
        }
        $this->reset('search');
        $this->resetData();
    }

    public function getFocusProduct($product_id)
    {
        $this->focusedProduct = Product::findOrFail($product_id);
    }

    public function resetData()
    {
        $this->reset(['openEdit', 'openDelete', 'openGallery', 'focusedProduct', 'method', 'cover', 'gallery']);
        $this->resetValidation();
    }

    public function updatedCover()
    {
        $this->validate([
            'cover' => 'image|max:1024|mimes:jpg,jpeg,png', // 1MB Max
        ]);
    }

    public function updatedGallery()
    {
        $this->validate([
            'gallery.*' => 'image|max:1024|mimes:jpg,jpeg,png', // 1MB Max
        ], ['gallery.*.max' => 'Revisa que todas las imagenes pesen menos de 1mb']);
    }


    public function saveGallery()
    {
        try {
            if (! is_null($this->cover)) {
                $this->cover->store('products/cover');
            }
    
            if (count($this->gallery) > 0) {
                foreach ($this->gallery as $image) {
                    $image->store('products/gallery');
                }
            }
            
            AttachMediaToProductJob::dispatch($this->focusedProduct);
            $this->resetData();

            $this->emit('nice', 'Galeria actializada con exito!');
        } catch (\Exception $e) {
            $this->emit('error', 'Ha ocurrido un error. Intenta Luego!');
        }
    }

    public function deleteMedia($mediaId)
    {
        Media::find($mediaId)->delete();
    }
}
