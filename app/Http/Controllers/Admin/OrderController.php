<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OrderDetailFormRequest;
use App\Http\Requests\Admin\OrderFormRequest;
use App\Http\Requests\Admin\ProductFormRequest;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $employee = Employee::all();
        $user = User::all();
        $customer = Customer::all();
        $order = Order::all();

        return view('admin.order.index',
            compact('employee','user','customer','order'));
    }

    public function create()
    {
        $user = User::all();
        $category = Category::all();
        $customer = Customer::all();
        return view('admin.order.create',
            compact('category','user','customer'));
    }

    public function create_step2(OrderFormRequest $request)
    {
        $data = $request->validated();
        $CategoryID = $data['CategoryID'];
        $PrdNumber = $data['prd_number'];
        $CustomerID = $data['CustomerID'];
        $product = Product::all();

        return view('admin.order.create_step2',
            compact('CategoryID','PrdNumber','product','CustomerID'));
    }
    public function store(OrderFormRequest $request, OrderDetailFormRequest $request2)
    {
        $data = $request->validated();
        $data2 = $request2->validated();
        $order = new Order;

//      Tinh ra tong gia tien san pham
        $PrdNumber = $data['prd_number'];
        $subtotal = [];
        $prdPrice = [];
        $prdID = [];
        $prdSold = [];
        $totalPrice = 0;

        for ($i = 0; $i < $PrdNumber; $i++)
        {
//          lay ra toan bo san pham duoc chon
            $prdID[$i] = $data2['ProductID'][$i];
            $product = Product::find($prdID[$i]);
            $prdPrice[$i] = $product->prd_price;

//          Tinh ra subtotal cua tung san pham
            $prdSold[$i] = $data2['PrdSold'][$i];
            $subtotal[$i] = $prdSold[$i] * $prdPrice[$i];
            $totalPrice += $subtotal[$i];
        }

//      Them du lieu vao database
        $CustomerID = $data['CustomerID'];
        $order->ord_totalPrice = $totalPrice;
        $order->ord_status = $data['ord_status'];
        $order->CustomerID = $CustomerID;
        $order->EmployeeID = Auth::user()->id;
        $order->save();

//      Find the newest OrderID
        $newestOrderID = null;
        $AllOrder = Order::all();
        foreach ($AllOrder as $Order)
        {
            if ($newestOrderID === null || $Order->id > $newestOrderID) {
                $newestOrderID = $Order->id;
            }
        }

//      Them du lieu cho OrderDetail
        for ($i = 0; $i < $PrdNumber; $i++)
        {
            $orderdetail = new OrderDetail;
            $orderdetail->OrderID = $newestOrderID;
            $orderdetail->ProductID = $data2['ProductID'][$i];
            $orderdetail->subtotal = $subtotal[$i];
            $orderdetail->amount = $data2['PrdSold'][$i];
            $orderdetail->save();
        }

        return redirect(route('order'))->with('message','Order Add Successfully');
    }
    public function edit($order_id)
    {
        $order = Order::find($order_id);
        $product = Product::all();
        $user = User::all();
        $category = Category::all();
        $customer = Customer::all();
        $employee = Employee::all();
        $orderdetail = OrderDetail::all();

        return view('admin.order.edit',
            compact('product','category','order','user','customer','employee','orderdetail','order_id'));
    }
    public function update(OrderFormRequest $request, $order_id)
    {
        $data = $request->validated();
        $order = Order::find($order_id);

        $order->CustomerID = $data['CustomerID'];
        $order->ord_status = $data['ord_status'];
        $order->update();

        return redirect(route('order'))->with('message','Order Update Successfully');
    }
    public function delete($order_id)
    {
        $order = Order::find($order_id);
        if ($order)
        {
            // Delete related order details
            OrderDetail::where('OrderID', $order_id)->delete();

            // Delete the order
            $order->delete();

            return redirect(route('order'))->with('message','Order Deleted Successfully');
        }
        else
        {
            return redirect(route('order'))->with('message','No Order Found with the provided ID');
        }
    }

}
