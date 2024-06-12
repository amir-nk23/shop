<?php

namespace Modules\Product\Http\Controllers\Api\Front;

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
}
