<?php

namespace Modules\Home\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Modules\Product\Models\Product;
use Modules\Slider\Models\Slider;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function home(){

        $sliders = Slider::query()->where('status',1)->select('id','link','status')->latest('id')->take('4')->get();

        $lastProducts = Product::query()
            ->select('id', 'title', 'discount', 'discount_type', 'price')
            ->latest('id')
            ->take(10)
            ->get();


        $mostDiscountProducts = Product::query()->orderByDesc('discount')->take('10')->get();

        $mostViewedProducts  = Product::orderByViews()->take(10)->get();

        $mostReapetedproduct = DB::table('order_items')
            ->select('product_id', DB::raw('count(*) as product_count'))
            ->groupBy('product_id')
            ->orderBy('product_count', 'desc')
            ->take('10')->get();

            $productId = $mostReapetedproduct->pluck('product_id');


        $mostSelledProduct = Product::query()->whereIn('id',$productId)->get();



        return response()->success('',compact('sliders','lastProducts','mostDiscountProducts','mostViewedProducts','mostSelledProduct'));

    }

}
