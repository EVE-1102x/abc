@extends('layouts.master')
@section('title','create Order')
@section('content')
    <div class="container-fluid px-4">
        <div class="card mt-4">
            <div class="card-header">
                <h4 class="">
                    <a href="{{ url('admin/order') }}" class="btn btn-primary float-end">Go Back</a>
                    Add Order
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

                <form action="{{ url('admin/add-order') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label>Customer Name</label>
                        <select name="CustomerID" class="form-select">
                            @foreach($customer as $Customer)
                            @endforeach

                            @foreach($user as $User)
                                @if($User->role_as == '0')
                                    <option value="{{ $Customer->id }}">{{ $User->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Category Name</label>
                        <select name="CategoryID" class="form-select">
                            @foreach($category as $Category)
                                <option value="{{ $Category->id }}">{{ $Category->cate_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Product Number</label>
                        <input type="number" name="prd_number" class="form-control" min="1" placeholder="How many product in this Order?">
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Step 2=></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
