@extends('layouts.master')
@section('title','Edit Customer')
@section('content')
    <div class="container-fluid px-4">
        <div class="card mt-4">
            <div class="card-header">
                <h4>
                    <a href="{{ url('admin/customer') }}" class="btn btn-primary float-end">Go Back</a>
                    Edit Customer
                </h4>
            </div>

            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $errors)
                            <div>{{ $errors }}</div>
                        @endforeach
                    </div>
                @endif

                <form action="{{ url('admin/customer') }}" method="GET" enctype="multipart/form-data">
                    @csrf

                    @foreach($user as $User)
                        @if($customer->UserID == $User->id)
                            <div class="mb-3">
                                <label>Full Name</label>
                                <p class="form-control">{{ $User->name }}</p>
                            </div>
                        @endif
                    @endforeach

                    @foreach($user as $User)
                        @if($customer->UserID == $User->id)
                            <div class="mb-3">
                                <label>Email</label>
                                <p class="form-control">{{ $User->email }}</p>
                            </div>
                        @endif
                    @endforeach

                    <div class="mb-3">
                        <label>Phone Number</label>
                        @if($customer->cus_phone != null)
                            <p class="form-control">{{ $customer->cus_phone }}</p>
                        @else
                            <p class="form-control">Null</p>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label>Address</label>
                        @if($customer->cus_address != null)
                            <p class="form-control">{{ $customer->cus_address }}</p>
                        @else
                            <p class="form-control">Null</p>
                        @endif
                    </div>

                    @foreach($user as $User)
                        @if($customer->UserID == $User->id)
                            <div class="mb-3">
                                <label>Created At</label>
                                <p class="form-control">{{ $User->created_at->format('d/m/Y') }}</p>
                            </div>
                        @endif
                    @endforeach

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Go back</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
