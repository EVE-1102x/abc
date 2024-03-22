<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $user = User::where('role_as', '=', '0')->get();
        $customer = Customer::all();
        return view('admin.customer.index', compact('customer','user'));
    }

    public function edit($customer_id)
    {
        $customer = Customer::find($customer_id);
        $user = User::all();
        return view('admin.customer.edit', compact('customer','user'));
    }
}
