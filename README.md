# Laravel Request Sanitizer

This package is originated from `arondeparon/laravel-request-sanitizer`. I added more useful sanitizers and reformed it to be able to handle a nested or array form of JSON inputs
## How to use

Syntax is similar to the way `rules` are added to a [Form Request](https://laravel.com/docs/master/validation#form-request-validation).

```php
class StoreCustomerInformationRequest extends FormRequest
{
     use SanitizesInputs;
     
     protected $sanitizers = [
        'lastname' => [
            Capitalize::class,
        ],
        'mobile_phone' => [
            RemoveNonNumeric::class
        ],
     ];
}
```

## How to sanitize nested JSON input

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
## How to sanitize an array of JSON objects

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

## Installing

`composer require jiinkim/laravel-deeper-sanitizer`

## Predefined Sanitizers

- [`Trim`](./src/Trim.php) - simple PHP `trim()` implementation
- [`TrimDuplicateSpaces`](./src/TrimDuplicateSpaces.php) replaces duplicate spaces with a single space.
- [`RemoveNonNumeric`](./src/RemoveNonNumeric.php) - removes any non numeric character
- [`Capitalize`](./src/Capitalize.php) - capitalizes the first character of a string
- [`Uppercase`](./src/Uppercase.php) - converts a string to uppercase
- [`Lowercase`](./src/Lowercase.php) - converts a string to lowercase
- [`FilterVars`](./src/FilterVars.php) - simple PHP `filter_var` sanitizer
## Writing your own Sanitizer

Writing your own sanitizer can be done by implementing the `Sanitizer` interface, which requires only
one method.

```php
interface Sanitizer
 {
     public function sanitize($input);
 }
```
## Credits

- [Aron Rotteveel](https://github.com/arondeparon)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[link-downloads]: https://packagist.org/packages/arondeparon/laravel-request-sanitizer
[ico-downloads]: https://img.shields.io/packagist/dt/arondeparon/laravel-request-sanitizer.svg?style=flat-square
