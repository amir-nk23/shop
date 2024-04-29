<?php

namespace Modules\Store\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Store\Http\Requests\StoreStoreRequest;
use Modules\Store\Models\Store;
use Modules\Store\Models\StoreTransaction;
use function Sodium\increment;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $store = Store::query()->select('balance')->with(['product','storetransactions'])->get();

        return \response(':>',compact('store'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStoreRequest $request)
    {


        $store = Store::query()->where('id',$request->store_id);

        if ($request->type = 'increment'){

         $storeTA =   StoreTransaction::query()->create([

                'store_id'=>$request->store_id,
                'order_id'=>null,
                'type'=>$request->type,
                'quantity'=>$request->quantity,
                'description'=>$request->description

            ]);

            $store->increment('balance',$request->quantity);

        }else{

            $storeTA =  StoreTransaction::query()->create([

                'store_id'=>$request->store_id,
                'order_id'=>null,
                'type'=>$request->type,
                'quantity'=>$request->quantity,
                'description'=>$request->description

            ]);

            $store->decrement('balance',$request->quantity);
        }


        return \response()->success('عملیات ثبت تغییرات انبار با موفقیت انجام شد',compact('storeTA'));

    }

    public function show(Store $store){



    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
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
