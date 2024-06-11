<?php

namespace Modules\Order\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Modules\Cart\Models\Cart;
use Modules\Customer\Models\Address;
use Modules\Customer\Models\Addresses;
use Modules\Customer\Models\Customer;
use Modules\Invoice\Models\Invoice;
use Modules\Invoice\Models\Payment;
use Modules\Order\Events\CreateOrders;
use Modules\Order\Models\Order;
use Modules\Order\Models\OrderItem;
use Modules\Order\Models\OrderStatusLog;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(): JsonResponse
    {
        $orders = Order::query()
            ->latest('id')
            ->get();

        return response()->success('',compact('orders'));
    }

    public function show(Order $order): JsonResponse
    {
        return response()->success(compact('order'));
    }

    public function purchase(Request $request)
    {

        $validate = $request->validate([
            'address_id'=>'required|exists:addresses,id'
        ]);



        try {

            $address = Address::findOrFail($request->address_id);

             $addressId = $request->address_id;

            $customer = Customer::query()->whereHas('addresses',function ($query) use ($addressId){

               $query->where('id',$addressId);

            })->first();

            $carts = Cart::query()->where('customer_id',$customer->id)->get();


            $order = Order::query()->create([
                'address_id' => $address->id,
                'address' => $address,
                'amount' => $customer->totalPriceForCart(),
                'customer_id' => $customer->id,
                'status' => 'wait_for_payment'
            ]);


            foreach ($carts as $cart){

                $orderItem = OrderItem::query()->create([
                    'order_id'=>$order->id,
                    'price'=>$cart->price,
                    'quantity'=>$cart->quantity,
                    'product_id'=>$cart->product_id,
                    'status'=> 1
                ]);


                $cart->delete();

            }



//            Event::dispatch(new CreateOrders($order));

//            $driver = $request->input('driver_name');
//            $route = route('payments.verify',$driver);


            $invoice = Invoice::query()->create([
                'order_id' => $order->id,
                'amount' => $order->amount,
                'status' => 0
            ]);





            $payment = Payment::query()->create([
                'invoice_id' => $invoice->id,
                'amount' => intval($order->amount),
//                'driver' => $driver,
                'status' => 0
            ]);




            return \response()->success('سبد خرید با موفقیت ثبت شد');



        }catch(\Exception $exception){

            return response()->error('مشکلی رخ داده است: ' . $exception->getMessage(), 500);

        }
    }



//    public function verify(Request $request, string $driver): Renderable
//    {
//        $drivers = Payment::getAllDrivers();
//        $transactionId = $drivers[$driver]['options']['transaction_id'];
//
//        $message = 'خطای ناشناخته';
//        $status = 'error';
//
//        $payment = Payment::query()->where('token', $request->{$transactionId})->first();
//        $invoice = Invoice::where('payment_id',$payment->id)->first();
//        $order = Order::where('id',$invoice->order_id)->first();
//
//        DB::beginTransaction();
//        try {
//
//            if (!$payment) {
//                throw new InvoiceNotFoundException('پرداختی نامعتبر است!');
//            }
//
//            $receipt = ShetabitPayment::via($driver)
//                ->amount($payment->amount)
//                ->transactionId($payment->token)
//                ->verify();
//            //Update payment
//            $payment->update([
//                'tracking_code' => $receipt->getReferenceId(),
//                'status' => 1
//            ]);
//
//            $invoice->update([
//                'status' => 1
//            ]);
//            $order->update([
//                'status' => 'new'
//            ]);
//            OrderStatusLog::query()->create([
//                'order_id' => $order->id,
//                'status' => $order->status
//            ]);
//            DB::commit();
//
//            $message = 'پرداخت با موفقیت انجام شد.';
//            $status = 'success';
//
//
//        } catch (InvalidPaymentException|InvoiceNotFoundException $exception) {
//            DB::rollBack();
//
//            $message = $exception->getMessage();
//            //Update payment
//            $payment->update([
//                'description' => $message
//            ]);
//            //Update order status
//            if ($order->status === 'wait_for_payment') {
//                $order->update([
//                    'status' => 'failed'
//                ]);
//                OrderStatusLog::query()->create([
//                    'order_id' => $order->id,
//                    'status' => 'failed'
//                ]);
//            }
//        }
//
//        return view('order::payment.verify', compact('message', 'status', 'payment'));
//    }
}
