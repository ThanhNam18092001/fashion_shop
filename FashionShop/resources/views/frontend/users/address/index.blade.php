@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('assets/css/frontend/address/index.css') }}" rel="stylesheet">
@section('title', 'User Profile')

@section('content')

    <div class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    @if (session('message'))
                        <div class="alert alert-success">{{ session('message') }}</div>
                    @endif
                    @if ($errors->any())
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li class="text-danger">{{ $error }}</li>
                            @endforeach
                        </ul>
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
                    <div class="col-md-10 address_index_container">
                        <h4>My Profile</h4>
                        <form action="{{ url('profile') }}" method="POST">
                            @csrf
                            <div class="address_item">
                                @forelse ($address as $addressItem)
                                    <div>
                                        <div>
                                            <a>{{ $addressItem->last_name }}{{ $addressItem->fist_name }}</a>
                                            @if ($addressItem->status == '1')
                                                <img class="collection-img" src="{{ url('image_path/icon_default.png') }}"
                                                    alt="">
                                            @endif
                                            <a href="{{ url('address/' . $addressItem->id . '/edit') }}">Edit</a>
                                        </div>
                                        <div>
                                            Address: {{ $addressItem->address }}
                                        </div>
                                        <div>
                                            Phone: {{ Auth::user()->userDetail->phone }}
                                        </div>
                                    </div>
                                    <hr>

                                @empty
                                    <h1>Vui lòng chọn địa điểm</h1>
                                @endforelse
                                <div class="btn_address_container"><a href="/address/create" class="btn_address">Add
                                        new address</a></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
