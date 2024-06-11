<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Modules\Admin\Http\Requests\AdminStoreRequest;
use Modules\Admin\Http\Requests\AdminUpdateRequest;
use Modules\Admin\Models\Admin;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

//        $admins = Cache::rememberForever('admin',function (){
//
//            Admin::query()->select(['name','email','mobile'])->paginate(10);
//    });


        try {
            $admins = Admin::query()->select(['name','email','mobile'])->get();
            return \response()->success(':)',compact('admins'));

        }catch(\Exception $e){

            return \response()->error('سایت با مشکل مواجه شده است');

        }


    }

    /**
     * Show the form for creating a new resource.
     */

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminStoreRequest $request)
    {

        try {

            $admin = Admin::query()->create([

                'name'=>$request->name,
                'email'=>$request->email,
                'mobile'=>$request->mobile,
                'password'=>bcrypt($request->password),
            ]);

            return \response()->success(':)',compact('admin'));

        }catch (\Exception $e){

            return \response()->error('سایت با مشکل مواجه شده است');

        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('admin::show');
    }

    /**
     * Show the form for editing the specified resource.
     */

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminUpdateRequest $request, $id)
    {


        try {
            $admin=Admin::find($id);

            $admin->update([

                'name'=>$request->name,
                'email'=>$request->email,
                'mobile'=>$request->mobile,
                'password'=>bcrypt($request->password),
            ]);
            return \response()->success(':)',compact('admin'));
        }catch (\Exception $e){

            return \response()->error('سایت با مشکل مواجه شده است');

        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {

        $admin->delete();

        return \response()->success('ادمین با موفقیت حذف شد',compact('admin'));
    }
}
