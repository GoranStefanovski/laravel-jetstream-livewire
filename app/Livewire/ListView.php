<?php

namespace App\Livewire;

use App\Models\Item;
use Livewire\Component;
use Illuminate\Support\Facades\Session;

class ListView extends Component
{
    public $items = [];
    public $search = '';
    public $suggestions = [];

    public function updatedSearch()
    {
        if (!empty($this->search)) {
            $this->suggestions = Item::where('name', 'like', '%' . $this->search . '%')->get()->toArray();
        } else {
            $this->suggestions = [];
        }
    }

    public function addToCart($itemId)
    {
        $item = Item::find($itemId);
        if (!$item) {
            return;
        }

        $cart = Session::get('cart', []);

        if (isset($cart[$itemId])) {
            $cart[$itemId]['quantity']++;
        } else {
            $cart[$itemId] = [
                'id' => $item->id,
                'name' => $item->name,
                'price' => $item->price ?? 0,
                'quantity' => 1,
                'image' => $item->image->image_path ?? null
            ];
        }

        Session::put('cart', $cart);
        $this->cart = $cart;

        // Dispatch an event to update the cart counter and UI
        $this->dispatch('cartUpdated');
    }

    public function mount()
    {
        $this->items = Item::with('image')->get()->toArray();
    }

    public function render()
    {
        return view('livewire.list-view');
    }
}
