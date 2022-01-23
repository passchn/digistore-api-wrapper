# Digistore24 Api Wrapper plugin for PHP

## Installation

You can install this plugin using [composer](https://getcomposer.org).

The recommended way to install composer packages is:

```
composer require passchn/digistore-api-wrapper
```

## Connect to the API 

To connect to the Api, create an instance of `DigistoreClient`, passing your api key from Digistore24.com:  

```
use DigistoreApi\DigistoreClient;

$api = new DigistoreClient($api_key);
```

Test the connection: 
```
return $api->isConnected() // true or false 
```

If `false`, or some API-call went wrong, and you got a `null`-response, check for the last error message, or all errors that have occurred: 
```
$api->getLastError() // error message (string) or null
$api->getErrors() // array of Exceptions or null 
```

## Get data from the API 

This plugin is a wrapper for thr original Digistore24 API. See the full reference here: [dev.digistore24.com](https://dev.digistore24.com/en/articles/3-api-basics). 

The aim is to have known return types (e.g., `Buyer` or `Purchase` with defined fields), and to provide an easier access. 

However, ust a few of the possible queries are supported right now. In general, you can always use this method to call any endpoint: 
 ```
 $api->call($method, ...$arguments)
 ```

## Supported wrapper-endpoints 

### Purchases 

Get one `DigistoreApi\Purchases\Purchase` or `null` by order id / purchase id: 
```
$api->Purchases->get($id);
```


Get a `DigistoreApi\Purchases\Purchase[]` or `null` by passing an array of order ids: 
```
$api->Purchases->getMany([
    '12345',
    '67890',
    '...'
]);
```

### Buyers

Get a `DigistoreApi\Buyers\Buyer` (or `null`) by id or email. 
```
$api->Buyers->get($id_or_email);
```
Get an array of `Buyers` or `null` by passing a list of emails or ids: 
```
$api->Buyers->getMany([$id_or_email, $other_email, $some_id]);
```

## Contribution

You can contribute to this plugin via Pull Requests. 