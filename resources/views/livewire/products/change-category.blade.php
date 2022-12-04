<div class="bg-slate-200 p-3">
    <div class="flex justify-between items-center bg-slate-100 p-4">
        <ul class="flex">
            @foreach($currentCategory as $category)
                <li>{{ $category->name }} 
                    @if(!$loop->last)
                        <span class="px-3">></span>
                    @endif
                </li>
            @endforeach
        </ul>
        <button class="px-2 py-1 bg-blue-700" wire:click="edit">
            <i class="las la-edit text-xl text-white"></i>
        </button>
    </div>

    @if($edit)
        <ul class="bg-slate-100 p-4 mt-3">
            @foreach($categories as $category)
                <li class="border-dashed border-b border-slate-400 py-2">
                    @if($loop->first && $child)
                        <strong>{{ $category->name }}</strong>
                    @else
                        @if($child)
                            <input class="mr-3" wire:click="updateCategory({{ $category->id }})" type="radio" name="category">
                        @endif
                        <a wire:click="childCategory({{ $category->id }})">
                            {{ $category->name }}
                        </a>
                    @endif
                </li>
            @endforeach
        </ul>
        <button class="text-blue-500 bg-slate-100 px-4 py-2 mt-3 w-full block text-left" wire:click="resetTree">Back</button>
    @endif
</div>
