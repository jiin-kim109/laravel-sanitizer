<?php

namespace Jiin;

class Uppercase implements Sanitizer
{
    /**
     * @param $input
     * @return string
     */
    public function sanitize($input)
    {
        return strtoupper($input);
    }
}