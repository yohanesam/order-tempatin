<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OrderSchedule;

class OrderScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $orderSchedule = OrderSchedule::where('order_id', $id)
                                         ->first();
        if($orderSchedule) {
            return response()->json([
                'data'=> $orderSchedule,
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
        $orderSchedule = OrderSchedule::where('room_id', $id)
                                         ->get();
        if($orderSchedule) {
            return response()->json([
                'data'=> $orderSchedule,
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
        //
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
