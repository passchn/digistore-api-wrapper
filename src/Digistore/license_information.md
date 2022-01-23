# License

Files in the `src/Digistore/*` folder, or the `\DigistoreApi\Digistore` namespace, are taken from Digistore24: [dev.digistore24.com/en/articles/3-api-basics](https://dev.digistore24.com/en/articles/3-api-basics)

See the license information in `DigistoreApi.php` for more information. 

Changes, that were made to the original PHP class: 
* the `DigistoreApiException` was moved to an own file. 
* Namespaces and strict types were added. 
* Linting the code. 
* The wrapping `(!class_exists( 'DigistoreApi' )) { ... }` was removed. 

## Full API reference

You can find a full reference for the api at [dev.digistore24.com](https://dev.digistore24.com/en/articles/3-api-basics). 

Examples by Digistore24 were added in the `./examples` folder. This plugin provides some wrapper methods and types that might be useful, but the full Api won't be covered. 
