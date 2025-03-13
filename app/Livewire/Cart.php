<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Session;
use App\Models\Item;

class Cart extends Component
{
    public $cart = [];

    protected $listeners = [
        'cartUpdated' => 'updateCartView'
    ];

    public function mount()
    {
        $this->cart = Session::get('cart', []);
    }

    public function removeFromCart($itemId)
    {
        $cart = Session::get('cart', []);

        if (isset($cart[$itemId])) {
            unset($cart[$itemId]);
        }

        Session::put('cart', $cart);
        $this->cart = $cart;
    }

    public function clearCart()
    {
        Session::forget('cart');
        $this->cart = [];
    }

    public function getTotal()
    {
        return collect($this->cart)->sum(fn ($item) => $item['quantity'] * $item['price']);
    }


    public function render()
    {
        return view('livewire.cart');
    }
}
