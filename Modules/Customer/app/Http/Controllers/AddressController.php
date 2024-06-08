<?php

namespace Modules\Customer\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Modules\Customer\Models\Address;

class AddressController extends Controller
{
    public function store(Request $request)
    {


        $customerId =Auth::guard('customer-api')->user()->id;
        try {


            $address = Address::query()->create([
                'name' => $request->name,
                'mobile' => $request->mobile,
                'address' => $request->address,
                'postal_code' => $request->postal_code,
                'city_id' => $request->city_id,
                'customer_id' => $customerId,
                'status' => $request->status,
            ]);

            return response()->success('آدرس با موفقیت ثبت شد.');
        } catch (\Exception $e) {
            return response()->error('خطا در ساخت آدرس.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(storeRequest $request,Address $address): JsonResponse
    {
        try {
            $address->update([
                'name' => $request->name,
                'mobile' => $request->mobile,
                'address' => $request->address,
                'postal_code' => $request->postal_code,
                'city_id' => $request->city_id,
                'status' => $request->status,
            ]);

            return response()->success('آدرس با موفقیت به روزرسانی شد.');
        } catch (\Exception $e) {
            return response()->error('خطا در ویرایش آدرس.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Address $address): JsonResponse
    {
        $address->delete();

        return response()->success('آدرس با موفقیت حذف شد.');
    }
}
