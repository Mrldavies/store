<?php

namespace App\Observers;

use App\Models\Product;

class ProductObserver
{
    /**
     * Handle the Product "created" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function created(Product $product)
    {
        //
    }

    /**
     * Listen to the Product "updating" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function updating(Product $product)
    {

        if ($product->price !== $product->getOriginal('price')) {
            $product->priceHistory()->create([
                'price' => $product->getOriginal('price')
            ]);
        }
    }

    /**
     * Handle the Product "updated" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function updated(Product $product)
    {
        //
    }

    /**
     * Handle the Product "deleted" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function deleted(Product $product)
    {
        //
    }
}
