<?php

namespace Modules\Product\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Product\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }


    public function store(Request $request)
    {



        $product = Product::query()->create($request->only('title','category_id','description','status','price','quantity'));

        $product->uplaodProductFile($request);



        return \response()->success('عملیات با موفقیت انجام شد',compact('product'));

    }




    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {

        $product->update($request->only('title','category_id','description','status','price','quantity'));

        if ($request->hasFile('images')||$request->hasFile('image')){

            $product->uplaodProductFile($request);

        }

        return \response()->success('عملیات با موفقیت انجام شد',compact('product'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return \response()->success('عملیات با موفقیت انجام شد');
    }
}
