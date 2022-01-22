<?php
/**
 * Digistore24 REST api example: Buyurl handling
 * @author Christian Neise
 * @version 1.0
 * @link https://docs.digistore24.com/api-de/
 *
 * This example retrieves details on a purchase from the Digistore24 server.
 *
 */

/*

Copyright (c) 2022 

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and
associated documentation files (the "Software"), to deal in the Software without restriction,
including without limitation the rights to use, copy, modify, merge, publish, distribute,
sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or
substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT
NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE
SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/

define( 'YOUR_API_KEY', '123-xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx' ); // replace by your api key (permission: "readonly" or "writable") - see https://www.digistore24.com/vendor/settings/account_access/api

define( 'YOUR_PRODUCT_ID', 123 ); // replace 123 by your product id

require_once '../ds24_api.php';

try
{
    $api = DigistoreApi::connect( YOUR_API_KEY );

    $product_id = YOUR_PRODUCT_ID;

    $buyer = array(
        'email'         => 'somename@somedomain.com',
        'first_name'    => 'Claus',
        'last_name'     => 'Myers',
        'readonly_keys' => 'email_and_name',
    );

    // 7 days trial period for 1,- EUR, then 27 EUR monthly:
    $payment_plan = array(
        'first_amount'  => 1.00,
        'other_amounts' => 27.00,
        'first_billing_interval' => '7_day',
        'other_billing_intervals' => '1_month',
    );

    $tracking = array(
        'custom'    => 'some parameter'
        // 'affiliate' => 'some_digistore24_id',
    );

    $valid_until = '2h'; // expires two hours after creation


    $urls = array(
        'fallback_url' => 'http://some-domain.com',
    );

    $placeholders = array();

    $settings = array();

    $data = $api->createBuyUrl( $product_id, $buyer, $payment_plan, $tracking, $valid_until, $urls, $placeholders, $settings );

    $url = $data->url; // redirect the visitor to this $url to buy the product

    echo "Now visit: $url\n";

    $api->disconnect();

}

catch (DigistoreApiException $e)
{
    $error_message = $e->getMessage();

    echo "Error: $error_message\n";
}