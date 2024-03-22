@extends('layouts.master')
@section('title','Order')
@section('content')
    <div class="container-fluid px-4">
        <div class="card mt-4">
            <div class="card-header">
                <h4>
                    <a href="{{ url('admin/add-order') }}" class="btn btn-primary float-end">Add Order</a>
                    View Order
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
                        <th>Employee Name</th>
                        <th>Total Price</th>
                        <th>Status</th>
                        <th colspan="2">Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($order as $Order)
                        <tr>
                            <td>{{ $Order->id }}</td>
                            @foreach($user as $User)
                                @if($Order->EmployeeID == $User->id)
                                    <td>{{ $User->name }}</td>
                                @endif
                            @endforeach

                            <td>{{ $Order->ord_totalPrice }}$</td>

                            @if($Order->ord_status == '1')
                                <td>awaiting confirmation</td>
                            @elseif($Order->ord_status == '2')
                                <td>shipping</td>
                            @endif

                            <td>
                                <a href="{{ url('admin/edit-order/'.$Order->id) }}" class="btn btn-success">
                                    Edit
                                </a>

                                <a href="{{ url('admin/delete-order/'.$Order->id) }}" class="btn btn-danger">
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

