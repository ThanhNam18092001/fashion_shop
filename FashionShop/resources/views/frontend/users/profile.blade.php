@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('assets/css/frontend/profile.css') }}" rel="stylesheet">
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
                    <div class="col-md-10 profile_container">
                        <h4>My Profile</h4>
                        <form action="{{ url('profile') }}" method="POST">
                            @csrf
                            <div class="card shadow p-5">
                                <div class="mb-3">
                                    <label>Email</label>
                                    <input type="text" name="email" value="{{ Auth::user()->email }}"
                                        class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label>Name</label>
                                    <input type="text" name="username" value="{{ Auth::user()->name }}"
                                        class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label>Phone</label>
                                    @if (Auth::user()->userDetail)
                                        <input type="text" name="phone" value="{{ Auth::user()->userDetail->phone }}"
                                            class="form-control">
                                    @else
                                        <input type="text" name="phone" value="" class="form-control">
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label>Password</label>
                                    <input type="password" name="password" placeholder="*********" value="{{ Auth::user()->userDetail->phone }} ?? '' " class="form-control">
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn">Up
                                        date</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

