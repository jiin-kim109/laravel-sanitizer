# Laravel Deeper Sanitizer

I forked `arondeparon/laravel-request-sanitizer`, and modified the package. Added additional custom sanitizers and a feature to handle nested or an array format of multiple JSON objects.

Please also check the original repo (https://github.com/ArondeParon/laravel-request-sanitizer/blob/main/README.md). 

## Sanitize nested JSON objects

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
## Sanitizing an array of JSON objects

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

## Installation

`composer require jiinkim/laravel-deeper-sanitizer`
