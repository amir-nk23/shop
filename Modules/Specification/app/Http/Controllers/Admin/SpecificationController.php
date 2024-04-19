<?php

namespace Modules\Specification\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Product\Models\Category;
use Modules\Specification\Models\Specification;

class SpecificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $specification = Specification::query()->where('status',1)->select(['id','name']);

        return \response()->success(':>',compact('specification'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $specification = Specification::query()->where('status',1)->select(['id','name'])->get();
        $category = Category::query()->where('status',0)->where('parent_id',null)->select('id','name')->get();

        return \response()->success(':>',compact('specification'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {

        $specification = Specification::query()->create([
           'name'=>$request->name,
            'status'=>$request->status
        ]);

        $specification->categories()->attach($request->category_id);

        return \response()->success('>',compact('specification'));

    }

    /**
     * Show the specified resource.
     */


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Specification $specification)
    {
        $specification->update([
            'name'=>$request->name,
            'status'=>$request->status
        ]);

        $specification->categories()->sync($request->category_id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Specification $specification)
    {
        $specification->categories()->detach();
        $specification->delete();
    }
}
