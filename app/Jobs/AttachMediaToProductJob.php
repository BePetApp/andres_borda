<?php

namespace App\Jobs;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class AttachMediaToProductJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Product that files will be attached to
     */
    protected $product;
    protected $gallery;
    protected $cover;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
        $this->cover   =  Storage::files('products/cover');
        $this->gallery =  Storage::files('products/gallery');
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if (count($this->cover)) {
            $this->product
               ->addMedia(Storage::path($this->cover[0]))
                ->toMediaCollection('cover');
        }

        foreach ($this->gallery as $photo) {
            $this->product
                ->addMedia(Storage::path($photo))
                ->toMediaCollection('gallery');
        };
    }
}
