@extends('layouts.master')
@section('title','Edit Category')
@section('content')

    <div class="container-fluid px-4">
        <div class="card mt-4">
            <div class="card-header">
                <h4>
                    <a href="{{ url('admin/category') }}" class="btn btn-primary float-end">Go Back</a>
                    Edit Category
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

                <form action="{{ url('admin/edit-category/'.$category->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="">Category Name</label>
                        <input type="text" name="cate_name" class="form-control" value="{{ $category->cate_name }}">
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Save Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
