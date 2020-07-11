<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\OrderDetail;
use App\FormContent;
use App\Package;
use App\Room;
use App\PromoDetail;
use App\User;
use App\Traits\PaymentTraits;


class OrderController extends Controller
{
    use PaymentTraits;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $orders = Order::where('user_id', $id)
                         ->orderBy('id_order', 'DESC')
                         ->get();
        if($orders) {
            return response()->json([
                'data'=> $orders,
                'error' => false
            ]);
        } else {
            return response()->json([
                'data' => [],
                'error' => true
            ]);
        }
    }

    public function schedule($id) {
        $orders = Order::where('room_id', $id)
                         ->whereIn('status_order', ['PENDING', 'PAID'])
                         ->orderBy('id_order', 'DESC')->get();

        if($orders) {
            return response()->json([
                'data'=> $orders,
                'error' => false
            ]);
        } else {
            return response()->json([
                'data' => [],
                'error' => true
            ]);
        }
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
        try{
            $order = Order::create([
                'user_id'=>$request['user_id'],
                'form_id'=>$request['form_id'],
                'room_id'=>$request['room_id'],
                'setup_id'=>$request['setup_id'],
                'start_date'=>$request['start_date'],
                'end_date'=>$request['end_date'],
                'promo_detail_id'=>$request['promo_detail_id'],
                'status_order'=>$request['status_order'],
            ]);

            $user = User::where('id_user', $request['user_id'])->first();

            $room = Room::with('schedule')->with('package')->find($request['room_id']);
            // echo json_encode($room);
            $schedule=$room->schedule;
            $package=$room->package;
            $data=[];
            for ($i=0; $i < count($schedule); $i++) {
                $data[$schedule[$i]->hari]=$schedule[$i];
                $data[$schedule[$i]->hari]->durasi=round((strtotime($schedule[$i]->jam_tutup)-strtotime($schedule[$i]->jam_buka))/(60 * 60));
                if($data[$schedule[$i]->hari]->durasi==24){
                    $data[$schedule[$i]->hari]->durasi=0;
                }
            }
            $schedule=$data;
            // echo json_encode($schedule);
            // echo json_encode($package);
            $start_date=strtotime($request['start_date']);
            $end_date=strtotime($request['end_date']);
            $cal_pack=[
                'hour' => 0,
                'day' => 0,
                'month' => 0,
                'year' => 0,
            ];
            $order_detail=[];
            // $order_detail=[
            //     'date_day'=>"",
            //     'jam_buka'=>"",
            //     'jam_tutup'=>""
            // ];
            // $order_detail=json_encode($order_detail);
            // return $order_detail;
            $order_no=0;
            while(date('Y m d H', $start_date) < date('Y m d H', $end_date)){

                $range_date=$end_date-$start_date;
                
                $hours  = round(($range_date) / (60 * 60));
                $days  = round(($hours) / ((24-$schedule[date('w',$start_date)+1]->durasi)));
                // echo date("Y m d H",$start_date)."=".(date('w',$start_date)+1)."|".$days." - ";
                // echo $schedule[date('w',$start_date]->durasi;

                $month=$start_date;
                $total_month=0;
                // $days_of_month=0;
                // $start_day = date("d",$start_date);
                // $end_day = date("d",$end_date);
                if($days>28){
                    while(date('Y m d', $month) < date('Y m d', $end_date))
                    {
                        $month = strtotime("+1 month", $month);
                        // $days_of_month=
                        $total_month++;
                    }
                    $month  = $total_month-1;
                }else{
                    $month=$total_month;
                }

                // $month = round(($range_date) / (60 * 60 * 24 * round($end_day-$start_day)));
                $year  = round($total_month/12);

                if($year>0){
                    $start_date = strtotime("+".$year." year", $start_date);
                    $cal_pack['year']=$year;
                }else if($month>0){
                    $start_date = strtotime("+".$month." month", $start_date);
                    $cal_pack['month']=$month;
                }else if($days>=0){
                    $date_day=date('Y-m-d',$start_date);
                    if(date("d",$start_date)==date("d",$end_date)){
                        $jam_buka=$schedule[date('w',$start_date)+1]->jam_buka;
                        $jam_tutup=date('H:i:s',$end_date);
                        $durasi=(strtotime($jam_tutup)-strtotime($jam_buka))/3600;
                    }elseif($order_no==0){
                        $jam_buka=date('H:i:s',$start_date);
                        $jam_tutup=$schedule[date('w',$start_date)+1]->jam_tutup;
                        $durasi=(strtotime($jam_tutup)-strtotime($jam_buka))/3600;
                    }else{
                        $jam_buka=$schedule[date('w',$start_date)+1]->jam_buka;
                        $jam_tutup=$schedule[date('w',$start_date)+1]->jam_tutup;
                        $durasi=12;
                    }
                    $order_detail[$order_no]=[
                        'package_id'=>null,
                        'schedule_id'=>$schedule[date('w',$start_date)+1]->id_schedule,
                        'date_day'=>$date_day,
                        'jam_buka'=>$jam_buka,
                        'jam_tutup'=>$jam_tutup,
                        'durasi'=>$durasi
                    ];
                    $order_no++;
                    $start_date = strtotime("+1 day", $start_date);
                    $cal_pack['day']=$cal_pack['day']+$days;
                // }else if($hours>=24){
                //     $start_date = strtotime("+".round($hours/24)." day", $start_date);
                //     $cal_pack['day']=$cal_pack['day']+round($hours/24);
                }else if($hours>0){
                    // $order_detail[$order_no]=["date_day"=>date('Y-m-d',$start_date)];
                    // $order_no++;
                    $start_date = strtotime("+".$hours." hour", $start_date);
                    $cal_pack['hour']=$hours;
                }
            }
            // echo json_encode($cal_pack);
            $durasi=0;
            for ($i=0; $i < count($order_detail); $i++) {
                // $order_detail[$i]['order_id']=;
                for ($j=0; $j < count($package); $j++) {
                    if($package[$j]->durasi>$durasi&&$package[$j]->durasi<$order_detail[$i]['durasi']){
                        // echo $order_detail[$i]['package_id'];
                        $order_detail[$i]['package_id']=$package[$j]->id_package;
                        $order_detail[$i]['total_package']=round($order_detail[$i]['durasi']/$package[$j]->durasi);
                    }
                }
            }
            // return json_encode($order_detail);
            // if($days>1){
            //     for ($i=0; $i < $days; $i++) {
                    
                    
            //     }
            // }else{
            //     $order_detail=[
            //     'order_id' => $order->id_order,
            //     'package_id' => $request['order_detail'][$i]['package_id'],
            //     'schedule_id' => $request['order_detail'][$i]['schedule_id'],
            //     'date_day' => ,
            //     'jam_mulai' => ,
            //     'jam_selesai' => ,
            //     'total_package' => ,
            //     ];
            // }
            $cost=0;
            for ($i=0; $i < count($order_detail); $i++) {
                $order_d=[
                  'order_id' => $order->id_order,
                  'package_id' => $order_detail[$i]['package_id'],
                  'schedule_id' => $order_detail[$i]['schedule_id'],
                  'jam_mulai' => $order_detail[$i]['jam_buka'],
                  'jam_selesai' => $order_detail[$i]['jam_tutup'],
                  'total_package' => $order_detail[$i]['total_package'],
                ];
                $package=Package::where('id_package',$order_detail[$i]['package_id'])->with(['package_detail'])->first();
                // echo json_encode($package[0]->package_detail[0]->harga);
                $cost=$cost+floatval($package->package_detail[0]->harga);
                // break;
                OrderDetail::create($order_d);
                $o_d[$i]=$order_d;
            }
            $order->cost_total=$cost;

            $payment = $this->createInvoice($user, $order->cost_total, $order['id_order']);
            $order->invoice_id = $payment['id'];
            $order->save();
            
            for ($i=0; $i < count($request['form_content']); $i++) {
                // $form_detail=FormDetail::find($request['form_content'][$i]['form_detail_id']);
                // $default_value=$form_detail->??
                // $request['form_content'][$i]['value']==""?: $default_value
                $form_content=[
                  'order_id' => $order->id_order,
                  'form_detail_id' => $request['form_content'][$i]['form_detail_id'],
                  'value' => $request['form_content'][$i]['value'],
                ];
                FormContent::create($form_content);
                $f_c[$i]=$form_content;
            }
            $order->order_detail=$o_d;
            $order->form_content=$f_c;
            return response()->json([
                'data' => $order,
                'error' => false
            ]);
        }catch(Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e
            ]);
        }
    }
    
    public function preview(Request $request)
    {
        try{
            $order = [
                'user_id'=>$request['user_id'],
                'form_id'=>$request['form_id'],
                'room_id'=>$request['room_id'],
                'setup_id'=>$request['setup_id'],
                'start_date'=>$request['start_date'],
                'end_date'=>$request['end_date'],
                'promo_detail_id'=>$request['promo_detail_id'],
                'status_order'=>$request['status_order'],
                'cost_total'=>0
            ];
            // dd($order['start_date']);
            $room = Room::with('schedule')->with('package')->find($request['room_id']);
            // echo json_encode($room);
            $schedule=$room->schedule;
            $package=$room->package;
            $data=[];
            for ($i=0; $i < count($schedule); $i++) {
                $data[$schedule[$i]->hari]=$schedule[$i];
                $data[$schedule[$i]->hari]->durasi=round((strtotime($schedule[$i]->jam_tutup)-strtotime($schedule[$i]->jam_buka))/(60 * 60));
                if($data[$schedule[$i]->hari]->durasi==24){
                    $data[$schedule[$i]->hari]->durasi=0;
                }
            }
            $schedule=$data;
            // echo json_encode($schedule);
            // echo json_encode($package);
            $start_date=strtotime($request['start_date']);
            $end_date=strtotime($request['end_date']);
            $cal_pack=[
                'hour' => 0,
                'day' => 0,
                'month' => 0,
                'year' => 0,
            ];
            $order_detail=[];
            $order_no=0;
            while(date('Y m d H', $start_date) < date('Y m d H', $end_date)){

                $range_date=$end_date-$start_date;
                
                $hours  = round(($range_date) / (60 * 60));
                $days  = round(($hours) / ((24-$schedule[date('w',$start_date)+1]->durasi)));
                // echo date("Y m d H",$start_date)."=".(date('w',$start_date)+1)."|".$days." - ";
                // echo $schedule[date('w',$start_date]->durasi;

                $month=$start_date;
                $total_month=0;
                // $days_of_month=0;
                // $start_day = date("d",$start_date);
                // $end_day = date("d",$end_date);
                if($days>28){
                    while(date('Y m d', $month) < date('Y m d', $end_date))
                    {
                        $month = strtotime("+1 month", $month);
                        // $days_of_month=
                        $total_month++;
                    }
                    $month  = $total_month-1;
                }else{
                    $month=$total_month;
                }

                // $month = round(($range_date) / (60 * 60 * 24 * round($end_day-$start_day)));
                $year  = round($total_month/12);

                if($year>0){
                    $start_date = strtotime("+".$year." year", $start_date);
                    $cal_pack['year']=$year;
                }else if($month>0){
                    $start_date = strtotime("+".$month." month", $start_date);
                    $cal_pack['month']=$month;
                }else if($days>=0){
                    $date_day=date('Y-m-d',$start_date);
                    if(date("d",$start_date)==date("d",$end_date)){
                        $jam_buka=$schedule[date('w',$start_date)+1]->jam_buka;
                        $jam_tutup=date('H:i:s',$end_date);
                        $durasi=(strtotime($jam_tutup)-strtotime($jam_buka))/3600;
                    }elseif($order_no==0){
                        $jam_buka=date('H:i:s',$start_date);
                        $jam_tutup=$schedule[date('w',$start_date)+1]->jam_tutup;
                        $durasi=(strtotime($jam_tutup)-strtotime($jam_buka))/3600;
                    }else{
                        $jam_buka=$schedule[date('w',$start_date)+1]->jam_buka;
                        $jam_tutup=$schedule[date('w',$start_date)+1]->jam_tutup;
                        $durasi=12;
                    }
                    $order_detail[$order_no]=[
                        'package_id'=>null,
                        'schedule_id'=>$schedule[date('w',$start_date)+1]->id_schedule,
                        'date_day'=>$date_day,
                        'jam_buka'=>$jam_buka,
                        'jam_tutup'=>$jam_tutup,
                        'durasi'=>$durasi
                    ];
                    $order_no++;
                    $start_date = strtotime("+1 day", $start_date);
                    $cal_pack['day']=$cal_pack['day']+$days;
                }else if($hours>0){
                    $start_date = strtotime("+".$hours." hour", $start_date);
                    $cal_pack['hour']=$hours;
                }
            }
            // echo json_encode($cal_pack);
            $durasi=0;
            for ($i=0; $i < count($order_detail); $i++) {
                for ($j=0; $j < count($package); $j++) {
                    if($package[$j]->durasi>$durasi&&$package[$j]->durasi<$order_detail[$i]['durasi']){
                        // echo $order_detail[$i]['package_id'];
                        $order_detail[$i]['package_id']=$package[$j]->id_package;
                        $order_detail[$i]['total_package']=round($order_detail[$i]['durasi']/$package[$j]->durasi);
                    }
                }
            }
            // return json_encode($order_detail);
            $cost=0;
            for ($i=0; $i < count($order_detail); $i++) {
                $order_d=[
                  'package_id' => $order_detail[$i]['package_id'],
                  'schedule_id' => $order_detail[$i]['schedule_id'],
                  'jam_mulai' => $order_detail[$i]['jam_buka'],
                  'jam_selesai' => $order_detail[$i]['jam_tutup'],
                  'total_package' => $order_detail[$i]['total_package'],
                ];
                $package=Package::where('id_package',$order_detail[$i]['package_id'])->with(['package_detail'])->first();
                // echo json_encode($package[0]->package_detail[0]->harga);
                $cost=$cost+floatval($package->package_detail[0]->harga);
                // break;
                $o_d[$i]=$order_d;
            }
            $order['cost_total']=$cost;
            for ($i=0; $i < count($request['form_content']); $i++) {
                // $form_detail=FormDetail::find($request['form_content'][$i]['form_detail_id']);
                // $default_value=$form_detail->??
                // $request['form_content'][$i]['value']==""?: $default_value
                $form_content=[
                  'form_detail_id' => $request['form_content'][$i]['form_detail_id'],
                  'value' => $request['form_content'][$i]['value'],
                ];
                $f_c[$i]=$form_content;
            }
            $order['order_detail']=$o_d;
            $order['form_content']=$f_c;
            return response()->json([
                'data' => $order,
                'error' => false
            ]);
        }catch(Exception $e) {
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
        $order=Order::with(['order_detail'])->with('form_content')->find($id);
        if(request()->segment(1)=='api'){
            if($order){
                $form = $order->form_content;
                foreach($form as $i => $item){
                    $form[$i]['input_awal'] = json_decode($item['input_awal']);
                }

                $order->form_content = $form;
                $invoice = $this->getInvoice($order->invoice_id);
                return response()->json([
                    'data'=> [
                        'order' => $order,
                        'invoice' => $invoice
                    ],
                    'error' => false
                ]);
            } else {
                return response()->json([
                    'error' => true
                ]);
            }
        }
    }

    public function callback(Request $request) 
    {
        // $order = Order::where('invoice_id', $request['id'])->first();
        // if($order->status_order != $request['status']) {
        //     $order->status_order = $request['status'];
        //     $order->save();
        //     return response()->json([
        //         'error' => false
        //     ]);
        // } else {
        //     return response()->json([
        //         'error' => true
        //     ]);
        // }
        return response()->json([
            'data' => $request,
            'error' => false
        ]);
    }

    public function callback_test(Request $request) 
    {
        return response()->json([
            'data' => $request,
            'error' => false
        ]);
    }

    public function expired_payment(Request $request) 
    {
        $order = Order::where('invoice_id', $request['invoice_id'])->first();
        if($order->invoice_url != 'EXPIRED') {
            $payment = $this->expiredInvoice($request['invoice_id']);
            return response()->json([
                'error' => false
            ]);
        } else {
            return response()->json([
                'error' => true
            ]);
        }

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
        try{
            $order = Order::find($id);
            $order->delete();
            $order_detail = OrderDetail::where('order_id',$id);
            $order_detail->delete();
            $form_content = FormContent::where('order_id',$id);
            $form_content->delete();

            // return redirect()->back()->with('success', 'order telah berhasil dihapus');
        }catch(Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e
            ]);
        }
    }
}
