@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('assets/css/frontend/order_confirmed.css') }}" rel="stylesheet">
@section('title', 'Thank you for Shopping')

@section('content')
    <div class="container">
        <img class="icon-modal" src="{{ url('image_path/icon_completing.png') }}" alt="">
        <p class="txt_order">Order Confirmed</p>
        <p>Your order have been confirmed, please wait and track your order</p>
        <button class="btn">
            <a href="/my_orders">Go to track page</a>
        </button>
    </div>
@endsection

