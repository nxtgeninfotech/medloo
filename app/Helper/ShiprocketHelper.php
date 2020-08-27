<?php

namespace App\Helper;

use App\Order;
use App\OrderDetail;
use App\OrderShipment;
use App\User;
use Illuminate\Support\Carbon;

class ShiprocketHelper
{

    public function createOrder(Order $order, OrderShipment $orderShipment, $ids = [])
    {
        $pickup_location = "surat";
        $order_id = "142";

        $sub_total = OrderDetail::where('order_shipment_id', $orderShipment->id)
            ->selectRaw('sum(price) as total')
            ->first()->total;

        $orderDetails = [
            "order_id" => $order_id,
            "order_date" => Carbon::now(),
            "pickup_location" => $pickup_location,
            "payment_method" => $order->payment_type == "cash_on_delivery" ? "COD" : "Prepaid",
            "shipping_charges" => 0,
            "giftwrap_charges" => 0,
            "transaction_charges" => 0,
            "total_discount" => 0,
            "sub_total" => $sub_total,
        ];


        $orderDetails = array_merge($orderDetails,
            $this->getProductDetail($ids),
            $this->getBillingDetail($order),
            $this->getCourierDimensions($orderShipment)
        )


        $token = Shiprocket::token();
        $response = Shiprocket::order($token)->create($orderDetails);
    }

    public function getBillingDetail(Order $order)
    {
        $shippingDetail = $order->shipping_address;

        return [
            "billing_customer_name" => $shippingDetail->name,
            "billing_address" => $shippingDetail->address,
            "billing_city" => $shippingDetail->city,
            "billing_pincode" => $shippingDetail->postal_code,
            "billing_state" => $shippingDetail->state,
            "billing_country" => $shippingDetail->country,
            "billing_email" => $shippingDetail->email,
            "billing_phone" => $shippingDetail->phone,
            "shipping_is_billing" => true,
        ];
    }

    public function getProductDetail($ids)
    {
        foreach ($ids as $id) {
            $detail = OrderDetail::find($id);

            $array[] = [
                "name" => $detail->name,
                "sku" => $detail->id,
                "units" => $detail->quantity,
                "selling_price" => $detail->price,
                "tax" => $detail->tax
            ];
        }

        return ['order_items' => $array];
    }


    public function getCourierDimensions($orderShipment)
    {
        return [
            "length" => $orderShipment->length,
            "breadth" => $orderShipment->breadth,
            "height" => $orderShipment->height,
            "weight" => $orderShipment->weight
        ];
    }

}

?>
