<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Session;

class CartCounter extends Component
{
    public $cartCount = 0;

    protected $listeners = ['cartUpdated' => 'updateCartCount'];


    public function getListeners()
    {
        return [
            'cartUpdated' => 'updateCartCount'
        ];
    }

    public function mount()
    {
        $this->cartCount = count(Session::get('cart', []));
    }

    public function updateCartCount()
    {
        $this->cartCount = count(Session::get('cart', []));
    }

    public function render()
    {
        return view('livewire.cart-counter');
    }
}
