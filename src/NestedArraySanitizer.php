<?php

namespace Jiin;

use App\Http\Sanitizers\Helpers\Filter;
use App\Http\Sanitizers\Helpers\Sanitize;
use InvalidArgumentException;

class NestedArraySanitizer implements Sanitizer
{
    use Filter;
    use Sanitize {
        sanitize as protected traitSanitize;
    }

    private $enableFilter;
    private $sanitizers;

    public function __construct($sanitizers = [], bool $enableFilter = false)
    {
        $this->enableFilter = $enableFilter;
        $this->sanitizers = $sanitizers;
    }

    /**
     * @param $input
     * @return string
     */
    public function sanitize($input)
    {
        if (!is_array($input) || !in_array(0, array_keys($input)))
            throw new InvalidArgumentException("Array sanitizer processes only an array of inputs");
        
        $acc = [];

        foreach($input as $entry) {
            $entry = $this->enableFilter ? $this->filter($entry, $this->sanitizers) : $entry;

            array_push($acc, $this->traitSanitize($entry, $this->sanitizers));
        }

        return $acc;
    }

}
