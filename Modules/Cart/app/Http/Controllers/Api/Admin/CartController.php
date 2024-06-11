<?php

namespace Modules\Cart\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Cart\Models\Cart;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    /**
     * Show the specified resource.
     */
    public function show($id)
    {

        $cart = Cart::query()->where('customer_id',$id)->first();

        return \response()->success('',compact('cart'));

    }


}
