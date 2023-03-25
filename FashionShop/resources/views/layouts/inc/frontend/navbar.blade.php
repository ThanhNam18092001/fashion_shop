<link rel="stylesheet" href="{{ asset('assets/css/frontend/navbar.css') }}" rel="stylesheet">
<div class="header" id="header">
    <div class="txtContainer">
        <p class="txtWC">Welcome Couture2gether</p>
        <div class="txtImgContainer">
            <img class="iconHeader1" src="{{ url('image_path/icon_lcMy.png') }}">
            <p>English</p>
            <img class="iconHeader1" src="{{ url('image_path/icon_bot.png') }}">
            <a href="#login" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img class="iconHeader1" src="{{ url('image_path/icon_person.png') }}"></a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">

                @guest
                    <li><a class="dropdown-item" href="{{ url('/my_orders') }}"><i class="fa fa-user"></i> My Order</a></li>
                    {{-- @if (Route::has('login')) --}}
                    <li class="nav-item">
                        <a data-bs-toggle="modal" data-bs-target="#loginModal" class="nav-link">{{ __('Login') }}</a>
                    </li>
                    {{-- @endif --}}

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="modal"
                                data-bs-target="#registerModal">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li><a class="dropdown-item" href="{{ url('/profile') }}"><i class="fa fa-user"></i> Profile</a></li>
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out"></i>{{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
    <div class="txtContainer">
        <p class="txtFashion">Fashion</p>
        <div class="txtImgContainer2">
            <a><img id="btn1" class="iconHeader2" src="{{ url('image_path/icon_search.png') }}"></a>
            <a href="/wishlist">
                <img class="iconHeader2" src="{{ url('image_path/icon_heart.png') }}">
            </a>
            <a href="{{ url('cart') }}" class="cart_count_a">
                <label class="cart_count_label">
                    <livewire:frontend.cart.cart-count />
                </label>
                <img class="iconHeader2" src="{{ url('image_path/icon_cart2.png') }}"></a>
        </div>
    </div>
    <div class="navigation" id="myDIV">
        <ul>
            <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
                <a href="/" active class="menuNavigation2">New arrivlas</a>
            </li>
            <li class="nav-item {{ Request::is('women') ? 'active' : '' }}">
                <a href="/women" class="menuNavigation2">Women</a>
            </li>
            <li class="nav-item {{ Request::is('man') ? 'active' : '' }}">
                <a href="/man" class="menuNavigation2">Man</a>
            </li>
            <li class="nav-item {{ Request::is('designer') ? 'active' : '' }}"><a href="/designer"
                    class="menuNavigation2">Designer</a></li>
            <li class="nav-item {{ Request::is('sale') ? 'active' : '' }}"><a href="/sale"
                    class="menuNavigation2">Sale</a></li>
        </ul>
    </div>


</div>

<div class="search" id="search">
    <div class="search_icon_container">
        <img id="btn2" class="search_icon" class="iconHeader2" src="{{ url('image_path/icon_close.png') }}">
    </div>
    <div class="search_txt_container">
        <p class="txtSearch">Search</p>

        <form role="search" action="{{ url('search') }}" method="GET">
            <div class="search_input">
                <button class="btn bg-white" type="submit">
                    <i class="fa fa-search"></i>
                </button>
                <input type="search" name="search" value="{{ Request::get('search') }}" placeholder="search..."
                    class="form-control" />
            </div>
        </form>
    </div>
</div>
<script src="{{ asset('assets/js/frontend/navbar.js') }}"></script>

@php
    function activeMenu($uri = '')
    {
        $active = '';
        if (Request::is(Request::segment(1) . '/' . $uri . '/*') || Request::is(Request::segment(1) . '/' . $uri) || Request::is($uri)) {
            $active = 'active';
        }
        return $active;
    }
@endphp
