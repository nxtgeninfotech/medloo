<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
   public function order_with_prescription()
    {
    
        return view('frontend.prescription.order_with_prescription');
    }

    public function prescription_specify()
    {

    }


}
