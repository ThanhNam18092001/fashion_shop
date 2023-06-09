@extends('layouts.app')

@section('title', 'Oder')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>My Orders</h3>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <th>Order ID</th>
                            <th>Tracking No</th>
                            <th>Username</th>
                            <th>Payment Mode</th>
                            <th>Ordered Date</th>
                            <th>Status Massage</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @forelse ($orders as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->tracking_no }}</td>
                                    <td>{{ $item->fist_name }}{{ $item->last_name }}</td>
                                    <td>{{ $item->payment_mode }}</td>
                                    <td>{{ $item->created_at->format('d-m-y') }}</td>
                                    <td>{{ $item->status_message }}</td>
                                    <td><a href="{{ url('/my_orders/' . $item->id) }}"
                                            class="btn btn-primary btn-sm">View</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">No Orders available</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div>{{ $orders->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
