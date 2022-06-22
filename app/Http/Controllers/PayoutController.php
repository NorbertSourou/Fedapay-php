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
        FedaPay::setApiKey("sk_live_kZMWB00Uv85DaiVP2eO9a1-f");

        /* Specify whenever you are willing to execute your request in test or live mode */
        FedaPay::setEnvironment('live'); //or se
        $transactionId = $request->id;
        if ($transactionId) {
            $transaction = Transaction::retrieve($transactionId);
//            dd($transaction->status);
            if ($transaction->status == "approved") {
                echo "Payment approved";
            }
            if ($transaction->status == "pending") {
                return redirect()->route('get');
                // echo "Payment approved";
            }
            if ($transaction->status == "canceled") {
                dd("dfg");
                return redirect()->route('get');
            }
        }
        //
        return view('welcome');
    }

    public
    function post(Request $request)
    {
        $name=$request->firstname;
        $numero=$request->numero;
        $montant=$request->montant;
//        dd('hello');
        FedaPay::setApiKey("sk_live_kZMWB00Uv85DaiVP2eO9a1-f");

        /* Specify whenever you are willing to execute your request in test or live mode */
        FedaPay::setEnvironment('live'); //or setEnvironment('live');

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
                    "number" => "+229".$numero,
                    "country" => "bj"
                ]
            ]
        ));
        $token = $transaction->generateToken();
//        dd('Location: ' . $token->url);
        return Redirect::away($token->url);
//        dd($transaction);
    }

}
