<?php

namespace App\Http\Livewire\Products;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Search extends Component
{
    use WithPagination;

    public $perPage = 16;
    public $search;
    public $categories;
    public $wood;
    public $minPrice;
    public $maxPrice;
    public $selected;

    protected $queryString = [
        'search',
        'selected'
    ];

    public function mount()
    {
        $this->categories = \App\Models\Category::all();
        $this->wood       = \App\Models\WoodType::all();
        $this->minPrice   = Product::orderBy('price', 'asc')->first('price')->price;
        $this->maxPrice   = Product::orderBy('price', 'desc')->first('price')->price;

        $this->search   = request('search') ?? '';
        $this->selected = [
            'category' => request('selected.category') ?? '',
            'wood'     => request('selected.wood') ?? '',
            'minPrice' => $this->minPrice,
            'maxPrice' => $this->maxPrice,
        ];;
    }

    public function cleanFilters()
    {
        $this->search   = '';
        $this->selected = [
            'category' => '',
            'wood'     => '',
            'minPrice' => $this->minPrice,
            'maxPrice' => $this->maxPrice,
        ];;
    }

    public function render()
    {
        $products = Product::where('stock', '>', 0)
                ->where('name', 'LIKE', '%'. $this->search .'%')
                ->whereBetween('price', [$this->selected['minPrice'] ?? 0, $this->selected['maxPrice'] ?? $this->maxPrice])
                ->where(function ($q) {
                    if ($this->selected['category'] != '') {
                        $q->where('category_id', 'like', $this->selected['category']);                        
                    }
                    if ($this->selected['wood'] != ''){
                        $q->where('wood_type_id', 'like', $this->selected['wood']);
                    }
                })
                ->with('media')
                ->paginate($this->perPage);

        return view('livewire.products.search', [
            'products' => $products
        ]);
    }
}
