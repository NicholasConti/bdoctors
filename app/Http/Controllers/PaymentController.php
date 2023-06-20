<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Braintree\Gateway;

class PaymentController extends Controller
{
    protected $gateway;

    public function __construct()
    {
        $this->gateway = new Gateway([
            'environment' => env('BRAINTREE_ENV'),
            'merchantId' => env('BRAINTREE_MERCHANT_ID'),
            'publicKey' => env('BRAINTREE_PUBLIC_KEY'),
            'privateKey' => env('BRAINTREE_PRIVATE_KEY')
        ]);
    }
    
    public function showPaymentForm()
    {
        $test = $this->gateway;
        return view('doctor.form', compact('test'));
    }

    public function processPayment(Request $request)
    {
        $nonce = $request->input('payment_method_nonce');
        $amount = 10.00; // Importo di esempio, puoi sostituirlo con la logica appropriata

        $result = $this->gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        if ($result->success) {
            // Pagamento riuscito
            return redirect()->route('payment.success');
        } else {
            // Pagamento fallito
            $error = $result->message;
            return redirect()->route('payment.failure')->with('error', $error);
        }
    }
}
