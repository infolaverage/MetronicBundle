<?php

namespace InfoLaverage\MetronicBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ButtonLinkType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['url'] = $options['url'];
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setRequired(['url'])
            ->setAllowedTypes('url', 'string')
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'il_metronic_button_link_type';
    }
}
