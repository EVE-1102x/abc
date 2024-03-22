@extends('layouts.master')
@section('title','Employee')
@section('content')
    <div class="container-fluid px-4">
        <div class="card mt-4">
            <div class="card-header">
                <h4>
                    <a href="{{ url('admin/add-employee') }}" class="btn btn-primary float-end">Add Employee</a>
                    View Employee
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
                        <th>Level</th>
                        <th colspan="2">Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($employee as $Employee)
                        <tr>
                            <td>{{ $Employee->id }}</td>
                            @foreach($user as $User)
                                @if($Employee->UserID == $User->id)
                                    <td>{{ $User->email }}</td>
                                @endif
                            @endforeach

                            @foreach($user as $User)
                                @if($Employee->UserID == $User->id)
                                    <td>{{ $User->name }}</td>
                                @endif
                            @endforeach

                            <td>
                                @if($Employee->user_level == '1')
                                    Admin
                                @else
                                    Employee
                                @endif
                            </td>

                            <td>
                                <a href="{{ url('admin/edit-employee/'.$Employee->id) }}" class="btn btn-success">
                                    Edit
                                </a>

                                <a href="{{ url('admin/delete-employee/'.$Employee->id) }}" class="btn btn-danger">
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

