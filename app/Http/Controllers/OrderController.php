<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\OrderDetail;
use App\OrderSchedule;
use App\OrderFormValue;
use App\Review;
use DateTime;
use App\User;
use Xendit\Xendit;
use App\Http\Controllers\PaymentController;


class OrderController extends Controller
{
    use PaymentController;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $order = Order::create([
                'invoice_id' => '',
                'room_id' => $request['room_id'],
                'user_id' => $request['user']['id_user'],
                'cost_total' => $request['cost_total'],
                'status_order' => 'PENDING',
            ]);
            $payment = $this->createInvoice($request, $order['id_order']);

            $order->invoice_id = $payment['id'];
            $order->save();
            
            $orderId = $order['id_order'];
            
            // Convert String to Date can use code bellow
            //
            // DateTime::createFromFormat('Y-m-d H:i:s', $request['start_date'])->format('Y-m-d H:i:s')
            
            $schedule = OrderSchedule::create([
                'order_id' => $orderId,
                'start_date' => $request['start_date'],
                'end_date' => $request['end_date'],
                'start_time' => $request['start_time'],
                'end_time' => $request['end_time']
            ]);
            
            
            foreach($request['form_detail'] as $i => $form){
                $formValue = OrderFormValue::create([
                    'order_id' => $orderId,
                    'form_detail_id' => $form['form_detail_id'],
                    'nama_form' => $form['nama_form'],
                    'value' => $form['value'],
                ]);
            }

            $formValue = OrderFormValue::where('order_id', $orderId)
                                         ->get();
            return response()->json([
                'data' => [
                    'order' => $order,
                    'invoice_link' => $payment['invoice_url'],
                ],
                'error' => false,
            ]);

        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
