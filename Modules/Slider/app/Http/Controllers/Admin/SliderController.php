<?php

namespace Modules\Slider\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Slider\Models\Slider;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $sliders = Slider::query()->select(['id','title','link'])->get();
        return \response()->success(':>',compact('sliders'));

    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {



        $slider = Slider::query()->create($request->only('title','link','status'));

        $slider->uploadFile($request);

//        return \response()->success(':>',compact('slider'));
        return \response()->success(':>');

    }

    /**
     * Show the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, slider $slider): RedirectResponse
    {
        $slider->update($request->only('title','link','status'));
        $slider->uploadFile($request);
        return \response()->success(':>',compact('slider'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
