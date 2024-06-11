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

        $request->validate([

            'parent_id'=>'nullable|exists:categories,id',
            'featured'=>'boolean',
            'status'=>'boolean',
            'name'=>'unique:categories,name',
        ]);

       $category = Category::query()->create([

           'name'=>$request->name,
            'parent_id'=>$request->parent_id,
            'featured'=>$request->featured,
            'status'=>$request->status,
        ]);

       $category->specifications()->attach($request->spec_id);

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


        if ($category->parent_id == null){


            if(count($category->children) == 0){



                if (count($category->products)==0){


                    $category->delete();

                    return \response()->success('دسته حذف شد');

                }else{

                    return \response()->error('دسته دارای محصول می باشد');

                }

            }else{

                return \response()->error('دسته ی خواهان حذف شما سردسته است لطفا ابتدا زیر  دسته ها را حذف نمایید');


            }


        }else{


            if (count($category->products)==0){


                $category->delete();

                return \response()->success('دسته حذف شد');

            }else{

                return \response()->error('دسته دارای محصول می باشد');

            }


        }





    }
}
