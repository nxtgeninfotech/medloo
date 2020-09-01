<?php

namespace Tests\Feature;

use App\Helper\ShiprocketHelper;
use App\Order;
use Seshac\Shiprocket\Shiprocket;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {

        $shipmentId = 55083617;
        $response =  Shiprocket::track(Shiprocket::getToken())->throwShipmentId($shipmentId);


        dd($response);

        $awb = 'SF86504708KR';
        $response =  Shiprocket::track(Shiprocket::getToken())->throughAwb($awb);

        dd($response);

     $res =    ShiprocketHelper::cancelShipment(['55400782']);


     dd($res);

        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
