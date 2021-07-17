<?php

namespace Jiin;

class RemoveNumeric implements Sanitizer
{
    /**
     * @param $input
     * @return string a string without number, or null if it was filled only with numbers
     */
    public function sanitize($input)
    {
        $result = preg_replace('/[0-9]+/', '', $input);
        if (strlen($result) === 0)
            return null;
        return $result;
    }
}