<?php

namespace Modules\Slider\Http\Controllers;

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

        $sliders = Slider::query()->select(['id','title','link'])->with('image')->get();

        return \response()->success(':>',compact('sliders'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
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
    public function update(Request $request, $id): RedirectResponse
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
