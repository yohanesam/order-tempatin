<?php

namespace App\Traits;

use Xendit\Xendit;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;

trait PaymentTraits
{
    public function createInvoice($user, $costTotal, $orderId) {
        //write
        Xendit::setApiKey(env('WRITE_SECRET_API_KEY'));

        $params = [
            'external_id' => 'order_tempatin_payment_'.$orderId,
            'payer_email' => $user['email'],
            'description' => 'Room Payment',
            'amount' => $costTotal,
            'should_send_email' => true,
        ];
        
        $createInvoice = \Xendit\Invoice::create($params);
        return $createInvoice;
    }

    public function getInvoice($id) {
        //read
        Xendit::setApiKey(env('READ_SECRET_API_KEY'));

        $getInvoice = \Xendit\Invoice::retrieve($id);

        return $getInvoice;
    }
}