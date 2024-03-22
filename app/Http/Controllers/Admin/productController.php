<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryFormRequest;
use App\Http\Requests\Admin\ProductFormRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class productController extends Controller
{
    public function index()
    {
        $category = Category::all();
        $user = User::all();
        $product = Product::all();
        return view('admin.product.index',
            compact('category','user','product'));
    }
    public function create()
    {
        $category = Category::all();
        return view('admin.product.create', compact('category'));
    }
    public function store(ProductFormRequest $request)
    {
        $data = $request->validated();
        $product = new Product;
        $product->prd_name = $data['prd_name'];
        $product->prd_price = $data['prd_price'];
        $product->prd_quantity = $data['prd_quantity'];
        $product->CategoryID = $data['CategoryID'];

        if ($request->hasfile('prd_image'))
        {
            $file = $request->file('prd_image');
            $filename = time() . '.' .$file->getClientOriginalExtension();
            $file->move('uploads/prd_image/', $filename);
            $product->prd_image = $filename;
        }

        $product->created_by = Auth::user()->id;
        $product->save();

        return redirect(route('product'))->with('message','Product Add Successfully');
    }
    public function edit($product_id)
    {
        $product = Product::find($product_id);
        $category = Category::all();
        return view('admin.product.edit', compact('product','category'));
    }
    public function update(ProductFormRequest $request, $product_id)
    {
        $data = $request->validated();
        $product = Product::find($product_id);

        if ($request->hasfile('prd_image'))
        {
            $file = $request->file('prd_image');
            $filename = time() . '.' .$file->getClientOriginalExtension();
            $file->move('uploads/prd_image/', $filename);
            $product->prd_image = $filename;
        }

        $product->prd_name = $data['prd_name'];
        $product->prd_price = $data['prd_price'];
        $product->prd_quantity = $data['prd_quantity'];
        $product->CategoryID = $data['CategoryID'];
        $product->created_by = Auth::user()->id;
        $product->update();

        return redirect(route('product'))->with('message','Product Update Successfully');
    }
    public function delete($product_id)
    {
        $product = Product::find($product_id);
        if ($product)
        {
            $product->delete();
            return redirect(route('product'))->with('message','Product Delete Successfully');
        }
        else
        {
            return redirect(route('product'))->with('message','No Product ID Found');
        }
    }
}
