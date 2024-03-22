<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryFormRequest;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoyController extends Controller
{
    public function index()
    {
        $category = Category::all();
        $user = User::all();
        return view('admin.category.index',
            compact('category','user'));
    }
    public function create()
    {
        return view('admin.category.create');
    }
    public function store(CategoryFormRequest $request)
    {
        $data = $request->validated();
        $category = new Category;
        $category->cate_name = $data['cate_name'];
        $category->created_by = Auth::user()->id;
        $category->save();

        return redirect('admin/category')->with('message','Category Add Successfully');
    }
    public function edit($category_id)
    {
        $category = Category::find($category_id);
        return view('admin.category.edit', compact('category'));
    }
    public function update(CategoryFormRequest $request, $category_id)
    {
        $data = $request->validated();
        $category = Category::find($category_id);
        $category->cate_name = $data['cate_name'];
        $category->created_by = Auth::user()->id;
        $category->update();

        return redirect('admin/category')->with('message','Category Update Successfully');
    }
    public function delete($category_id)
    {
        $category = Category::find($category_id);
        if ($category)
        {
            $category->delete();
            return redirect('admin/category')->with('message','Category Delete Successfully');
        }
        else
        {
            return redirect('admin/category')->with('message','No Category ID Found');
        }
    }
}
