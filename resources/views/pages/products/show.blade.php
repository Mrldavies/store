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

                <x-accordion title="Product">
                    <label for="foobar1">
                        <span class="block font-medium text-sm text-gray-700">Enable Product</span>
                        <div class="relative mt-3">
                            <input id="foobar1" type="checkbox" class="hidden">
                            <div class="toggle__line w-12 h-6 bg-gray-200 rounded-full shadow-inner"></div>
                            <div class="toggle__dot absolute w-5 h-5 bg-white rounded-full shadow inset-y-0 left-0"></div>
                        </div>
                    </label>

                    <x-input-group label="Name" :value="$product->name" />
                    <x-input-group label="Price" :value="$product->price" type="number" />
                    <x-input-group label="SKU" :value="$product->sku" />

                    </x-accordion>

                    <x-accordion title="Short Description">
                        <x-laraberg name="description" id="short-desc" />
                    </x-accordion>
                    <x-accordion title="Long Description">
                        <x-laraberg name="long_description" id="long-desc" />
                    </x-accordion>

                    <x-accordion title="Category">
                        <livewire:products.change-category :product="$product" />

                    </x-accordion>

                    <x-accordion title="Stock Management">
                        <x-input-group label="Stock Qty" :value="$product->sku" />
                    </x-accordion>

                    <x-accordion title="Reviews">
                    </x-accordion>

                    <x-accordion title="Product Search">
                        <x-input-group label="Searchable Key Words" instructions="Seperate each search term with a comma." />
                    </x-accordion>

                    <x-primary-button>
                        {{ __('Update Product') }}
                    </x-primary-button>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
