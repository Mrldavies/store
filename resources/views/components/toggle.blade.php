<label for="{{ $name }}">
    <span class="block font-medium text-sm text-gray-700">{{ $label }}</span>
    <div class="relative mt-3">
        <input id="{{ $name }}" type="checkbox" name="{{ $name }}" value="{{ $value }}" class="hidden" checked="{{ $checked }}">
        <div class="toggle__line w-12 h-6 bg-gray-200 rounded-full shadow-inner"></div>
        <div class="toggle__dot absolute w-5 h-5 bg-white rounded-full shadow inset-y-0 left-0"></div>
    </div>
</label>