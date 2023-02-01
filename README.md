# Laravel Deep Sanitizer

This repository is originated from `arondeparon/laravel-request-sanitizer`. I gave a little change for my own use. Extra sanitizer classes are to handle more JSON payload formats.

Please check the original repo (https://github.com/ArondeParon/laravel-request-sanitizer/blob/main/README.md). 

## Sanitize a nested JSON object

```php
class StoreCustomerInformationRequest extends FormRequest
{
     use SanitizesInputs;
     
     protected $sanitizers = [
        'billing_address' => [
            NestedSanitizer::class => [
                'sanitizers' => [
                    'address1',
                    'address2',
                    'city',
                    'country' => [
                        Lowercase::class
                    ],
                    'province',
                    'zip' => [
                        Uppercase::class,
                        Trim::class
                    ],
                    'province_code' => [
                        Uppercase::class
                    ],
                    'country_code' => [
                        Uppercase::class
                    ],
                ]
            ]
        ],
     ];
}
```
## Sanitize an array of JSON objects

```php
class StoreCustomerInformationRequest extends FormRequest
{
     use SanitizesInputs;
     
     protected $sanitizers = [
        'line_items' => [
            NestedArraySanitizer::class => [
                'currency' => [
                    Uppercase::class
                ],
                'quantity' => [
                    RemoveNonNumeric::class
                ],
                'price' => [
                    RemoveNonNumeric::class
                ],
                'shipping_fee' => [
                    RemoveNonNumeric::class
                ],
                'discount' => [
                    RemoveNonNumeric::class
                ],
                'taxes' => [
                    RemoveNonNumeric::class
                ],
            ]
        ],
     ];
}
```
