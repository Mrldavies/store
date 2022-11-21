<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Blog') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-6">
                        <x-input-label for="title" :value="__('Title')" />
                        <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" required autofocus />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>
                    <textarea id="blog-content" name="content" hidden></textarea>
                    <script>
                        Laraberg.init('blog-content')
                    </script>

                    <div class="mt-8">
                        <x-primary-button>
                            {{ __('Save as Draft') }}
                        </x-primary-button>

                        <x-primary-button class="ml-3">
                            {{ __('Publish') }}
                        </x-primary-button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
