@extends('layouts.master')
@section('title','Create Order Step 2')
@section('content')
    <div class="container-fluid px-4">
        <div class="card mt-4">
            <div class="card-header">
                <h4 class="">
                    <a href="{{ url('admin/add-order') }}" class="btn btn-primary float-end">Go Back</a>
                    Add Order Step 2
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

                <form action="{{ url('admin/add-order-step2') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label>Choose Product</label>
                        @for($i = 0; $i < $PrdNumber; $i++)
                            <div class="input-group mb-3">
                                <select class="form-select" name="ProductID[]" id="inputGroupSelect02">
                                    @foreach($product as $Product)
                                        @if($Product->CategoryID == $CategoryID)
                                            <option value="{{ $Product->id }}">{{ $Product->prd_name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <input class="form-control" name="PrdSold[]" type="number" min="1" placeholder="How much is sold?" required>
                            </div>
                        @endfor
                    </div>

                    <div class="mb-3">
                        <label>Order Status</label>
                        <select class="form-select" name="ord_status" id="inputGroupSelect02">
                            <option value="1">awaiting confirmation</option>
                            <option value="2">shipping</option>
                        </select>
                    </div>

                    <div hidden="hidden">
                        <input name="prd_number" value="{{ $PrdNumber }}">
                        <input name="CustomerID" value="{{ $CustomerID }}">
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Save Order</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
