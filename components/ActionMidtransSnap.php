<?php

namespace app\components;
use app\components\ActionMidtransConfig;
use app\components\ActionMidtransSanitizer;
use app\components\ActionMidtransApiRequestor;
use Exception;

/**
 * Create Snap payment page and return snap token
 */
class ActionMidtransSnap
{
    /**
     * Create Snap payment page
     *
     * Example:
     *
     * ```php
     *   
     *   namespace Midtrans;
     * 
     *   $params = array(
     *     'transaction_details' => array(
     *       'order_id' => rand(),
     *       'gross_amount' => 10000,
     *     )
     *   );
     *   $paymentUrl = Snap::getSnapToken($params);
     * ```
     *
     * @param  array $params Payment options
     * @return string Snap token.
     * @throws Exception curl error or midtrans error
     */
    public static function getSnapToken($params)
    {
        return (ActionMidtransSnap::createTransaction($params)->token);
    }

    /**
     * Create Snap URL payment
     *
     * Example:
     *
     * ```php
     *
     *   namespace Midtrans;
     *
     *   $params = array(
     *     'transaction_details' => array(
     *       'order_id' => rand(),
     *       'gross_amount' => 10000,
     *     )
     *   );
     *   $paymentUrl = Snap::getSnapUrl($params);
     * ```
     *
     * @param  array $params Payment options
     * @return string Snap redirect url.
     * @throws Exception curl error or midtrans error
     */
    public static function getSnapUrl($params)
    {
        return (ActionMidtransSnap::createTransaction($params)->redirect_url);
    }

    /**
     * Create Snap payment page, with this version returning full API response
     *
     * Example:
     *
     * ```php
     *   $params = array(
     *     'transaction_details' => array(
     *       'order_id' => rand(),
     *       'gross_amount' => 10000,
     *     )
     *   );
     *   $paymentUrl = Snap::getSnapToken($params);
     * ```
     *
     * @param  array $params Payment options
     * @return object Snap response (token and redirect_url).
     * @throws Exception curl error or midtrans error
     */
    public static function createTransaction($params)
    {
        $payloads = array(
            'credit_card' => array(
                // 'enabled_payments' => array('credit_card'),
                'secure' => ActionMidtransConfig::$is3ds
            )
        );

        if (isset($params['item_details'])) {
            $gross_amount = 0;
            foreach ($params['item_details'] as $item) {
                $gross_amount += $item['quantity'] * $item['price'];
            }
            $params['transaction_details']['gross_amount'] = $gross_amount;
        }

        if (ActionMidtransConfig::$isSanitized) {
            ActionMidtransSanitizer::jsonRequest($params);
        }

        $params = array_replace_recursive($payloads, $params);

        return ActionMidtransApiRequestor::post(
            ActionMidtransConfig::getSnapBaseUrl() . '/transactions',
            ActionMidtransConfig::$serverKey,
            $params
        );
    }
}
