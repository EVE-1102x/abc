@extends('layouts.master')
@section('title','Edit Employee')
@section('content')
    <div class="container-fluid px-4">
        <div class="card mt-4">
            <div class="card-header">
                <h4>
                    <a href="{{ url('admin/employee') }}" class="btn btn-primary float-end">Go Back</a>
                    Edit Employee
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

                <form action="{{ url('admin/edit-employee/'.$employee->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" id="email" name="email" class="form-control" value="{{ $user->email }}">
                    </div>

                    <div class="mb-3">
                        <label>User Name</label>
                        <input type="text" id="name" name="name" class="form-control" value="{{ $user->name }}">
                    </div>

                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Enter new password if needed">
                    </div>

                    <div class="mb-3">
                        <label>Level</label>
                        <select name="user_level" class="form-select">
                            <option value="2" {{ $employee->user_level == '2' ? 'selected':''}}>Employee</option>
                            <option value="1" {{ $employee->user_level == '1' ? 'selected':''}}>Admin</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Add New</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
