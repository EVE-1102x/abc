@extends('layouts.master')
@section('title','create Category')
@section('content')

<div class="container-fluid px-4">
    <div class="card mt-4">
        <div class="card-header">
            <h4 class="">
                <a href="{{ url('admin/category') }}" class="btn btn-primary float-end">Go Back</a>
                Add Category
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

            <form action="{{ url('admin/add-category') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="">Category Name</label>
                    <input type="text" name="cate_name" class="form-control">
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Save Category</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
