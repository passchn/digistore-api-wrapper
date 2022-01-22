<?php
/**
 * Digistore24 REST api example: Purchase details
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


require_once '../ds24_api.php';

try
{
    $api = DigistoreApi::connect( YOUR_API_KEY );

    $data = $api->listPurchases( '-7d', 'now' ); // purchases of the last 7 days

    $purchase_list = $data->purchase_list;

    foreach ($purchase_list as $one)
    {
        $purchase_id = $one->id;

        $data = $api->getPurchase( $purchase_id );

        echo "\n\nDetails on purchase $purchase_id:\n";

        print_r( $data );
    }

    $api->disconnect();

}

catch (DigistoreApiException $e)
{
    $error_message = $e->getMessage();

    echo "Error: $error_message\n";
}