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
    protected $formTheme;

    /**
     * @var string
     */
    protected $tableFilterTheme;

    /**
     * @param string $formTheme
     * @param string $tableFilterTheme
     */
    public function __construct($formTheme, $tableFilterTheme)
    {
        $this->formTheme = $formTheme;
        $this->tableFilterTheme = $tableFilterTheme;
    }

    /**
     * @return array
     */
    public function getTokenParsers()
    {
        return [
            new FormThemingTokenParser($this->formTheme),
            new TableFilterThemingTokenParser($this->tableFilterTheme),
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
