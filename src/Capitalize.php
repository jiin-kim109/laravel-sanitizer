<?php

namespace Jiin;

class Capitalize implements Sanitizer
{
    /**
     * @param $input
     * @return string
     */
    public function sanitize($input)
    {
        return ucfirst($input);
    }
}