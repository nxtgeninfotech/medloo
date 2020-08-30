<?php

namespace App\Helper;

use App\Order;
use App\OrderDetail;
use App\OrderShipment;
use App\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;
use Seshac\Shiprocket\Shiprocket;

class ShiprocketHelper
{

    public static function createOrder(Order $order, OrderShipment $orderShipment)
    {
        $ids = $order->orderDetails()->where('seller_id', Auth::user()->id)->get()->pluck('id');

        $pickup_location_code = "test";
        $order_id = $order->id;

        $sub_total = OrderDetail::where('seller_id', Auth::user()->id)
            ->selectRaw('sum(price) as total')
            ->first()->total;

        $orderDetails = [
            "order_id" => $order->getShipmentOrderID(),
            "order_date" => Carbon::today(),
            "pickup_location" => $pickup_location_code,
            "payment_method" => $order->payment_type == "cash_on_delivery" ? "COD" : "Prepaid",
            "shipping_charges" => 0,
            "giftwrap_charges" => 0,
            "transaction_charges" => 0,
            "total_discount" => 0,
            "sub_total" => $sub_total,
        ];

        $orderDetails = array_merge($orderDetails,
            self::getProductDetail($ids),
            self::getBillingDetail($order),
            self::getCourierDimensions($orderShipment)
        );

        return Shiprocket::order(Shiprocket::getToken())->create($orderDetails);
    }

    public static function getBillingDetail(Order $order)
    {
        $shippingDetail = json_decode($order->shipping_address);

        return [
            "billing_customer_name" => $shippingDetail->name,
            "billing_last_name" => "",
            "billing_address" => $shippingDetail->address,
            "billing_city" => $shippingDetail->city,
            "billing_pincode" => $shippingDetail->postal_code,
            "billing_state" => $shippingDetail->state ?? 'gujarat',
            "billing_country" => $shippingDetail->country,
            "billing_email" => $shippingDetail->email,
            "billing_phone" => $shippingDetail->phone,
            "shipping_is_billing" => true,
        ];
    }

    public static function getProductDetail($ids)
    {
        foreach ($ids as $id) {
            $detail = OrderDetail::with('product')->where('id', $id)->first();

            $array[] = [
                "name" => $detail->product->name,
                "sku" => Str::slug($detail->product->name),
                "units" => $detail->quantity,
                "selling_price" => $detail->product->price,
                "tax" => $detail->tax
            ];
        }

        return ['order_items' => $array];
    }


    public static function getCourierDimensions($orderShipment)
    {
        return [
            "length" => $orderShipment->length,
            "breadth" => $orderShipment->breadth,
            "height" => $orderShipment->height,
            "weight" => $orderShipment->weight
        ];
    }


    public static function createPickupLocation()
    {
        $newLocation = [
            'pickup_location' => 'test',  //pickup code
            'name' => 'manish pareek',
            'email' => 'pareek.manish557@gmail.com',
            'phone' => '8866785457',
            'address' => '302 , ashanager , udhana ',
            'city' => 'surat',
            'state' => 'gujarat',
            'country' => 'india',
            'pin_code' => '394210'
        ];

        //response has "id" also
        return Shiprocket::pickup(Shiprocket::getToken())->addLocation($newLocation);
    }

    public static function cancelShipment($ids)
    {
        $response = Shiprocket::order(Shiprocket::getToken())->cancel(['ids' => $ids]);

        if ($response['status_code'] == 200) {
            OrderShipment::whereIn('order_id', $ids)->update([
                'cancelled_at' => Carbon::now()
            ]);
        }
    }

    public static function checkServiceability($pickup_postcode, $delivery_postcode)
    {
        $pincodeDetails = [
            "pickup_postcode" => $pickup_postcode,
            "delivery_postcode" => $delivery_postcode,
            "cod" => 1,
            "weight" => "1"
        ];

        $response = Shiprocket::courier(Shiprocket::getToken())->checkServiceability($pincodeDetails)->toArray();

        $res = [
            'message' => "avaliable",
            'status' => true
        ];

        if (isset($response['status']) && $response['status'] == '404') {
            $res = ['message' => 'Delivery pincode not serviceable', 'status' => false];
        }

        if (isset($response['status_code']) && $response['status_code'] == 422) {
            $res = ['message' => 'Invalid Delivery Pincode', 'status' => false];
        }

        return $res;
    }

}

?>
