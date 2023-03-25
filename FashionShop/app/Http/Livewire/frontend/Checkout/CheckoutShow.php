<?php

namespace App\Http\Livewire\Frontend\Checkout;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Illuminate\Support\Str;

class CheckoutShow extends Component
{
    public $carts, $totalProductAmount;

    public $last_name, $fist_name, $email, $phone, $pin_code, $address, $city, $payment_mode = NULl, $payment_id = NULL;
    public $country, $state;

    public function rules()
    {
        return [
            'last_name' => 'required|string|max:121',
            'fist_name' => 'required|string|max:121',
            'email' => 'required|email|max:121',
            'phone' => 'required|string|max:11|min:10',
            'city' => 'required|string|max:121',
            'pin_code' => 'required|string|max:6|min:6',
            'address' => 'required|string|max:500',
            'country' => ' required|string',
            'state' => ' required|string',
        ];
    }

    public function placeOrder()
    {
        $validatedData = $this->validate();
        if (auth()->user()) {
            $authUser = auth()->user()->id;
        } else {
            $authUser = null;
        }
        $order = Order::create([
            'user_id' => $authUser,
            'tracking_no' => 'funda-' . Str::random(10),
            'last_name' => $this->last_name,
            'fist_name' => $this->fist_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'pin_code' => $this->pin_code,
            'address' => $this->address,
            'city' => $this->city,
            'country' => $this->country,
            'state' => $this->state,
            'status_message' => 'in progress',
            'payment_mode' => $this->payment_mode,
            'payment_id' => $this->payment_id,
        ]);
        foreach ($this->carts as $cartItem) {
            if ($order->id) {
                $orderItems = OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'product_color_id' => $cartItem->product_color_id,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->product->selling_price,
                ]);
            } else {
                $orderItems = OrderItem::create([
                    'product_id' => $cartItem->product_id,
                    'product_color_id' => $cartItem->product_color_id,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->product->selling_price,
                ]);
            }
            if ($cartItem->product_color_id != NULL) {
                $cartItem->productColor()->where('id', $cartItem->product_color_id)->decrement('quantity', $cartItem->quantity);
            } else {
                $cartItem->product()->where('id', $cartItem->product_color_id)->decrement('quantity', $cartItem->quantity);
            }
        }
        return $order;
    }

    public function codOrder()
    {
        $this->payment_mode = 'Cash on Delivery';
        $codOrder = $this->placeOrder();

        if ($codOrder) {

            if (auth()->user()) {
                Cart::where('user_id', auth()->user()->id)->delete();
            } else {
                Cart::where('user_id', null)->delete();
            }


            session()->flash('message', 'Order Placed Successfully');
            $this->dispatchBrowserEvent('message', [
                'text' => 'Quantity Placed Successfully',
                'type' => 'success',
                'status' => 200
            ]);
            return redirect()->to('order-confirmed');
        } else {
            $this->dispatchBrowserEvent('message', [
                'text' => 'SomeThing went wrong',
                'type' => 'error',
                'status' => 500
            ]);
        }
    }

    public function totalProductAmount()
    {
        if (auth()->user()) {
            $this->totalProductAmount = 0;
            $this->carts = Cart::where('user_id', auth()->user()->id)->get();
            foreach ($this->carts as $cartItem) {
                $this->totalProductAmount += $cartItem->product->selling_price * $cartItem->quantity;
            }
            return $this->totalProductAmount;
        } else {
            $this->totalProductAmount = 0;
            $this->carts = Cart::get();
            foreach ($this->carts as $cartItem) {
                $this->totalProductAmount += $cartItem->product->selling_price * $cartItem->quantity;
            }
            return $this->totalProductAmount;
        }
    }

    public $cart, $totalPrice = 0;
    public function render()
    {
        if (auth()->user()) {
            $this->last_name = auth()->user()->userAddress->last_name ?? "";
            $this->fist_name = auth()->user()->userAddress->fist_name ?? "";
            $this->email = auth()->user()->email ?? "";

            $this->phone = auth()->user()->userDetail->phone ?? "";
            $this->pin_code = auth()->user()->userAddress->pin_code ?? "";
            $this->city = auth()->user()->userAddress->city ?? "";
            $this->address = auth()->user()->userAddress->address ?? "";

            if (auth()->user()) {
                $this->cart = Cart::where('user_id', auth()->user()->id)->get();
                $this->totalProductAmount = $this->totalProductAmount();
                return view('livewire.frontend.checkout.checkout-show', [
                    'totalProductAmount' => $this->totalProductAmount,
                    'cart' => $this->cart,
                ]);
            } else {
                $this->cart = Cart::get();
                $this->totalProductAmount = $this->totalProductAmount();
                return view('livewire.frontend.checkout.checkout-show', [
                    'totalProductAmount' => $this->totalProductAmount,
                    'cart' => $this->cart,
                ]);
            }
        } else {
            if (auth()->user() == null) {
                $this->cart = Cart::where('user_id', auth()->user())->get();
                $this->totalProductAmount = $this->totalProductAmount();
                return view('livewire.frontend.checkout.checkout-show', [
                    'totalProductAmount' => $this->totalProductAmount,
                    'cart' => $this->cart,
                ]);
            } else {
                $this->cart = Cart::get();
                $this->totalProductAmount = $this->totalProductAmount();
                return view('livewire.frontend.checkout.checkout-show', [
                    'totalProductAmount' => $this->totalProductAmount,
                    'cart' => $this->cart,
                ]);
            }
        }

    }
}
