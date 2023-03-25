<?php

namespace App\Http\Livewire\Frontend\Cart;

use App\Models\Cart;
use Livewire\Component;

class CartShow extends Component
{
    public $cart, $totalPrice = 0;

    public function removeCartItem(int $cartId)
    {
        // $cartRemoveData = Cart::where('user_id', auth()->user()->id)->where('id', $cartId)->first();
        if (auth()->user()) {
            Cart::where('user_id', auth()->user()->id)->where('id', $cartId)->first()->delete();
            $this->emit('CartAddedUpdate');
            $this->dispatchBrowserEvent('message', [
                'text' => 'Cart Item Remove Successfully',
                'type' => 'success',
                'status' => 200
            ]);
        } else {
            Cart::where('user_id', auth()->user())->where('id', $cartId)->first()->delete();
            $this->emit('CartAddedUpdate');
            $this->dispatchBrowserEvent('message', [
                'text' => 'Cart Item Remove Successfully',
                'type' => 'success',
                'status' => 200
            ]);
        }
    }

    public function render()
    {
        if (auth()->user()) {
            $this->cart = Cart::where('user_id', auth()->user()->id)->get();
            return view('livewire.frontend.cart.cart-show', [
                'cart' => $this->cart,
            ]);
        } else {
            $this->cart = Cart::where('user_id', auth()->user())->get();
            return view('livewire.frontend.cart.cart-show', [
                'cart' => $this->cart,
            ]);
        }
    }
}
