@extends('layouts.master')
@section('title','Customer')
@section('content')
    <div class="container-fluid px-4">
        <div class="card mt-4">
            <div class="card-header">
                <h4>
                    View Customer
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
                        <th>Email</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($customer as $Customer)
                        <tr>
                            <td>{{ $Customer->id }}</td>
                            @foreach($user as $User)
                                @if($Customer->UserID == $User->id)
                                    <td>{{ $User->email }}</td>
                                @endif
                            @endforeach

                            @foreach($user as $User)
                                @if($Customer->UserID == $User->id)
                                    <td>{{ $User->name }}</td>
                                @endif
                            @endforeach

                            @if($Customer->cus_phone != null)
                                <td>{{ $Customer->cus_phone}}</td>
                            @else
                                <td>Null</td>
                            @endif

                            @if($Customer->cus_phone != null)
                                <td>{{ $Customer->cus_address}}</td>
                            @else
                                <td>Null</td>
                            @endif
                            <td>
                                <a href="{{ url('admin/edit-customer/'.$Customer->id) }}" class="btn btn-success">
                                    Detail
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

