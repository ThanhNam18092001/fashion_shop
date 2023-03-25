<div>
    <div class="py-3 py-md-4 checkout">
        <div class="container">
            <h4>Checkout</h4>
            <hr>

            @if ($this->totalProductAmount != '0')
                <div class="row">
                    <div class="col-md-12 left_container">
                        <div class="shadow bg-white p-3">
                            <h4 class="text-primary">
                                Account Details
                            </h4>
                            <hr>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Email *</label>
                                    <input type="email" wire:model.defer="email" class="form-control"
                                        placeholder="Enter Email Address" />
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>Phone *</label>
                                    <input type="number" wire:model.defer="phone" class="form-control"
                                        placeholder="Enter Phone Number" />
                                    @error('phone')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <h4 class="text-primary">
                                    Billing Details
                                </h4>
                                <hr>

                                <div class="col-md-6 mb-3">
                                    <label>Fist Name *</label>
                                    <input type="text" wire:model.defer="fist_name" class="form-control"
                                        placeholder="" />
                                    @error('fist_name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>Last Name *</label>
                                    <input type="text" wire:model.defer="last_name" class="form-control"
                                        placeholder="" />
                                    @error('last_name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label>Street Address *</label>
                                    <input wire:model.defer="address" class="form-control" rows="2"
                                        placeholder="Address">
                                    @error('address')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>City *</label>
                                    <input type="text" wire:model.defer="city" class="form-control"
                                        placeholder="Enter Pin-code" />
                                    @error('city')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>Postcode / ZIP *</label>
                                    <input type="number" wire:model.defer="pin_code" class="form-control"
                                        placeholder="Enter Pin-code" />
                                    @error('pin_code')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>Country *</label>
                                    <select wire:model.defer="country" name="country" id=""
                                        class="form-control">
                                        <option value="">United States</option>
                                        <option value="viet_nam">Việt Nam</option>
                                        <option value="my">Mỹ</option>
                                    </select>
                                    @error('country')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>State / Province *</label>
                                    <select wire:model.defer="state" name="state" id=""
                                        class="form-control">
                                        <option value="0">Please Select</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                    </select>
                                    @error('state')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="right_container">
                        <div class="right_detail">
                            <h1>Order Summary</h1>
                            <hr>
                            @foreach ($cart as $cartItem)
                                @if ($cartItem->product)
                                    <div class="right_nam_price">
                                        <p>{{ $cartItem->product->name }}.</p>
                                        <p>${{ $cartItem->product->selling_price }}</p>
                                    </div>
                                @endif
                                @php
                                    $totalPrice += $cartItem->product->selling_price * $cartItem->quantity;
                                @endphp
                            @endforeach
                            <hr>
                            <div class="right_total_price">
                                <p>Subtotal</p>
                                <p>${{ $totalPrice }}</p>
                            </div>
                            <p class="right_shipping_mt">Shipping Method</p>

                            <div class="right_free_shipping_container">
                                <div class="right_free_shipping">
                                    <input class="right_free_shipping_input" checked="checked" type="radio" />Free
                                    Shipping
                                </div>
                                <p>$0.00</p>
                            </div>
                            <div class="right_local_pickup_container" >
                                <div class="right_local_pickup">
                                    <input class="right_local_pickup_input" type="radio" />Local Pickup
                                </div>
                                <p>$0.00</p>
                            </div>
                            <div class="right_flat_rate_container">
                                <div class="right_flat_rate">
                                    <input class="right_flat_rate_input" type="radio" />Flat Rate
                                </div>
                                <p>$0.00</p>
                            </div>
                            <hr>
                            <div class="right_total_container">
                                <p>Total</p>
                                <p>${{ $totalPrice }}</p>
                            </div>
                            <div class="btn_container">

                                <button type="button" wire:loading.attr='disabled' wire:click="codOrder"
                                    class="btn btn-primary">
                                    <span wire:loading.remove wire:target='codOrder'>
                                        Place Order (Cash on Delivery)
                                    </span>
                                    <span wire:loading wire:target='codOrder'>
                                        Placing Order
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="card card-body shadow text-center p-mb-5">
                    <h4>No items in cart to checkout</h4>
                    <a href="{{ url('/') }}" class="btn btn-warning">Show now</a>
                </div>
            @endif

        </div>
    </div>
</div>
<link rel="stylesheet" href="{{ asset('assets/css/frontend/checkout_show.css') }}" rel="stylesheet">
