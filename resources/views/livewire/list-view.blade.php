<div class="max-w-xl mx-auto">
    <h2 class="text-2xl font-bold mb-4">Items List</h2>

    <div class="mb-36 relative">
        <input type="text" wire:model.live="search" placeholder="Search items..."
               class="border rounded w-full p-2 mb-2" />

        @if(!empty($search) && count($suggestions) > 0)
            <div class="absolute w-full bg-white border rounded shadow mt-1 z-10">
                <ul>
                    @foreach ($suggestions as $suggestion)
                        <li class="p-2 hover:bg-gray-200 cursor-pointer"
                            wire:click="selectSuggestion('{{ $suggestion['name'] }}')">
                            {{ $suggestion['name'] }}
                        </li>
                    @endforeach
                </ul>
            </div>
        @elseif(!empty($search) && count($suggestions) === 0)
            <div class="absolute w-full bg-white border rounded shadow mt-1 z-10 p-2 text-gray-500">
                No results found.
            </div>
        @endif
    </div>

    <ul class="mb-4">
        @if (isSet($items) && $items = [])
            @foreach ($items as $item)
                <li class="mb-2 text-black border-b pb-2">
                    {{ $item['name'] }}
                </li>
            @endforeach
        @else
            <p class="text-black">No items found</p>
        @endif
       
    </ul>
</div>
