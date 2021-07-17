<?php

namespace Jiin\Traits;

use Jiin\Helpers\Filter;
use Jiin\Helpers\Sanitize;
use Jiin\Sanitizer;

trait SanitizesInputs
{
    use Filter, Sanitize {
        sanitize as protected traitSanitize;
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->sanitize();
    }

    public function sanitize() {
        $input = $this->all();
        $sanitizers = $this->getSanitizers();
        $filter = $this->enableFilter ?? false;

        if ($filter === true)
            $input = $this->filter($input, $sanitizers);

        $input = $this->traitSanitize($input, $sanitizers);

        $this->replace($input);
    }

    /**
     * Add a single sanitizer.
     *
     * @param string $formKey
     * @param Sanitizer $sanitizer
     * @return $this
     */
    public function addSanitizer(string $formKey, $sanitizer = null)
    {
        if (!property_exists($this, 'sanitizers')) {
            $this->sanitizers = [];
        }

        if ($sanitizer === null) {
            // filter-only sanitizer
            array_push($this->sanitizers, $formKey);
            return $this;
        }

        if (!isset($this->sanitizers[$formKey])) {
            $this->sanitizers[$formKey] = [];
        }

        $this->sanitizers[$formKey][] = $sanitizer;

        return $this;
    }

    /**
     * Add multiple sanitizers.
     *
     * @param $formKey
     * @param array $sanitizers
     * @return $this
     */
    public function addSanitizers($formKey, $sanitizers = [])
    {
        foreach ($sanitizers as $sanitizer) {
            $this->addSanitizer($formKey, $sanitizer);
        }

        return $this;
    }

    /**
     * @param null $formKey
     * @return array
     */
    public function getSanitizers($formKey = null)
    {
        if (!property_exists($this, 'sanitizers')) {
            $this->sanitizers = [];
        }

        if ($formKey !== null) {
            return $this->sanitizers[$formKey] ?? [];
        }

        return $this->sanitizers;
    }

    public function enableFilter() {
        $this->enableFilter = true;
    }
}
