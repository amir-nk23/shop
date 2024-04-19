<?php

namespace Modules\Product\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Product\Models\Category;

class CategoryController extends Controller
{


    public function index(){

        $category = Category::query()->where('status',1)->select('id','name')->with('recursiveChildren')->get();

               return \response()->success(':>',compact('category'));
    }


    public function store(Request $request)
    {

       $category = Category::query()->create([

           'name'=>$request->name,
            'parent_id'=>$request->parent_id,
            'featured'=>$request->featured,
            'status'=>$request->status,
        ]);


        return \response()->success(':>',compact('category'));

    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {


        $category->update([
            'name'=>$request->name,
            'parent_id'=>$request->parent_id,
            'featured'=>$request->featured,
            'status'=>$request->status,
        ]);

        return \response()->success(':>',compact('category'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
    }
}
