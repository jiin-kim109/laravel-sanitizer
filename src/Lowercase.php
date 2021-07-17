<?php

namespace Jiin;

class Lowercase implements Sanitizer
{
    /**
     * @param $input
     * @return string
     */
    public function sanitize($input)
    {
        return strtolower($input);
    }
}