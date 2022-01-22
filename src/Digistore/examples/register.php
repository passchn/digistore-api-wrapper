<?php
/**
 * Digistore24 REST api example: Rebilling example
 * @author Christian Neise
 * @version 1.0
 * @link https://docs.digistore24.com/api-de/
 *
 * This examples demonstrates, how a user connects his account of your application to his Digistore24 account.
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

define( 'YOUR_DEVELOPER_API_KEY', '456-xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx' ); // replace by your api key (permission: "developer") - see https://www.digistore24.com/vendor/settings/account_access/api

require '../ds24_api.php';

$permissions = DS_API_READONLY;    // Permission of the new api key: DS_API_READONLY or DS_API_WRITABLE

$current_url = (empty( $_SERVER['HTTPS'] ) ? 'http://' : 'https://' )
             . $_SERVER['HTTP_HOST']
             . $_SERVER['SCRIPT_NAME'];

session_start();


$is_requesting = !empty( $_GET[ 'ds24_do_connect' ] );
$is_returning  = !empty( $_GET[ 'ds24_connected' ] ) && $_GET[ 'ds24_connected' ] == 'Y';
$is_aborting   = !empty( $_GET[ 'ds24_connected' ] ) && $_GET[ 'ds24_connected' ] != 'Y';


if (!$is_requesting && !$is_returning && !$is_aborting)
{
    //
    // Step 1. Show connection button
    //
    $url = "$current_url?ds24_do_connect=1";
    echo "<a href='$url'>Connect to Digistore24</a>";
}
elseif ($is_requesting)
{
    //
    // Step 2. After the User clicked on the "Connect to Digistore24" link, initialize the api key generation request
    //         and redirect the user to Digistore24
    //
    try
    {
        $return_url = "$current_url?ds24_connected=Y";
        $cancel_url = "$current_url?ds24_connected=N";

        $developer_api = DigistoreApi::connect( YOUR_DEVELOPER_API_KEY );
        $data = $developer_api->requestApiKey( $permissions, $return_url, $cancel_url );
        $developer_api->disconnect();

        $request_url   = $data->request_url;
        $request_token = $data->request_token;

        // Store the request token for step 3.
        $_SESSION['DS24_TOKEN'] = $request_token;

        header( "Location: $request_url" );
        exit;
    }

    catch (DigistoreApiException $e)
    {
        $error_message = $e->getMessage();

        echo "Error: $error_message\n";
    }
}
elseif ($is_returning)
{

    //
    // Step 3. After the User returns Digistore24, retrieve the api key
    //
    try
    {
        $request_token = $_SESSION[ 'DS24_TOKEN' ];

        $developer_api = DigistoreApi::connect( YOUR_DEVELOPER_API_KEY );
        $data = $developer_api->retrieveApiKey( $request_token );
        $developer_api->disconnect();

        if (empty($data->api_key))
        {
            throw new Exception( "The api key already has been retrieved. Maybe you reloaded the page." );
        }

        $api_key = $data->api_key;
        $api = DigistoreApi::connect( $api_key );

        // Test the connection
        $data = $api->getUserInfo();
        $username = $data->user_name;

        echo "Success: Connected to Digistore24 account: $username\n";

        // You need to add code to store $apikey in your application's database

        $api->disconnect();

    }

    catch (DigistoreApiException $e)
    {
        $error_message = $e->getMessage();

        echo "Error: $error_message\n";
    }
}
else
{
    echo "The user cancelled the connection.\n";
}