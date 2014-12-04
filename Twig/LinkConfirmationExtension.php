<?php

namespace InfoLaverage\MetronicBundle\Twig;

class LinkConfirmationExtension extends \Twig_Extension
{
    /**
     * @return array
     */
    public function getFunctions()
    {
        return [
            new  \Twig_SimpleFunction(
                'il_metronic_link_confirm',
                [$this, 'linkConfirm'],
                ['is_safe' => ['html']]
            ),
        ];
    }

    /**
     * @param string $message
     *
     * @return string
     */
    public function linkConfirm($message)
    {
        return sprintf('data-confirm="%s"', $message);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return "il_metronic_link_confirm";
    }
}
