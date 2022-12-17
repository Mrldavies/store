<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product') }} - {{ $product->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <form method="POST" action="{{ route('product.update', ['product' => $product->id]) }}">

                    @method('PUT')
                    @csrf

                    <x-accordion title="Product">
                        <x-toggle label="Enable Product" name="enabled" :checked="$product->checked" :value="1" />
                        <x-input-group label="Name" name="name" :value="$product->name" />
                        <x-input-group label="Price" name="price" :value="$product->price" />
                        <x-input-group label="SKU" name="sku" :value="$product->sku" />
                    </x-accordion>
                    <x-accordion title="Short Description">
                        <textarea name="description">{{ $product->description }}</textarea>
                    </x-accordion>

                    <x-accordion title="Long Description">
                        <x-laraberg name="long_description" id="long-desc" :content="$product->long_description" />
                    </x-accordion>

                    <x-accordion title="Category">
                        <livewire:products.change-category />
                    </x-accordion>

                    <x-accordion title="Stock Management">
                        <x-input-group label="Stock Qty" :value="$product->qty" />
                    </x-accordion>

                    <x-accordion title="Reviews"></x-accordion>

                    <x-accordion title="Product Search">
                        <x-input-group label="Searchable Key Words" instructions="Seperate each search term with a comma." />
                    </x-accordion>

                    <x-primary-button>
                        {{ __('Update Product') }}
                    </x-primary-button>

                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
