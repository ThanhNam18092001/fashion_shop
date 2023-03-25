@extends('layouts.app')

@section('title', 'Home Page')

@section('content')

    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">

        <div class="carousel-inner">
            @foreach ($sliders as $key => $sliderItem)
                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                    <div class="slider_item">
                        <div class="title_slider_container">
                            <p class="title_slider1">Exclusive collection 2021</p>
                            <p class="title_slider2">{{ $sliderItem->title }}</p>
                            <p>{{ $sliderItem->description }}</p>
                            <button>Learn More</button>
                        </div>
                        <div class="img_slider_container">
                            @if ($sliderItem->image)
                                <img src="{{ asset("$sliderItem->image") }}" class="d-block w-100 h-100" alt="...">
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach


        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <div class="py-5">
        <div class="container">
            <div class="row">
                @if ($featuredProducts)
                    <div class="col-md-12">
                        <div class="owl-carousel owl-theme four-carousel">
                            @foreach ($featuredProducts as $productItem)
                                <div class="item">
                                    <div class="product-card carousel_product_container">
                                        <div class="product-card-img">
                                            <div class="carousel_product_top">
                                                <label class="label_sold_carousel">Sold</label>
                                                <a click='addToWishList({{ $productItem->id }})' class="btn btn1">
                                                    <img class="collection-img" src="{{ url('image_path/icon_heart.png') }}"
                                                        alt="">
                                                </a>
                                            </div>
                                            @if ($productItem->productImages->count() > 0)
                                                <a
                                                    href="{{ url('/collections/' . $productItem->category->slug . '/' . $productItem->slug) }}">
                                                    <img width="100%" height="300px"
                                                        src="{{ asset($productItem->productImages[0]->image) }}"
                                                        alt="{{ $productItem->name }}">
                                                </a>
                                            @endif
                                        </div>
                                        <div class="product-card-body title_product_container">
                                            <h5>
                                                <a class="title_product_txt"
                                                    href="{{ url('/collections/' . $productItem->category->slug . '/' . $productItem->slug) }}">
                                                    {{ $productItem->name }}
                                                </a>
                                            </h5>
                                            <div>
                                                <span
                                                    class="selling-price title_product_price">${{ $productItem->selling_price }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="col-md-12">
                        <div class="p-2">
                            <h5>No Featured Products Available</h5>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="collection-container">
        <div class="collection">
            <img class="collection-img" src="{{ url('image_path/Rectangle_3.png') }}" alt="">
            <div class="collection-txt">
                <p class="collection-title">Clothing
                    Collection 2021</p>
                <p class="collection-content">Read view</p>
                <img src="{{ url('image_path/thanhNgang.png') }}">
            </div>
        </div>
        <div class="collection">
            <img class="collection-img" src="{{ url('image_path/Rectangle_2.png') }}" alt="">
            <div class="collection-txt">
                <p class="collection-title">Shoes Collection
                    2021</p>
                <p class="collection-content">Read view</p>
                <img src="{{ url('image_path/thanhNgang.png') }}">
            </div>
        </div>
    </div>
    <div class="latest-container">
        <p class="latest-title">Latest Arivals</p>
        <img src="{{ url('image_path/thanhNgang.png') }}">
    </div>
    <div class="product-container">
        @foreach ($products as $product)
            <div class="product">
                <div class="product_image_show">
                    <a href=""><img class="collection-img p-3" src="{{ url('image_path/icon_heart.png') }}"
                            alt=""></a>
                </div>
                <a href="{{ url('/collections/' . $productItem->category->slug . '/' . $productItem->slug) }}">
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
    </div>
    <div class="btn_see_all_container">
        <a href="/women">See all</a>
    </div>


    {{-- ====== Modal Login ====== --}}
    <div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content ">
                <div class="text-end">
                    <button type="button" class="btn-close p-3" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <h2 class="modal-title text-center " id="staticBackdropLabel">{{ __('Login') }}</h2>
                <div class="modal-body">
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="mb-3 d-grid">
                                <label for="email" class="col-md-4 col-form-label">{{ __('Email Address') }}</label>

                                <div class="">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3 d-grid">
                                <label for="password" class="col-md-4 col-form-label">{{ __('Password') }}</label>

                                <div class="">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            @if (Route::has('password.request'))
                                <div class="text-end"> Forgot<a
                                        class="text-decoration-none fw-bolder text-black text-sm-end"
                                        href="{{ route('password.request') }}">
                                        Password?
                                    </a></div>
                            @endif

                            <div class="row mb-0 text-lg-center">
                                <div class="">
                                    <button type="submit" class=" btn_color_login">
                                        {{ __('Login') }}
                                    </button>
                                </div>
                                <div class="text-lg-center mt-5 ">
                                    <p>Or sing up usign</p>
                                    <div>
                                        <img class="collection-img me-1" src="{{ url('image_path/icon_fb_login.png') }}"
                                            alt="">
                                        <img class="collection-img ms-1" src="{{ url('image_path/icon_gg_login.png') }}"
                                            alt="">
                                    </div>
                                    <div class="text-lg-center mt-5">
                                        Don’t have an account? <a href=""
                                            class="text-decoration-none fw-bolder text-black text-sm-end">Sing up</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- ====== Modal Reister ====== --}}
    <div class="modal fade" id="registerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="text-end">
                    <button type="button" class="btn-close p-3" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <h5 class="modal-title text-center" id="staticBackdropLabel">{{ __('Register') }}</h5>
                <div class="modal-body">
                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="mb-3 d-grid">
                                <label for="name" class="col-md-4 col-form-label">{{ __('Name') }}</label>

                                <div class="">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 d-grid">
                                <label for="email" class="col-md-4 col-form-label">{{ __('Email Address') }}</label>

                                <div class="">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 d-grid">
                                <label for="password" class="col-md-4 col-form-label">{{ __('Password') }}</label>
                                <div class="">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 d-grid">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label">{{ __('Confirm Password') }}</label>

                                <div class="">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div>
                                <input type="checkbox"> I agree to the <a href=""
                                    class="text-decoration-none fw-bolder text-black">Terms & Conditions</a>
                            </div>

                            <div class="row mb-0 text-lg-center">
                                <div class="">
                                    <button type="submit" class="btn col-11 mt-5 btn_color_register">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                                <div class="text-lg-center mt-5">
                                    Don’t have an account? <a href=""
                                        class="text-decoration-none fw-bolder text-black text-sm-end">login</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
<link rel="stylesheet" href="{{ asset('assets/css/frontend/index.css') }}" rel="stylesheet">
@section('script')
<script src="{{ asset('assets/js/frontend/index.js') }}"></script>
@endsection
