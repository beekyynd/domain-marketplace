<?php

namespace App\Http\Controllers;

use App\Models\Earning;

use App\Models\Payout;

use Illuminate\Support\Facades\Auth;

class FinanceController extends Controller

{
    
    /**
     * Display user earnings.
     */

     public function userFinance()

     {
 
         $userid = Auth::id(); // get user id

         // filter based on user selection
 
         if (request('view') ==="earnings") {

             $earnings = Earning::where('owner_id',$userid); // get user earnings

             $finance = $earnings->orderBy('id','desc')->paginate(5);

             $finance->appends(request()->query());
         }
 
         if (request('view') ==="payouts") {

             $payouts = Payout::where('owner_id',$userid); // get user payout

             $finance = $payouts->orderBy('id','desc')->paginate(5);

             $finance->appends(request()->query());
         }
  
         return view('dashboard.finance', compact('finance'));
 
     }
 

     
}
