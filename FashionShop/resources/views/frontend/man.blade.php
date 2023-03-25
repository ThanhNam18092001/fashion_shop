@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('assets/css/frontend/man.css') }}" rel="stylesheet">
@section('title', 'Home Page')

@section('content')
    <div class="container_man" >
        <div class="menu_man">
            <ul class="menu_man_ul">
                <li class="menu_man_li">Man</li>
                <li>Accessories</li>
                <li>Clothing</li>
                <li>Handbags</li>
                <li>Shoes</li>
            </ul>
        </div>
        <div class="product-container">
            {{ $manProducts->links() }}
            @foreach ($manProducts as $product)
                <div class="product">
                    <div class="product_top">
                        <label class="product_top_sold">Sold</label>
                        <a wire:click='addToWishList({{ $product->id }})' class="btn btn1">
                            <img class="collection-img" src="{{ url('image_path/icon_heart.png') }}" alt="">
                        </a>
                    </div>
                    <a href="{{ url('/collections/' . $product->category->slug . '/' . $product->slug) }}">
                        <img class="product-img" src="{{ asset($product->productImages[0]->image) }}" alt="">
                    </a>
                    <div class="product-txt">
                        <a class="product-title" href="#">{{ $product->name }}</a>
                        <p class="product-price">$
                            {{ $product->selling_price }}
                        </p>
                    </div>
                </div>
            @endforeach
            {{ $manProducts->links() }}
        </div>
    </div>

@endsection

<style>
    .container_man .menu_man .menu_man_li{
        font-size: 21px; font-weight: bold;
    }
    .container_man .menu_man .menu_man_ul{
        width: 50px;
    },
    .container_man .menu_man{
        flex: 4
    }
    .container_man{
        display: flex;
    }
</style>
