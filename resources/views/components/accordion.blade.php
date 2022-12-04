<div>
    <div class="accordion-header cursor-pointer transition flex py-3 my-3 border-b-2 border-bottom items-center">
        <i class="las la-plus-square"></i>
        <x-input-label class="ml-5" :value="$title" />
    </div>

    <div class="accordion-content overflow-hidden max-h-0">
        {!! $slot !!}
    </div>
</div>