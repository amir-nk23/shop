<?php

namespace Modules\Setting\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Modules\Setting\Models\Setting;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function general(){

        $generals = Setting::query()->where('group','general')->get();
        return \response()->success(':>',compact('generals'));

    }



    public function social(){

        $social = Setting::query()->where('group','social')->get();
        return \response()->success(':>',compact('social'));


    }

    public function update(Request $request)
    {

        $input = $request->except('_token','_method');

        foreach ($input as $name => $value){

            if ($setting = Setting::where('name',$name)->first()){

                if ($setting->type=='img'&& $request->file($name)->isValid()){

                    if ($setting->value){

                        Storage::disk('public')->delete($setting->value);

                    }

                    $value =   Storage::disk('public')->put('/setting',$request->img);

                }

                $setting->update(['value'=>$value]);

            }

        }

        return \response()->success(':>');

    }


    public function destroy(Setting $setting){


        Storage::disk('public')->delete($setting->value);

        $setting->update([

            'value'=>''

        ]);


        return \response()->success(':>');

    }
}
