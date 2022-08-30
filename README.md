# Laravel Deeper Sanitizer

This is a fork of `arondeparon/laravel-request-sanitizer`. I added some useful custom sanitizers and a function that allows to handle nested or array format of JSON objects.

## General Usage

Check here(https://github.com/ArondeParon/laravel-request-sanitizer/blob/main/README.md)

## For sanitizing nested JSON objects

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
## For sanitizing array format of JSON objects

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
