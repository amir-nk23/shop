<?php

namespace Modules\Auth\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\Sanctum;
use Modules\Admin\Models\Admin;
use Modules\Customer\Models\Customer;

class AuthController extends Controller
{

    public function login(Request $request){

        $validate = Validator::make($request->all(),[
            'mobile'=>'required|digits:11',
            'password'=>'required|min:6|string'
        ]);



        if ($validate->fails()){


            return \response()->error($validate->errors());

        }else{



            if ($admin = Admin::query()->where('mobile',$request->input('mobile'))->first()){

                $password = bcrypt($request->input('password'));

                if (!$admin ||!Hash::check($request->input('password'),$password)){

                    return response()->error('اطلاعات اشتباه وارد شده است',[],422);

                }

                $token = $admin->createToken('authToken');
                Sanctum::actingAs($admin);

                $data = [
                    'admin'=>$admin,
                    'access_token'=>$token->plainTextToken,
                    'token_type'=> 'Bearer'

                ];




                return  response()->success('کاربر با موفقیت وارد شد',compact('data'));

            }else{

                return response()->error('اطلاعات اشتباه وارد شده است',[],422);

            }




        }



    }

    public function logout(Request $request){

        $customer = Auth::guard('admin-api')->user();
        $customer->currentAccessToken()->delete();

        return response()->success('کاربر با موفقیت خارج شد');
    }
}
