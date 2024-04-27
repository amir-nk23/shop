<?php

namespace Modules\Auth\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\Sanctum;
use Modules\Auth\Models\SmsToken;
use Modules\Core\App\Helpers\Helpers;
use Modules\Customer\Models\Customer;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('auth::index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function registerLogin(Request $request)
    {

        $is_register = null;
       $validate = Validator::make($request->all(),[
               'mobile'=>'required|digits:11',

       ]);

        if ($validate->fails()){
            return \response()->error($validate->errors());
        }else{

            if(Customer::where('mobile',$request->mobile)->first()){

                $is_register = 'yes';

            }else{

               $is_register = 'no';


            }


        }


        return \response()->success('عملیات با شناسایی کاربر با موفقیت انجام شد',compact('is_register'));
    }

    public function sendToken(Request $request){

        $validate = Validator::make($request->all(),[
            'mobile'=>'required|digits:11',

        ]);

        if ($validate->fails()){
            return \response()->error($validate->errors());
        }else{

            $token = Helpers::randomNumbersCode(4);

            SmsToken::updateOrCreate([

                'mobile'=>$request->mobile,
                'token'=>$token,
                'expires_at'=>Carbon::now()->addMinute()

            ]);

            return \response()->success('پیام با موفقیت ارسال شد',compact('token'));
        }


    }


    public function verify(Request $request){

        $token = SmsToken::query()->where('mobile',$request->mobile)->first();


        if($request->token == $token){



            if ($request->type == 'login'){

                $customer = Customer::query()->where('mobile',$request->mobile)->first();
                $token = $customer->createToken('authToken');
                Sanctum::actingAs($customer);

                $data = [
                    'doctor'=>$customer,
                    'access_token'=>$token->plainTextToken,
                    'token_type'=> 'Bearer'

                ];

                return \response()->success('احراز هویت کاربر انجام شد',compact('data'),'200');

            }


         return \response()->success('اخراز هویت کاربر انجام شد',null,'200');

        }else{

            return \response('کاربر کد را اشتباه وارد کرده است','400');
        }


    }

    public function register(Request $request){

        $validate = Validator::make($request->all(),[
            'name'=>'required|string',
            'mobile'=>'required|string|digits:11|starts_with:0',
            'national_code'=>'nullable|numeric|digits:10',
            'password'=>'required|confirmed'

        ]);

        if ($validate->fails()){

            return \response()->error($validate->errors());

        }else{

           $customer = Customer::query()->create([

               'name'=>$request->name,
               'mobile'=>$request->mobile,
               'national_code'=>$request->national_code,
               'password'=>bcrypt($request->password),
               'status'=>1
           ]);

           return \response()->success('مشتری با موفقیت ثبت شد',compact('customer'));

        }

    }

    public function login(Request $request){

        $validate = Validator::make($request->all(),[
            'mobile'=>'required|digits:11',
            'password'=>'required|min:6|string'
        ]);



        if ($validate->fails()){


            return \response()->error($validate->errors());

        }else{


            if (Auth::guard('customer-api')->attempt(['mobile'=>$request->mobile,'password'=>$request->password])){
                dd('hi');
                $request->session()->regenerate();

            }else {

                return back()->withErrors([
                    'validate' => 'اطلاعات وارد شده صحیح نمیباشد',
                ])->onlyInput('mobile');
            }

            $customer = Customer::query()->where('mobile',$request->input('mobile'))->first();


            $password = bcrypt($request->input('password'));

            if (!$customer ||!Hash::check($request->input('password'),$password)){

                return response()->error('اطلاعات اشتباه وارد شده است',[],422);

            }

            $token = $customer->createToken('authToken');
            Sanctum::actingAs($customer);

            $data = [
                'customer'=>$customer,
                'access_token'=>$token->plainTextToken,
                'token_type'=> 'Bearer'

            ];




            return  response()->success('کاربر با موفقیت وارد شد',compact('data'));

        }



    }

    public function logout(Request $request){

        dd(Auth::user());
        $customer = $request->user();
        $customer->currentAccessToken()->delete();

        return response()->success('کاربر با موفقیت خارج شد');
    }
}
