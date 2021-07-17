<?php

namespace Jiin;

class Trim implements Sanitizer
{
    /**
     * @param $input
     * @return string
     */
    public function sanitize($input)
    {
        return trim($input);
    }
}