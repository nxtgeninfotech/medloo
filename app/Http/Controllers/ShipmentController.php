<?php

namespace App\Http\Controllers;

use App\Helper\ShiprocketHelper;
use Illuminate\Http\Request;

class ShipmentController extends Controller
{
    public function checkServiceAbility(Request $request)
    {
        return ShiprocketHelper::checkServiceability(394210, $request->delivery_postcode);
    }
}
