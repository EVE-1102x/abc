<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EmployeeFormRequest;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function index()
    {
        $user = User::where('role_as', '=', '1')->get();
        $employee = Employee::all();
        return view('admin.employee.index', compact('employee','user'));
    }

    public function create()
    {
        return view('admin.employee.create');
    }

    public function store(EmployeeFormRequest $request)
    {
        $data = $request->validated();
        $user = new User;
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->save();

//      Find the newest
        $newestUserID = null;
        $users = User::all();
        foreach ($users as $Users)
        {
            if ($newestUserID === null || $Users->id > $newestUserID) {
                $newestUserID = $Users->id;
            }
        }

        $employee = new Employee;
        $employee->UserID = $newestUserID;
        $employee->user_level = $data['user_level'];
        $employee->save();

        return redirect(route('employee'))->with('message','Employee Add Successfully');
    }

    public function edit($employee_id)
    {
        $employee = Employee::find($employee_id);
        $user = User::find($employee->UserID);

        return view('admin.employee.edit', compact('employee','user'));
    }
    public function update(EmployeeFormRequest $request,$employee_id)
    {
        $employee = Employee::find($employee_id);
        $user = User::find($employee->UserID);
        $data = $request->validated();

//      Update user
        $user->name = $data['name'];
        $user->email = $data['email'];
        if ($data['password'] != null) {
            $user->password = Hash::make($data['password']);
        }
        $user->update();

//      Update Employee level
        $employee->user_level = $data['user_level'];
        $employee->update();

        return redirect(route('employee'))->with('message','Employee Update Successfully');
    }
    public function delete($employee_id)
    {
        $employee = Employee::find($employee_id);
        $user = User::find($employee->UserID);

        if ($employee && $user)
        {
            $employee->delete();
            $user->delete();
            return redirect('admin/employee')->with('message','Employee Delete Successfully');
        }
        else
        {
            return redirect('admin/employee')->with('message','No Employee ID Found');
        }
    }
}
