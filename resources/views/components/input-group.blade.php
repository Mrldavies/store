<div class="my-3">
    <x-input-label for="{{ $name }}" :value="$label" />
    <x-text-input id="{{ $name }}" class="block mt-3 w-full" type="{{ $type }}" name="{{ $name }}" :value="$value" autofocus />
    @if($instructions)
        <span class="block font-medium text-sm text-gray-400">{{ $instructions }}</span>
    @endif
    <x-input-error :messages="$errors->get($name)" class="mt-2" />
</div>