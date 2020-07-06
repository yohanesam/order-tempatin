<?php

namespace App\Http\Controllers;

use Xendit\Xendit;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;

trait PaymentController
{
    public function createInvoice(Request $request, $orderId) {
        //read
        // Xendit::setApiKey("xnd_development_jxtjYKA1pp9FiNh0xb05C8WubQcAaIJkF43n6Rmb6LveQPkYss2uHuKXVRHy");
        //write
        Xendit::setApiKey("xnd_development_aFIpH1O1jry6rqyu0deoBaKuJ9OtcMc0AuBDSSusr0rKaTFkGJygwGSSOV6uoIcX");

        $params = [
            'external_id' => 'tempatin_payment_'.$orderId,
            'payer_email' => $request['user']['email'],
            'description' => 'Room Payment',
            'amount' => $request['cost_total'],
            'should_send_email' => true,
            'success_redirect_url' => 'https://tempatin.skripsi-tik.xyz',
        ];
        
        $createInvoice = \Xendit\Invoice::create($params);
        return $createInvoice;
    }
}