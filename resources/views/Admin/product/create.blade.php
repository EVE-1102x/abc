@extends('layouts.master')
@section('title','create Product')
@section('content')
    <div class="container-fluid px-4">
        <div class="card mt-4">
            <div class="card-header">
                <h4 class="">Add Product</h4>
            </div>

            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $errors)
                            <div>{{ $errors }}</div>
                        @endforeach
                    </div>
                @endif

                <form action="{{ url('admin/add-product') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="">Product Name</label>
                        <input type="text" name="prd_name" class="form-control" placeholder="Enter Name" required>
                    </div>

                    <div class="mb-3">
                        <label for="">Product Price</label>
                        <input type="number" name="prd_price" class="form-control" min="1" placeholder="Price number" required>
                    </div>

                    <div class="mb-3">
                        <label for="">Stock Number</label>
                        <input type="number" name="prd_quantity" class="form-control" min="1" placeholder="Quantity" required>
                    </div>

                    <!--Category option-->
                    <div class="mb-3">
                        <label>Category</label>
                        <select name="CategoryID" class="form-control">
                            @foreach($category as $Category)
                                <option value="{{ $Category-> id }}"> {{ $Category->cate_name }} </option>
                            @endforeach
                        </select>
                    </div>

                    <!--Image option-->
                    <div class="mb-3">
                        <label>Image</label>
                        <input type="file" name="prd_image" class="form-control" required/>
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Save Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
