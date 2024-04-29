<?php

namespace Modules\Customer\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Modules\Customer\Models\Addresses;
use Modules\Customer\Models\Customer;

class CustomerController extends Controller
{
    public function indexAddress(Customer $customer)
    {


        $customer->addresses;

        return \response()->success('لیست ادرس مشتری', compact('customer'));
    }

    public function indexStore(Request $request)
    {

        $validator = Validator::make($request->all(), [

            'customer_id' => 'required|exists:customers,id',
            'name' => 'string|max:191',
            'mobile' => 'required|string|digits:11|starts_with:0',
            'address' => 'required|string',
            'postal_code' => 'required|numeric|digits:10',
            'city_id' => 'required|exists:cities,id'
        ]);


        if ($validator->fails()) {

            return \response()->error($validator->errors());

        } else {

            $address = Addresses::query()->create($request->only(['customer_id','name','mobile','city_id','address','postal_code']));


            return \response()->success('ثبت ادرس مشتری', compact('address'));
        }


    }


    public function profile(Request $request)
    {

//        $validator = Validator::make($request->all(), [
//
//            'id' => 'required|exists:customers',
//
//        ]);



        $customer = Customer::where('id', $request->id)->select('id', 'name', 'email', 'mobile', 'national_code')->with('addresses')->get();

        return \response()->success('پروفایل مشتری', compact('customer'));



    }

    public function updateProfile(Request $request, Customer $customer)
    {



        $validate = Validator::make($request->all(), [
            'name' => 'string',
            'mobile' => 'string|digits:11|starts_with:0',
            'national_code' => 'nullable|numeric|digits:10',

        ]);

        if ($validate->fails()) {

            return \response()->error($validate->errors());

        } else {

            $customer->update([

                'name' => $request->name,
                'mobile' => $request->mobile,
                'national_code' => $request->national_code,
            ]);

            return \response()->success('مشتری با موفقیت ثبت شد', compact('customer'));
        }
    }

    public function changePassword(Request $request){


        $validator = Validator::make($request->all(), [
            'password'=>'required|confirmed'
        ]);

        if($validator->fails()){

            return \response()->error($validator->errors());


        }else{


            $customer = Customer::find($request->id);

            $customer->update(['password'=>bcrypt($request->password),]);


        }

        return \response()->success('تغییر رمز عبور مشتری با موفقیت انجام شد', compact('customer'));

    }
}
