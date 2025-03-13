<div class="max-w-xl mx-auto">
    <h2 class="text-2xl font-bold mb-4">Items List</h2>

    <div class="mb-36 relative">
        <input type="text" wire:model.live="search" placeholder="Search items..."
               class="border rounded w-full p-2 mb-2" />

        @if(!empty($search) && count($suggestions) > 0)
            <div class="absolute w-full bg-white border rounded shadow mt-1 z-10">
                <ul>
                    @foreach ($suggestions as $suggestion)
                        <li class="p-2 hover:bg-gray-200 cursor-pointer">
                            {{ $suggestion['name'] }} | ${{ $suggestion['price'] }}
                        </li>
                        <button wire:click="addToCart({{ $suggestion['id'] }})" class="ml-4 bg-blue-500 text-black px-4 py-2 mt-2 rounded">
                            Add to Cart
                        </button>
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
        @if (isSet($items) && $items != [])
            @foreach ($items as $item)
                <li class="mb-2 text-black border-b pb-2 flex items-center">
                    <div class="mb-4">
                        @if ($item['image'])
                            <img src="{{ asset('storage/' . $item['image']['image_path']) }}" class="w-24 h-24 rounded mb-2 max-w-[120px] max-h-[120px]" />
                        @else
                            <p class="text-gray-500">--</p>
                        @endif
                    </div>
                    <div class="ml-12">
                        {{ $item['name'] }}
                    </div>
                    <div class="ml-12">
                        ${{ $item['price'] }}
                    </div>
                    <button wire:click="addToCart({{ $item['id'] }})" class="ml-4 bg-blue-500 text-black px-4 py-2 mt-2 rounded">
                        Add to Cart
                    </button>
                </li>
            @endforeach
        @else
            <p class="text-black">No items found</p>
        @endif
       
    </ul>
</div>
