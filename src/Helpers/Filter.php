<?php

namespace Jiin\Helpers;

use Illuminate\Support\Arr;

trait Filter {
    /**
     * filter out request inputs that are not included in the sanitizers array
     */
    public function filter($input, $requestSanitizers) {
        $original = $input;
        $filtered = [];
        foreach ($requestSanitizers as $key => $value) {
            if (is_numeric($key)) {
                // filter-only serializer
                if(!Arr::has($original, $value) || str_contains($value, '.') || str_contains($value, '*')) {
                    // ignore if the expression contains dot or wild card
                    continue;
                }
                $originalValue = Arr::get($original, $value);
                Arr::set($filtered, $value, $originalValue);
            }
            else {
                if(!Arr::has($original, $key) || str_contains($key, '.') || str_contains($key, '*')) {
                    // ignore if the expression contains dot or wild card
                    continue;
                }
                $originalValue = Arr::get($original, $key);
                Arr::set($filtered, $key, $originalValue);
            }
        }

        return $filtered;
    }
}