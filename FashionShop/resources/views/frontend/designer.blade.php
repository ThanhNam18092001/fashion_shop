@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('assets/css/frontend/women.css') }}" rel="stylesheet">
@section('title', 'Home Page')

@section('content')

    <div style="display: flex">
        <div style=" flex: 4">
            <ul style="width: 50px;">
                <li style="font-size: 21px; font-weight: bold;">Designer</li>
                <li>Accessories</li>
                <li>Clothing</li>
                <li>Handbags</li>
                <li>Shoes</li>

            </ul>
        </div>
        <div class="product-container">
            {{ $designerProducts->links() }}
            @foreach ($designerProducts as $product)
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
            {{ $designerProducts->links() }}
        </div>
    </div>

@endsection

