
<div>
    <div class="py-3 py-md-5">
        <div class="container">
            <div class="row">
                <div class="left_container">
                    <div class="shopping-cart">
                        <div class="cart-header d-none d-sm-none d-mb-block d-lg-block">
                            <div class="row">
                                <div class="col-md-2">
                                    <h4>Image</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>Product</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>Unit price</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>Remove</h4>
                                </div>
                            </div>
                        </div>

                        @forelse ($cart as $cartItem)
                            @if ($cartItem->product)
                                <div class="cart-item">
                                    <div class="row">
                                        <div class="col-md-2 my-auto">
                                            <a
                                                href="{{ url('collections/' . $cartItem->product->category->slug . '/' . $cartItem->product->slug) }}">
                                                <label class="product-name">

                                                    @if ($cartItem->product->productImages)
                                                        <img class="img_cart"
                                                            src="{{ asset($cartItem->product->productImages[0]->image) }}"
                                                            alt="">
                                                    @else
                                                        <img class="img_cart" src="" alt="">
                                                    @endif
                                                </label>
                                            </a>
                                        </div>
                                        <div class="col-md-2 my-auto">
                                            <label class="name">
                                                {{ $cartItem->product->name }}
                                                @if ($cartItem->productColor)
                                                    <br>
                                                    @if ($cartItem->productColor->color)
                                                        <span>With color:
                                                            {{ $cartItem->productColor->color->name }}</span>
                                                    @endif
                                                @endif
                                            </label>
                                        </div>
                                        <div class="col-md-2 my-auto">
                                            <label class="price">${{ $cartItem->product->selling_price }} </label>
                                        </div>
                                        <div class="col-md-2 col-5 my-auto">
                                            <div class="remove">
                                                <button type="button" wire:loading.attr='disabled'
                                                    wire:click='removeCartItem({{ $cartItem->id }})'
                                                    class="btn btn-danger btn-sm">
                                                    <span wire:loading.remove
                                                        wire:target='removeCartItem({{ $cartItem->id }})'>
                                                        <i class="fa fa-trash"></i> Remove
                                                    </span>
                                                    <span wire:loading
                                                        wire:target='removeCartItem({{ $cartItem->id }})'>
                                                        <i class="fa fa-trash"></i> Removing
                                                    </span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @php
                                    $totalPrice += $cartItem->product->selling_price * $cartItem->quantity;
                                @endphp
                            @endif
                        @empty
                            <h1>No Cart Items available</h1>
                        @endforelse
                    </div>
                    <div class="col-md-8 my-md-auto mt-3">
                        <input type="text" placeholder="Enter coupon code" class="left_input">
                        <button class="btn">Apply coupon</button>
                    </div>
                </div>
                <div class="right_container">
                    <div class="shadow-sm bg-white">
                        <div class="deteil_container">
                            <h1>Order Summary</h1>
                            <hr>
                            <div class="detail">
                                <p>Subtotal</p>

                                <label class="price">${{ $totalPrice }}
                                </label>

                            </div>
                            <p class="shopping_mt">Shipping Method</p>
                            <div class="detail">
                                <p>Free Shipping</p>
                                <p>$0.00</p>
                            </div>
                            <div class="detail">
                                <p>Local Pickup</p>
                                <p>$0.00</p>
                            </div>
                            <div class="detail">
                                <p>Flat Rate</p>
                                <p>$0.00</p>
                            </div>
                            <hr>
                            <div class="detail_total">
                                <p>Total</p>
                                <p>${{ $totalPrice }}</p>
                            </div>
                            <div class="btn_container">
                                <button class="btn">
                                    <a class="txt" href="{{ url('/checkout') }}">
                                        Proceed to checkout
                                    </a>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" href="{{ asset('assets/css/frontend/cart_show.css') }}" rel="stylesheet"/>
