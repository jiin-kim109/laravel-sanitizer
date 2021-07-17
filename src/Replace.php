<?php

namespace Jiin;

class Replace implements Sanitizer
{
    protected $search;
    
    protected $replace;

    protected $caseSensitive;

    public function __construct($search, $replace, $caseSensitive = false)
    {
        $this->search = $search;
        $this->replace = $replace;
        $this->caseSensitive = $caseSensitive;
    }   

    /**
     * @param $input
     * @return string Replace all occurrences of the search string with replacement string, or null if the result has length of 0
     */
    public function sanitize($input)
    {
        $result = $this->caseSensitive ? str_replace($this->search, $this->replace, $input) : str_ireplace($this->search, $this->replace, $input);
        if (strlen($result) === 0)
            return null;
        return $result;
    }
}