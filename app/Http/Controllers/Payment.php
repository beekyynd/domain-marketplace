<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;

use App\Models\Transaction;

use Illuminate\Http\Request;

class Payment extends Controller
{
    public function processPayment(Request $request): RedirectResponse
    {

        $request->validate([

            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
        ]);

        $curl = curl_init();

        // Retrieve values from the POST request

        $email = $request->email; // Gets the 'email' value

        $domain_id = $request->domain_id;       // Gets the 'id' value

        $amount = $request->amount; // Gets the 'price' value

        $rand = random_bytes('4'); // random bytes

        $ref = bin2hex($rand); // reference id

        $status = "pending"; // set status to pending

        Transaction::create([
            'email' => $email,
            'reference' => $ref,
            'domain_id' => $domain_id,
            'amount' => $amount,
            'status' => $status,
        ]); 

        // url to go to after payment

$callback_url = 'http://127.0.0.1:8000/verifytx'; 

$key = config('services.paystack.key');

curl_setopt_array($curl, array(

  CURLOPT_URL => "https://api.paystack.co/transaction/initialize",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => json_encode([
    'amount'=>$amount * 100,
    'email'=>$email,
    'reference'=>$ref,
    'callback_url' => $callback_url
  ]),

  CURLOPT_HTTPHEADER => [
    "authorization: Bearer $key", //replace this with your own test key
    "content-type: application/json",
    "cache-control: no-cache"
  ],
));

$response = curl_exec($curl);

$err = curl_error($curl);

if($err){

  // there was an error contacting the Paystack API
  die('Curl returned error: ' . $err);

}

$tranx = json_decode($response, true);

if(!$tranx['status']){

  // there was an error from the API

  die('API returned error: ' . $tranx['message']);

}

return redirect($tranx['data']['authorization_url']);


    }
}
