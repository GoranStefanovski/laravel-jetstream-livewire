<div class="max-w-7xl mx-auto py-12">
    <h2 class="text-2xl font-bold mb-4">Shopping Cart</h2>

    @if (empty($cart))
        <p class="text-gray-500">Your cart is empty.</p>
    @else
        <table class="min-w-full bg-white shadow-md rounded">
            <thead>
                <tr class="bg-gray-200 text-gray-700">
                    <th class="py-3 px-4 text-left">Image</th>
                    <th class="py-3 px-4 text-left">Item</th>
                    <th class="py-3 px-4 text-center">Quantity</th>
                    <th class="py-3 px-4 text-center">Price</th>
                    <th class="py-3 px-4 text-center">Total</th>
                    <th class="py-3 px-4 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cart as $item)
                    <tr class="border-b">
                        <td class="py-3 px-4">
                            <img src="{{ asset('storage/' . $item['image']) }}" class="w-12 h-12 rounded" />
                        </td>
                        <td class="py-3 px-4">{{ $item['name'] }}</td>
                        <td class="py-3 px-4 text-center">{{ $item['quantity'] }}</td>
                        <td class="py-3 px-4 text-center">${{ number_format($item['price'], 2) }}</td>
                        <td class="py-3 px-4 text-center">${{ number_format($item['quantity'] * $item['price'], 2) }}</td>
                        <td class="py-3 px-4 text-center">
                            <button wire:click="removeFromCart({{ $item['id'] }})" class="text-red-500 hover:underline">Remove</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">
            <span class="bg-green-500 text-white px-4 py-2 rounded">Total: ${{ number_format($this->getTotal(), 2) }}</span>
        </div>
    
        <div class="mt-4">
            <button wire:click="clearCart" class="bg-red-500 text-white px-4 py-2 rounded">Clear Cart</button>
        </div>
    @endif
</div>
