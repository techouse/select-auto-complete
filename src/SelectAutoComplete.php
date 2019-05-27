<?php

namespace Techouse\SelectAutoComplete;

use Laravel\Nova\Fields\Select;

class SelectAutoComplete extends Select
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'select-auto-complete';

    /**
     * @var bool
     */
    public $required = false;

    public function __construct($name, $attribute = null, callable $resolveCallback = null)
    {
        parent::__construct($name, $attribute, $resolveCallback);

        return $this->withMeta(['required' => $this->required]);
    }

    public function defaultValue($default = null)
    {
        if ($default !== null) {
            return $this->withMeta([__FUNCTION__ => $default]);
        }
    }

    public function required()
    {
        $this->required = true;

        return $this->withMeta(['required' => $this->required]);
    }
}
