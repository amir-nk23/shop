<?php

namespace Modules\Order\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Customer\Models\Addresses;
use Modules\Order\Models\Order;
use Modules\Order\Models\OrderItem;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('order::index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('order::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        try {

            $addressId = Addresses::query()->where('customer_id',$request->customer_id)->select('id','address')->first();
            $address = $addressId->address;
            if (filled($request->address)){

                $address = $request->address;

            }


          $order =  Order::query()->create([

                'customer_id'=>$request->customer_id,
                'address'=>$address,
                'address_id'=> $addressId->id,
                'amount'=>$request->amount,
                'description'=>$request->description,
                'status'=>'new',

            ]);

          $price =  $request->amount * $request->price;

            OrderItem::query()->create([
                'order_id'=> $order->id,
                'quantity'=>$order->amount,
                'price'=>$price,
                'status'=>'new',
                'product_id'=>$request->product_id

            ]);

            return \response()->success('سقارش با موفقیت ثبت شد');

        }catch (\Exception $exception){

            $addressId = Addresses::query()->where('customer_id',$request->customer_id)->select('id','address')->first();
            $address = $addressId->address;
            if (filled($request->address)){

                $address = $request->address;

            }


            Order::query()->create([

                'customer_id'=>$request->customer_id,
                'address'=>$address,
                'address_id'=> $addressId->id,
                'amount'=>$request->amount,
                'description'=>$request->description,
                'status'=>'failed',

            ]);


        }


    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('order::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('order::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
