<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Order_Detail;
use App\Models\Products;
use App\Models\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Products::all();
        $orders = Order::all();
        
        // Last Order Details
        $lastID = Order_Detail::max('order_id');
        $order_receipt = Order_Detail::where('order_id', $lastID)->get();

        // Get buyer information from the latest order
        $latestOrder = Order::latest()->first();
        $buyerName = $latestOrder ? $latestOrder->name : null;
        $buyerPhone = $latestOrder ? $latestOrder->phone : null;
        
        return view('orders.index', 
        ['products' => $products, 
        'orders' => $orders,
        'buyerName' => $buyerName,
        'buyerPhone' => $buyerPhone,
        'order_receipt' => $order_receipt]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request->all();

        DB::transaction(function () use ($request){
        
            //Order Modal
            $orders = new Order;
            $orders->name = $request->customer_name;
            $orders->phone = $request->customer_phone;
            $orders->save();
            $order_id = $orders->id;

            //Order Details Modal
            for ($product_id = 0; $product_id < count($request->product_id); $product_id++) { 
                
                $order_details = new Order_Detail;
                $order_details->order_id = $order_id;
                $order_details->product_id = $request->product_id[$product_id];
                $order_details->unitprice = $request->price[$product_id];
                $order_details->quantity = $request->quantity[$product_id];
                $order_details->discount = $request->discount[$product_id];
                $order_details->amount = $request->total_amount[$product_id];
                $order_details->save();
            
            }

            //Transaction Modal
            $transactions = new Transactions;
            $transactions->order_id = $order_id;
            $transactions->user_id = auth()->user()->id;
            $transactions->balance = $request->balance;
            $transactions->paid_amount = $request->paid_amount;
            $transactions->payment_method = $request->payment_method;
            $transactions->transac_amount = $order_details->amount;
            $transactions->transac_date = now();
            $transactions->save();

            // Last Order History
            $products = Products::all();
            $order_details = Order_Detail::where('order_id', $order_id)->get();
            $orderedBy = Order::where('id', $order_id)->get();

            return view('orders.index', 
            [
                'products' => $products,
                'order_details' => $order_details,
                'customer_orders' => $orderedBy
            ]);
        });

        return back()->with("Product orders fails to inserted. Check your inputs!");

    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
