@extends('layouts.master')
@section('title','Edit Order')
@section('content')
    <div class="container-fluid px-4">
        <div class="card mt-4">
            <div class="card-header">
                <h4 class="">
                    <a href="{{ url('admin/order') }}" class="btn btn-primary float-end">Go Back</a>
                    Edit Order
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

                <form action="{{ url('admin/edit-order/'.$order->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label>Customer Name</label>
                        <select name="CustomerID" class="form-select">
                            <!--Loop 1 chon ra Customer hien tai-->
                            @foreach($user as $User)
                            @foreach($customer as $Customer)
                            @if($User->id == $Customer->UserID)
                                <option value="{{ $Customer->id }}">{{ $User->name }}</option>
                            @endif
                            @endforeach
                            @endforeach

                            <!--Loop 2 chon ra cac Customer con lai-->
                            @foreach($user as $User)
                            @foreach($customer as $Customer)
                            @if($User->id != $Customer->UserID && $User->role_as != 1)
                                <option value="{{ $Customer->id }}">{{ $User->name }}</option>
                            @endif
                            @endforeach
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Order Status</label>
                        <select class="form-select" name="ord_status" id="inputGroupSelect02">
                            <option value="1" {{ $order->ord_status == '1' ? 'selected':''}}>awaiting confirmation</option>
                            <option value="2" {{ $order->ord_status == '2' ? 'selected':''}}>shipping</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Manager By</label>
                        @foreach($user as $User)
                        @foreach($employee as $Employee)
                        @if($Employee->id == $User->id && $User->role_as == 1)
                            <p class="form-control">{{ $User->name }}</p>
                        @endif
                        @endforeach
                        @endforeach
                    </div>

                    <div class="mb-3">
                        <table class="table table-bordered text-center">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Price</th>
                                <th>Sub total</th>
                                <th>Category</th>
                                <th>Sold Out</th>
                                <th>Total Cost</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($orderdetail as $OrderDetail)
                            @foreach($product as $Product)
                            @if($OrderDetail->ProductID == $Product->id && $OrderDetail->OrderID == $order_id)
                                <tr>
                                    <td>{{ $Product->prd_name }}</td>
                                    <td><img src="{{ asset('uploads/prd_image/'.$Product->prd_image) }}" style="height: 108px" width="192px" alt="Img"></td>
                                    <td>{{ $Product->prd_price }}$</td>
                                    <td>{{ $OrderDetail->subtotal }}$</td>

                                    @foreach($category as $Category)
                                        @if($Product->CategoryID == $Category->id)
                                            <td>{{ $Category->cate_name }}</td>
                                        @endif
                                    @endforeach

                                    <td>{{ $OrderDetail->amount }}</td>
                                    <td>{{ $order->ord_totalPrice }}$</td>
                                </tr>
                            @endif
                            @endforeach
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Save change</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
