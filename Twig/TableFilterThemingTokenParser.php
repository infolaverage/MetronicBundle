<?php

namespace InfoLaverage\MetronicBundle\Twig;

use Symfony\Bridge\Twig\Node\FormThemeNode;

/**
 * Class TableFilterThemingTokenParser
 *
 * @see FormThemingExtension
 */
class TableFilterThemingTokenParser extends FormThemingTokenParser
{
    /**
     * @return string
     */
    public function getTag()
    {
        return 'il_metronic_theme_table_filter';
    }
}
