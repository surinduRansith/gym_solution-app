<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    public function ShowPaymentPage($id){

        

 return view('paymentadd');

    }
}