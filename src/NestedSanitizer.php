<?php

namespace Jiin;

use App\Http\Sanitizers\Helpers\Filter;
use App\Http\Sanitizers\Helpers\Sanitize;

class NestedSanitizer implements Sanitizer
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
        if ($this->enableFilter === true)
            $input = $this->filter($input, $this->sanitizers);

        return $this->traitSanitize($input, $this->sanitizers);
    }
}
