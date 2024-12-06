<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Earning;

use App\Models\Payout;

use App\Models\User;

use App\Models\Transaction;

use App\Models\Domain;

class VerifyTransaction extends Controller
{
    
    /**
     * Verify payment transaction with paystack
     */

    public function verifyTx(Request $request)
    {

        $curl = curl_init();

        $reference = $request->query('reference');

        $key = config('services.paystack.key');

        curl_setopt_array($curl, array(

            CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . rawurlencode($reference),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
              "accept: application/json",
              "authorization: Bearer $key",
              "cache-control: no-cache"
            ],
          ));

          $response = curl_exec($curl);

$err = curl_error($curl);

if($err){

    // there was an error contacting the Paystack API

  die('Curl returned error: ' . $err);

}

$tranx = json_decode($response);

if(!$tranx->status){

  // there was an error from the API

  die('API returned error: ' . $tranx->message);

}

if('success' == $tranx->data->status) {

    $status = "successful";

    $sold = "sold";

    $date = date("jS \of F Y h:i:s A");

    $refInfo = Transaction::where('reference', $reference)->first();

    $d_ref = Domain::where('domain_id', $refInfo->domain_id)->first();

    $seller_id = $d_ref->id;

    $owner = $refInfo['email'];

    $get_seller = User::where('id', $seller_id )->first();

    $description = $d_ref['url'];

    $amount = $d_ref['price'];

    $finished = 1;

    $findRef = Transaction::where('finished', 1)->where('reference', $reference)->count();

    if ($findRef == 0) {

        $refInfo->update([
            'status' => $status,
        ]);

        $d_ref->update([
            'status' => 'sold',
            'owner' => $owner,
            'sold_date' => $date,
        ]);

        Payout::create([
            'reference' => $reference,
            'owner_id' => $d_ref->id,
            'amount' => $refInfo->amount,
            'description' => $description,
            'status' => 'pending',
        ]); 

        Earning::create([
            'reference' => $reference,
            'owner_id' => $d_ref->id,
            'amount' => $refInfo->amount,
            'description' => $description,
            'status' => 'complete',
        ]); 

        $refInfo->update([
            'finished' => $finished,
        ]);

    }

    return view('verifytx', compact('reference', 'findRef'));
    
}

    }

}
