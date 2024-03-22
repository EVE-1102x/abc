@extends('layouts.master')
@section('title','Category')
@section('content')
 <div class="container-fluid px-4">
     <div class="card mt-4">
         <div class="card-header">
             <h4>
                 <a href="{{ url('admin/add-category') }}" class="btn btn-primary float-end">Add Category</a>
                 Category
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
                        <th>Name</th>
                        <th>Created by</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>

                 <tbody>
                 @foreach($category as $Category)
                     <tr>
                         <td>{{ $Category->id }}</td>
                         <td>{{ $Category->cate_name }}</td>
                         @foreach($user as $User)
                             @if($Category->created_by == $User->id)
                                 <td>{{ $User->name }}</td>
                             @endif
                         @endforeach
                         <td>
                             <a href="{{ url('admin/edit-category/'.$Category->id) }}" class="btn btn-success">
                                 Edit
                             </a>

                             <a href="{{ url('admin/delete-category/'.$Category->id) }}" class="btn btn-danger">
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

