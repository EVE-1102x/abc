@extends('layouts.master')
@section('title','Product')
@section('content')
    <div class="container-fluid px-4">
        <div class="card mt-4">
            <div class="card-header">
                <h4>
                    <a href="{{ url('admin/add-product') }}" class="btn btn-primary float-end">Add Product</a>
                    View Product
                </h4>
            </div>

            <div class="card-body">
                @if(session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif

                <table class="table table-bordered text-center">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th>Stock</th>
                        <th>Created by</th>
                        <th colspan="2">Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($product as $Product)
                        <tr>
                            <td>{{ $Product->id }}</td>
                            <td>{{ $Product->prd_name }}</td>
                            <td><img src="{{ asset('uploads/prd_image/'.$Product->prd_image) }}" style="height: 108px" width="192px" alt="Img"></td>
                            <td>{{ $Product->prd_price }}$</td>

                            @foreach($category as $Category)
                                @if($Product->CategoryID == $Category->id)
                                    <td>{{ $Category->cate_name }}</td>
                                @endif
                            @endforeach

                            <td>{{ $Product->prd_quantity }}</td>

                            @foreach($user as $User)
                                @if($Product->created_by == $User->id)
                                    <td>{{ $User->name }}</td>
                                @endif
                            @endforeach
                            <td>
                                <a href="{{ url('admin/edit-product/'.$Product->id) }}" class="btn btn-success">
                                    Edit
                                </a>

                                <a href="{{ url('admin/delete-product/'.$Product->id) }}" class="btn btn-danger">
                                    Delete
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

