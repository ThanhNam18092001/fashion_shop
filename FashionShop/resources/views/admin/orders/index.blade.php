@extends('layouts.admin')

@section('title', 'Oder')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>My Orders</h3>
                </div>

                <div class="card-body">
                    <form action="" method="GET">
                        <div class="row">
                            <div class="col-md-3">
                                <label>Filter by Date</label>
                                <input type="date" name="date" value="{{ Request::get('date') ?? date('Y-m-d') }}"
                                    class="form-control">
                            </div>
                            <div class="col-md-3">
                                <label>Filter by Status</label>
                                <select name="status" class="form-select">
                                    <option value="">Select All Status</option>
                                    <option value="in Progress" {{ Request::get('status') == 'in progress' ? 'select' : '' }}>In Progress</option>
                                    <option value="completed" {{ Request::get('status') == 'completed' ? 'select' : '' }}>Completed</option>
                                    <option value="pending" {{ Request::get('status') == 'pending' ? 'select' : '' }}>Pending</option>
                                    <option value="cancelled" {{ Request::get('status') == 'cancelled' ? 'select' : '' }}>Cancelled</option>
                                    <option value="out-for-delivery" {{ Request::get('status') == 'out-for-delivery' ? 'select' : '' }}>Out for delivery</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <br />
                                <button type="submit" class="btn btn-primary">Filte</button>
                            </div>
                        </div>
                    </form>
                    <hr>
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
                                        <td><a href="{{ url('admin/orders/' . $item->id) }}"
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
