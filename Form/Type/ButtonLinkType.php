<?php

namespace InfoLaverage\MetronicBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class ButtonLinkType
 */
class ButtonLinkType extends AbstractType
{
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['url'] = $options['url'];
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver
            ->setRequired(['url'])
            ->setAllowedTypes(
                [
                    'url' => 'string',
                ]
            );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'il_metronic_button_link_type';
    }
}
