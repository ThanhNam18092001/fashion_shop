@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('assets/css/frontend/myOrderShow.css') }}" rel="stylesheet">

@section('title', 'Oder')

@section('content')
<div class="row">
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-success mb-3">{{ session('message') }}</div>
        @endif
        <div class="card">
            <div class="card-body">

                <h4 class="text-primary">
                    <i class="fa fa-shopping-cart text-danger"></i>My Order Detail
                </h4>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <h6>Order_id: {{ $order->id }}</h6>
                        <h6>Tracking Id/No.: {{ $order->tracking_no }}</h6>
                        <h6>Ordered Date: {{ $order->created_at->format('d-m-y h:i A') }}</h6>
                        <h6>Paymont Mode: {{ $order->paymont_mode }}</h6>
                        <h6 class="border p-2 text-success">
                            Order Status Message: <span class="text-uppercase">{{ $order->status_message }}</span>
                        </h6>
                    </div>
                    <div class="col-md-6">
                        <h5>User Detail</h5>
                        <hr>
                        <h6>Full Name: {{ $order->fist_name }}{{ $order->last_name }}</h6>
                        <h6>Email Id: {{ $order->email }}</h6>
                        <h6>Phone: {{ $order->phone }}</h6>
                        <h6>Address: {{ $order->address }}</h6>
                        <h6>Pin code: {{ $order->pin_code }}</h6>
                    </div>
                </div>
                <br />
                <h5>Order Items</h5>
                <hr>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <th>Product ID</th>
                            <th>Image</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </thead>
                        <tbody>
                            @php
                                $totalPrice = 0;
                            @endphp
                            @foreach ($order->orderItems as $orderItem)
                                <tr>
                                    <td width="10%">{{ $orderItem->id }}</td>
                                    <td width="10%">
                                        @if ($orderItem->product->productImages)
                                            <img src="{{ asset($orderItem->product->productImages[0]->image) }}"
                                                class="imgOrder" alt="">
                                        @else
                                            <img src="imgOrder" alt="">
                                        @endif
                                    </td>
                                    <td>
                                        {{ $orderItem->product->name }}
                                        @if ($orderItem->productColor)
                                            @if ($orderItem->productColor->color)
                                                <span>Color:
                                                    {{ $orderItem->productColor->color->name }}</span>
                                            @endif
                                        @endif
                                    </td>
                                    <td width="10%">${{ $orderItem->price }}</td>
                                    <td width="10%">{{ $orderItem->quantity }}</td>
                                    <td width="10%" class="fw-bold">
                                        ${{ $orderItem->quantity * $orderItem->price }}</td>
                                    @php
                                        $totalPrice += $orderItem->quantity * $orderItem->price;
                                    @endphp
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="5" class="fw-bold">Total Amount: </td>
                                <td colspan="1" class="fw-bold">${{ $totalPrice }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <hr>
            </div>
        </div>
    </div>
</div>
@endsection
