<?php

namespace App\Http\Controllers;


use FedaPay\FedaPay;
use FedaPay\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PayoutController extends Controller
{
    public function test(Request $request)
    {
        FedaPay::setApiKey("sk_sandbox_ydYVQT90YvAEMqu_x3OMIZfb");

        /* Specify whenever you are willing to execute your request in test or live mode */
        FedaPay::setEnvironment('sandbox'); //or se
        $validate = $request->payer;
        $name = $request->firstname;
        $numero = $request->numero;
        $montant = $request->montant;
        if (isset($validate)) {
            $transaction = Transaction::create(array(
                "description" => "Transaction for john.doe@example.com",
                "amount" => $montant,
                "currency" => ["iso" => "XOF"],
                "callback_url" => "",
                "customer" => [
                    "firstname" => "$name",
                    "lastname" => "Doe",
                    "email" => "john.doe@example.com",
                    "phone_number" => [
//                    "number" => "+22997808080",
                        "number" => "+229" . $numero,
                        "country" => "bj"
                    ]
                ]
            ));
            $token = $transaction->generateToken();
//        dd('Location: ' . $token->url);
            return Redirect::away($token->url);
        }


        $transactionId = $request->id;
        if ($transactionId) {
            $transaction = Transaction::retrieve($transactionId);
//            dd($transaction->status);
            if ($transaction->status == "approved") {
                return redirect()->route('success');

            }
            if ($transaction->status == "pending") {
                return redirect()->route('get');
                // echo "Payment approved";
            }
            if ($transaction->status == "canceled") {
                return redirect()->route('get');
            }
        }
        //
        return view('welcome');
    }

    public
    function post(Request $request)
    {
        $name = $request->firstname;
        $numero = $request->numero;
        $montant = $request->montant;
//        dd('hello');
        FedaPay::setApiKey("pk_sandbox_4C6cErct8uAcha5_Hp4f8zEu");

        /* Specify whenever you are willing to execute your request in test or live mode */
        FedaPay::setEnvironment('sandbox'); //or setEnvironment('live');

        /* Create the transaction */
        $transaction = Transaction::create(array(
            "description" => "Transaction for john.doe@example.com",
            "amount" => $montant,
            "currency" => ["iso" => "XOF"],
            "callback_url" => "",
            "customer" => [
                "firstname" => "$name",
                "lastname" => "Doe",
                "email" => "john.doe@example.com",
                "phone_number" => [
//                    "number" => "+22997808080",
                    "number" => "+229" . $numero,
                    "country" => "bj"
                ]
            ]
        ));
        $token = $transaction->generateToken();
//        dd('Location: ' . $token->url);
        return Redirect::away($token->url);
//        dd($transaction);
    }

    public function success(Request $request)
    {
        FedaPay::setApiKey("sk_sandbox_ydYVQT90YvAEMqu_x3OMIZfb");

        /* Specify whenever you are willing to execute your request in test or live mode */
        FedaPay::setEnvironment('sandbox');
        $transactionId = $request->id;
        if ($transactionId) {
            $transaction = Transaction::retrieve($transactionId);
//            dd($transaction->status);
            if ($transaction->status == "approved") {
                return redirect()->route('success');
            }
            if ($transaction->status == "pending") {
                return redirect()->route('get');
                // echo "Payment approved";
            }if ($transaction->status == "declined") {
                return redirect()->route('get');
                // echo "Payment approved";
            }
            if ($transaction->status == "canceled") {
                return redirect()->route('get');
            }
        }
        return view('success');
    }
}
