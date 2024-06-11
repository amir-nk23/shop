<?php

namespace Modules\Cart\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Modules\Cart\Http\Requests\CartStoreRequest;
use Modules\Cart\Models\Cart;
use Modules\Core\App\Helpers\Helpers;
use Modules\Product\Models\Product;
use Modules\Store\Models\Store;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        $customerId = Auth::guard('customer-api')->user()->id;

        $carts = Cart::query()->where('customer_id',$customerId)->select('id','price','quantity','product_id')->with('product')->get();

     $carts =   Helpers::checkQuantityIndex($carts);


        return \response()->success('اطلاعات سبد خرید',compact('carts'));

    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(CartStoreRequest $request)
    {

        $product = Product::query()->where('id',$request->product_id);

//        Helpers::quantityCheck($request->product_id,$request->quantity);

        $stores =  Store::query()->where('product_id',$request->product_id)->get();


        foreach($stores as $store){


            if ($store->balance < $request->quantity){


                return response()->error('تعداد محصوله سبد خرید از تعداد موجودیت انبار بیشتر می باشد');


            }

        }

      $price =  Helpers::discountCheck($request->product_id);


        $cart = Cart::query()->create([

            'customer_id'=>$request->customer_id,
            'product_id'=>$request->product_id,
            'quantity'=>$request->quantity,
            'price'=> $price,

        ]);



        return \response()->success('سبد خرید با موفقیت ثبت شد',compact('cart'));

    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('cart::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('cart::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {


        Helpers::quantityCheck($request->product_id,$request->quantity);

        $cart->update([

            'product_id'=>$request->product_id,
            'price'=>$request->price,
            'quantity'=>$request->quantity,

        ]);


        return \response()->success('عملیات اپدیت سبد خرید با موفقیت انجام شد',compact('cart'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
