<?php

namespace app\components;

use Midtrans;
use app\components\ActionMidtransConfig;
use app\components\ActionMidtransSnap;
// $yii =dirname(__FILE__,6) .'/htdocs/isalam/vendor/midtrans/midtrans-php/Midtrans.php';
// require_once($yii);


// Set Your server key
// can find in Merchant Portal -> Settings -> Access keys


//production
ActionMidtransConfig::$serverKey = 'SB-Mid-server-p3ZzM1j-K9nV7SPkk5YQz-Gk';
ActionMidtransConfig::$clientKey = 'SB-Mid-client-ypKnWBuT86eKm1lC';

//sandobox
// ActionMidtransConfig::$serverKey = 'SB-Mid-server-LWT_5RGvHlROlIbmaE8K0ntb';
// ActionMidtransConfig::$clientKey = 'SB-Mid-client-lrPe45BCGoT9yG2O';

// non-relevant function only used for demo/example purpose

// Uncomment for production environment
ActionMidtransConfig::$isProduction = false;

// Enable sanitization
ActionMidtransConfig::$isSanitized = true;

// Enable 3D-Secure
ActionMidtransConfig::$is3ds = true;

// Uncomment for append and override notification URL
// Config::$appendNotifUrl = "https://example.com";
// Config::$overrideNotifUrl = "https://example.com";

// Required
// $transaction_details = array(
//     'order_id' => rand(),
//     'gross_amount' => 94000, // no decimal allowed for creditcard
// );

// // Optional
// $item1_details = array(
//     'id' => 'a1',
//     'price' => 18000,
//     'quantity' => 3,
//     'name' => "Apple"
// );

// // Optional
// $item2_details = array(
//     'id' => 'a2',
//     'price' => 20000,
//     'quantity' => 2,
//     'name' => "Orange"
// );


class ActionMidtrans
{

    public static function toReadableOrder($item1_details, $transaction_details,$customer_details,$shipping_address)
    {
        // $item_details = array($item1_details);
        $item_details = $item1_details;

        // Optional
        // $billing_address = array(
        //     'first_name'    => "Andri",
        //     'last_name'     => "Litani",
        //     'address'       => "Mangga 20",
        //     'city'          => "Jakarta",
        //     'postal_code'   => "16602",
        //     'phone'         => "081122334455",
        //     'country_code'  => 'IDN'
        // );

        // // Optional
        // $shipping_address = array(
        //     'first_name'    => "Obet",
        //     'last_name'     => "Supriadi",
        //     'address'       => "Manggis 90",
        //     'city'          => "Jakarta",
        //     'postal_code'   => "16601",
        //     'phone'         => "08113366345",
        //     'country_code'  => 'IDN'
        // );

        // Optional
        // $customer_details = array(
        //     'first_name'    => "Andri",
        //     'last_name'     => "Litani",
        //     'email'         => "andri@litani.com",
        //     'phone'         => "081122334455",
        //     'billing_address'  => $billing_address,
        //     'shipping_address' => $shipping_address
        // );

        // Optional, remove this to display all available payment methods
        // $enable_payments = array('credit_card','cimb_clicks','mandiri_clickpay','echannel');

        // Fill transaction details
        $transaction = array(
            // 'enabled_payments' => $enable_payments,
            'transaction_details' => $transaction_details,
            'customer_details' => $customer_details,
            'item_details' => $item_details,
            'shipping_address' => $shipping_address
        );

        $snap_token = '';
        try {
            $snap_token = ActionMidtransSnap::getSnapToken($transaction);
             return $snap_token;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
        // echo json_encode($transaction);
    }
}

// Optional
