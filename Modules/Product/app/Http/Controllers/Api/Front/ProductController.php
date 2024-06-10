<?php

namespace Modules\Product\Http\Controllers\Api\Front;

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

    public function index(Request $request)
    {
        $products = Product::query()
            ->with(['category:id,name'])
            ->when($request->has('title'), function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->input('title') . '%');
            })
            ->when($request->has('min_price') && $request->has('max_price'), function ($query) use ($request) {
                $query->whereBetween('price', [$request->input('min_price'), $request->input('max_price')]);
            })
            ->when($request->filled('category_id'), function ($query) use ($request) {
                $query->where('category_id', $request->input('category_id'));
            })
            ->when($request->filled('discount'), function ($query) use ($request) {
                $query->whereNotNull($request->discount);
            })
            ->latest('id')
            ->paginate();
        return response()->success('', compact('products'));
    }

    public function show(Product $product)
    {
        views($product)->record();

        $product->load([
            'category:id,name',
            'specifications:id,name',
            'specifications' => function ($query) {
                $query->select('specifications.id', 'specifications.name', 'product_specification.value as pivot_value');
            }
        ]);

        return response()->success("مشخصات محصول {$product->id}",compact('product'));
    }


}
