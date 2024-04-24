<?php

namespace Modules\Product\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Session\Store;
use Modules\Product\Http\Requests\ProductStoreRequest;
use Modules\Product\Models\Product;
use Modules\Store\Models\StoreTransaction;
use function Webmozart\Assert\Tests\StaticAnalysis\length;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::query()->select('id','title','description','status','price','quantity')->get();

        return \response()->success(':>',compact('product'));

    }


    public function store(ProductStoreRequest $request)
    {

        $product = Product::query()->create($request->only('title','category_id','description','status','price','quantity'));

        $product->uplaodProductFile($request);

       $store = \Modules\Store\Models\Store::query()->create([
            'product_id'=>$product->id,
            'balance'=>$request->quantity,
        ]);


       StoreTransaction::query()->create([
           'store_id'=> $store->id,
           'type'=>'increment',
           'quantity'=>$request->quantity,
           'description'=>$request->quantity.'افزایش موجودی به تعداد'

       ]);

        $i = 0;
        for($i; $i<count($request->spec_id);$i++){

            $product->specifications()->attach($request->spec_id[$i],['value'=>$request->value[$i]]);
        }


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

        $i = 0;
        for($i; $i<count($request->spec_id);$i++){

            $product->specifications()->sync($request->spec_id[$i],['value'=>$request->value[$i]]);
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
