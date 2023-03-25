@extends('layouts.admin')

@section('title', 'Users List')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if (session('message'))
                <div class="alert alert-success">{{ session('massage') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-warning">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h3>Update User
                        <a href="{{ url('admin/users') }}" class="btn btn-primary text-white btn-sm float-end">Add
                            Back</a>
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{ url('admin/users/'.$users->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Name</label>
                                <input type="text" name="name" value="{{ $users->name }}" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Email</label>
                                <input type="text" name="email" readonly value="{{ $users->email }}" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Password</label>
                                <input type="text" name="password" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Name</label>
                                <select name="role_as" class="form-control">
                                    <option value="">Select Role</option>
                                    <option value="0" {{ $users->role_as == '0' ? 'selected' : '' }}>User</option>
                                    <option value="1" {{ $users->role_as == '1' ? 'selected' : '' }}>Admin</option>
                                </select>
                            </div>
                            <div class="col-md-12 text-end">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
