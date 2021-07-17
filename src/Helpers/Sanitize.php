<?php

namespace Jiin\Helpers;

use Illuminate\Support\Arr;
use InvalidArgumentException;
use Jiin\Sanitizer;

trait Sanitize {
    /**
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function sanitize($input, $requestSanitizers)
    {
        foreach ($requestSanitizers as $inputKey => $sanitizers) {
            if (is_numeric($inputKey)) {
                // filter-only sanitizer
                continue;
            }
            if (!is_numeric($inputKey) && !Arr::has($input, $inputKey)) {
                // If the request does not have a property for this key, there is no need to sanitize anything.
                continue;
            }

            $sanitizers = (array) $sanitizers;

            foreach ($sanitizers as $key => $value) {
                if (is_string($key)) {
                    $sanitizer = app()->make($key, $value);
                } elseif (is_string($value)) {
                    $sanitizer = app()->make($value);
                } elseif ($value instanceof Sanitizer) {
                    $sanitizer = $value;
                } else {
                    throw new InvalidArgumentException('Could not resolve sanitizer from given properties');
                }
                
                Arr::set($input, $inputKey, $sanitizer->sanitize(Arr::get($input, $inputKey)));
            }
        }

        return $input;
    }
}