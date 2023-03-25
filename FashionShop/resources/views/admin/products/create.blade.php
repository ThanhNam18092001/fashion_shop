@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Add Products
                        <a href="{{ url('admin/products') }}" class="btn btn-primary text-white btn-sm float-end">Back</a>
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{ url('admin/products/create') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        @csrf

                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                                    type="button" role="tab" aria-controls="home" aria-selected="true">Home</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="seotag-tab" data-bs-toggle="tab"
                                    data-bs-target="#seotag-tab-pane" type="button" role="tab"
                                    aria-controls="seotag-tab" aria-selected="false">SEO Tags</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="detail-tab" data-bs-toggle="tab"
                                    data-bs-target="#detail-tab-pane" type="button" role="tab"
                                    aria-controls="detail-tab" aria-selected="false">Detail</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="image-tab" data-bs-toggle="tab"
                                    data-bs-target="#image-tab-pane" type="button" role="tab" aria-controls="image-tab"
                                    aria-selected="false">Product Image</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="color-tab" data-bs-toggle="tab"
                                    data-bs-target="#color-tab-pane" type="button" role="tab" aria-controls="color-tab"
                                    aria-selected="false">Product Color</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade boder p-3 show active" id="home" role="tabpanel"
                                aria-labelledby="home-tab">...
                                <div class="mb-3">
                                    <label>Category</label>
                                    <select name="category_id" id="" class="form-control">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label>Product Name</label>
                                    <input type="text" name="name" class="form-control">
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label>Product Slug</label>
                                    <input type="text" name="slug" class="form-control">
                                    @error('slug')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label>Select Brand</label>
                                    <select name="brand" id="" class="form-control">
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->name }}">{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label>Smaill Description(500 words)</label>
                                    <textarea type="text" name="small_description" rows="4" class="form-control"></textarea>
                                    @error('small_description')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label>Description</label>
                                    <textarea type="text" name="description" rows="4" class="form-control"></textarea>
                                    @error('description')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="tab-pane fade boder p-3" id="seotag-tab-pane" role="tabpanel"
                                aria-labelledby="seotag-tab">
                                <div class="mb-3">
                                    <label>Meta Title</label>
                                    <input type="text" name="meta_title" class="form-control">
                                    @error('meta_title')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label>Meta Description</label>
                                    <textarea type="text" name="meta_description" rows="4" class="form-control"></textarea>
                                    @error('meta_description')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label>Meta Keyword</label>
                                    <textarea type="text" name="meta_keyword" rows="4" class="form-control"></textarea>
                                    @error('meta_description')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="tab-pane fade boder p-3" id="detail-tab-pane" role="tabpanel"
                                aria-labelledby="detail-tab">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="md-3">
                                            <label>Original Price</label>
                                            <input type="text" class="form-control" name="original_price">
                                            @error('original_price')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="md-3">
                                            <label>Selling Price</label>
                                            <input type="text" class="form_control" name="selling_price">
                                            @error('selling_price')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="md-3">
                                            <label>Quantity</label>
                                            <input type="text" class="form-control" name="quantity">
                                            @error('quantity')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="md-3">
                                            <label>Trending</label>
                                            <input type="checkbox" name="trending" style="width: 50px; height: 50px;">
                                            @error('trending')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="md-3">
                                            <label>Featured</label>
                                            <input type="checkbox" name="featured" style="width: 50px; height: 50px;">
                                        </div>
                                        <div class="md-3">
                                            <label>Status</label>
                                            <input type="checkbox" name="status" style="width: 50px; height: 50px;">
                                            @error('status')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade boder p-3" id="image-tab-pane" role="tabpanel"
                                aria-labelledby="image-tab">
                                <div class="mb-3">
                                    <label>Upload Product Image</label>
                                    <input type="file" name="image[]" multiple class="form-control">
                                </div>
                            </div>
                            <div class="tab-pane fade boder p-3" id="color-tab-pane" role="tabpanel"
                                aria-labelledby="color-tab">
                                <div class="mb-3">
                                    <label>Select Color</label>
                                    <div class="row">
                                        @forelse ($colors as $coloritem)
                                            <div class="col-md-3">
                                                Color: <input type="checkbox" name="colors[{{ $coloritem->id }}]"
                                                    value="{{ $coloritem->id }}">
                                                {{ $coloritem->name }}
                                                <hr>
                                                Quantity: <input type="number"
                                                    name="colorquantity[{{ $coloritem->id }}]"
                                                    style="width: 70px; border: 1px solid" />
                                            </div>
                                        @empty
                                            <div class="col-md-12">
                                                <h1>No colors found</h1>
                                            </div>
                                        @endforelse

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
