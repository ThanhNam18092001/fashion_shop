<div class="py-3 py-md-5">
    <div class="container">
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <div class="row">
            <p class="product-path">
                <a href="/">Home</a> / <a href="">{{ $product->category->name }}</a> / <a
                    href="">{{ $product->name }}</a>
            </p>
            <div class="col-md-5 mt-3">

                <div class="bg-white border" wire:ignore>
                    @if ($product->productImages)
                        {{-- <img src="{{ asset($product->productImages[0]->image) }}" class="w-100" alt="Img"> --}}
                        <div class="exzoom" id="exzoom">
                            <!-- Images -->
                            <div class="exzoom_img_box">
                                <ul class='exzoom_img_ul'>
                                    @foreach ($product->productImages as $itemImage)
                                        <li><img width="100px" src="{{ asset($itemImage->image) }}" /></li>
                                    @endforeach

                                </ul>
                            </div>
                            <div class="exzoom_nav"></div>
                            <p class="exzoom_btn">
                                <a href="javascript:void(0);" class="exzoom_prev_btn">
                                    < </a>
                                        <a href="javascript:void(0);" class="exzoom_next_btn"> > </a>
                            </p>
                        </div>
                    @else
                        No Image Added
                    @endif
                </div>
            </div>
            <div class="col-md-7 mt-3">
                <div class="product-view">
                    <h4 class="product-name product_name">
                        {{ $product->name }}
                    </h4>

                    <div class="mt-3">
                        <h5 class="mb-0">Small Description</h5>
                        <p>
                            {{ $product->small_description }}
                        </p>
                    </div>

                    <button type="button" class="btn_wish_list" wire:click='addToWishList({{ $product->id }})'
                        class="btn btn1">
                        <span wire:loading.remove wire::taget="addToWishList">
                            <i class="fa fa-heart"></i> Wishlist
                        </span>
                        <span wire:loading wire::taget="addToWishList">Adding..</span>
                    </button>

                    <div class="price_container">
                        <span class="selling-price">${{ $product->selling_price }}</span>
                        <div class="btn_price_container">
                            <button wire:click="butItNow({{ $product->id }})"
                                type="button" class="btn btn1 btn_but_it_now">
                                <i class="fa fa-shopping-cart"></i> But It Now
                            </button>
                            <button class="btn btn_add_to_cart"
                                type="button" wire:click="addToCart({{ $product->id }})">
                                Add To Cart
                            </button>
                        </div>
                    </div>

                </div>
            </div>
            <div>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="description-tab" data-bs-toggle="tab"
                            data-bs-target="#description-tab-pane" type="button" role="tab"
                            aria-controls="description-tab" aria-selected="true">Description</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="details-tab" data-bs-toggle="tab"
                            data-bs-target="#details-tab-pane" type="button" role="tab" aria-controls="details-tab"
                            aria-selected="false">Details</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="condition-tab" data-bs-toggle="tab"
                            data-bs-target="#condition-tab-pane" type="button" role="tab"
                            aria-controls="condition-tab" aria-selected="false">Condition</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade boder p-3 show active" id="description-tab-pane" role="tabpanel"
                        aria-labelledby="description-tab">
                        <div class="col-md-12 mt-3">
                            <div class="card">
                                <div class="card-header bg-white">
                                    <h4>Description</h4>
                                </div>
                                <div class="card-body">
                                    <p>
                                        {{ $product->description }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade boder p-3" id="details-tab-pane" role="tabpanel"
                        aria-labelledby="details-tab">
                        <div class="mt-2">
                            <div class="input-group">
                                <p>Quantity</p>
                                <span class="btn btn1" wire:click='decrementQuantity'><i class="fa fa-minus"></i></span>
                                <input type="text" wire:model='quantityCount' value="{{ $this->quantityCount }}"
                                    readonly class="input-quantity" />
                                <span class="btn btn1" wire:click='incrementQuantity'><i
                                        class="fa fa-plus"></i></span>
                            </div>
                        </div>
                        <div>
                            <p>Color</p>
                            @if ($product->productColors->count() > 0)
                                @if ($product->productColors)
                                    @foreach ($product->productColors as $colorItem)
                                        <button class="colorSelectionLabel"
                                            style="background-color: {{ $colorItem->color->code }}"
                                            wire:click='colorSelected({{ $colorItem->id }})'>
                                            {{ $colorItem->color->name }}
                                        </button>
                                    @endforeach
                                @endif
                                <div>
                                    @if ($this->prodColorSelectedQuantity == 'outOfStock')
                                        <button class="btn-sm py-1 mt-2 text-white bg-danger">Out Of Stock</button>
                                    @elseif ($this->prodColorSelectedQuantity > 0)
                                        <button class="btn-sm py-1 mt-2 text-white bg-success">In Stock</button>
                                    @endif
                                </div>
                            @else
                                @if ($product->quantity)
                                    <label class="btn-sm py-1 mt-2 text-white bg-success">In Stock</label>
                                @else
                                    <label class="btn-sm py-1 mt-2 text-white bg-danger">Out Of Stock</label>
                                @endif
                            @endif

                        </div>
                    </div>
                    <div class="tab-pane fade boder p-3" id="condition-tab-pane" role="tabpanel"
                        aria-labelledby="condition-tab">
                        <div class="row">
                            <div class="col-md-4">
                                <h1>Condition</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" href="{{ asset('assets/css/frontend/product/view.css') }}" rel="stylesheet">

@push('scripts')
<script src="{{ asset('assets/js/frontend/view_product.js') }}"></script>
@endpush
