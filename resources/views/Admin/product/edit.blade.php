@extends('layouts.master')
@section('title','Edit Product')
@section('content')
    <div class="container-fluid px-4">
        <div class="card mt-4">
            <div class="card-header">
                <h4 class="">Edit Product</h4>
            </div>

            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $errors)
                            <div>{{ $errors }}</div>
                        @endforeach
                    </div>
                @endif

                <form action="{{ url('admin/edit-product/'.$product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="">Product Name</label>
                        <input type="text" name="prd_name" class="form-control" value="{{ $product->prd_name }}">
                    </div>

                    <div class="mb-3">
                        <label for="">Product Price</label>
                        <input type="number" name="prd_price" class="form-control" min="1" value="{{ $product->prd_price }}">
                    </div>

                    <div class="mb-3">
                        <label for="">Stock Number</label>
                        <input type="number" name="prd_quantity" class="form-control" min="1" value="{{ $product->prd_quantity }}">
                    </div>

                    <!--Category option-->
                    <div class="mb-3">
                        <label>Category</label>
                        <select name="CategoryID" class="form-control">
                            <!--lay ra category dang su dung-->
                            @foreach($category as $Category)
                                @if($product->CategoryID == $Category->id)
                                    <option value="{{ $Category-> id }}"> {{ $Category->cate_name }} </option>
                                @endif
                            @endforeach

                            <!--lay ra cac category con lai-->
                            @foreach($category as $Category)
                                @if($product->CategoryID != $Category->id)
                                    <option value="{{ $Category-> id }}"> {{ $Category->cate_name }} </option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <!--Image option-->
                    <div class="mb-3">
                        <label>Image</label>
                        <input type="file" name="prd_image" class="form-control" value="{{ $product->prd_image }}"/>
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Save Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
