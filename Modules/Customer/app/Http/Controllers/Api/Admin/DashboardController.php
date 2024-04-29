<?php

namespace Modules\Customer\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Customer\Models\Customer;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $customer = Customer::query()->select(['name','mobile','email','national_code','status'])->get();

        return \response()->success('اطلاعات مشتری',compact('customer'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customer::create');
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
    public function show($id)
    {
        return view('customer::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('customer::edit');
    }

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
    public function destroy(Customer $customer)
    {

        $customer->delete();

    }
}
