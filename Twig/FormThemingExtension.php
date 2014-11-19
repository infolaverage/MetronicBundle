<?php

namespace InfoLaverage\MetronicBundle\Twig;

/**
 * Class FormThemingExtension
 *
 * Sets a form view theme property to FormThemingExtension::$resource.
 *
 * usage: {% il_metronic_theme _FORM_NAME_ %}
 */
class FormThemingExtension extends \Twig_Extension
{
    /**
     * @var string
     */
    protected $resource;

    /**
     * @param string $resource
     */
    public function __construct($resource)
    {
        $this->resource = $resource;
    }

    /**
     * @return array
     */
    public function getTokenParsers()
    {
        return [
            new FormThemingTokenParser($this->resource),
        ];
    }

    /**
     * @return string
     */
    public function getName()
    {
        return "il_metronic_form_theming_extension";
    }
}
