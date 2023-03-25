@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('assets/css/frontend/address/create.css') }}" rel="stylesheet">
@section('title', 'User Profile')

@section('content')

    <div class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    @if (session('message'))
                        <div class="alert alert-success">{{ session('message') }}</div>
                    @endif

                </div>
                <div class="menu_container">
                    <div class="menu">
                        <ul class="menu_ul">
                            <li class="menu_item1">
                                <img class="collection-img" src="{{ url('image_path/icon_person.png') }}" alt="">
                                <div class="txt">
                                    tài khoản của
                                    {{ Auth::user()->email }}
                                </div>
                            </li>
                            <li class="menu_item"><a href="/my_orders" {{ Request::is('/my-orders') ? 'active' : '' }}><img
                                        src="{{ url('image_path/icon_cart2.png') }}" alt="">My order</a></li>
                            <li class="menu_item"><a href="/wishlist" {{ Request::is('wishlist') ? 'active' : '' }}><img
                                        src="{{ url('image_path/icon_heart.png') }}" alt="">My Wishlist</a></li>
                            <li class="menu_item"><a href="/address" {{ Request::is('address') ? 'active' : '' }}><img
                                        src="{{ url('image_path/icon_map.png') }}" alt="">My Addresses</a></li>
                            <li class="menu_item"><a href="/profile" {{ Request::is('profile') ? 'active' : '' }}><img
                                        src="{{ url('image_path/icon_person2.png') }}" alt="">My Profile</a></li>
                            <li class="menu_item"><a href="">
                                    <img src="{{ url('image_path/icon_logout.png') }}" alt="">
                                    <a
                                        href="{{ route('logout') }}"onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                        Log out
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </a></li>
                        </ul>
                    </div>
                    <div class="col-md-10 address_container">
                        <h4>My Address</h4>
                        <form action="{{ url('address') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Fist Name *</label>
                                    <input type="text" name="fist_name" class="form-control" placeholder="" />
                                    @error('fist_name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>Last Name *</label>
                                    <input type="text" name="last_name" class="form-control" placeholder="" />
                                    @error('last_name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label>Street Address *</label>
                                    <input name="address" class="form-control" rows="2" placeholder="Address">
                                    @error('address')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>City *</label>
                                    <input type="text" name="city" class="form-control"
                                        placeholder="Enter Pin-code" />
                                    @error('city')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>Postcode / ZIP *</label>
                                    <input type="number" name="pin_code" class="form-control"
                                        placeholder="Enter Pin-code" />
                                    @error('pin_code')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>Country *</label>
                                    <select name="country" name="country" id="" class="form-control">
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
                                    <select name="state" name="state" id="" class="form-control">
                                        <option value="0">Please Select</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                    </select>
                                    @error('state')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <input type="checkbox" name="status">Set as default address
                            <br>
                            <button type="submit">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

