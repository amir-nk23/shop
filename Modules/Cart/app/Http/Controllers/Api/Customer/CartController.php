<?php

namespace Modules\Cart\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Cart\Models\Cart;
use Modules\Core\App\Helpers\Helpers;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('cart::index');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        Helpers::quantityCheck($request->product_id,$request->quantity);

        $cart = Cart::query()->create([

            'product_id'=>$request->product_id,
            'customer_id'=>$request->customer_id,
            'quantity'=>$request->quantity,
            'price'=> $request->price,

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
