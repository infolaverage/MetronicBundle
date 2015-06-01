<?php

namespace InfoLaverage\MetronicBundle\Form;

use Symfony\Component\Form\AbstractType as BaseType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

abstract class AbstractType extends BaseType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // handle form actions settings
        $actionsOptions = $this->resolveActionsOptions($options);
        if (isset($actionsOptions['buttons'])
            && count($actionsOptions['buttons']) > 0
        ) {
            $builder->add(
                'actions',
                'il_metronic_form_actions_type',
                $actionsOptions
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefined(['cancel_url']);
    }

    /**
     * Add some default values to the form actions config
     *  depending on the current option values.
     *
     * @param array $options
     *
     * @return array
     */
    protected function resolveActionsOptions(array $options)
    {
        $additionalActionsOptions = isset($options['actions_options'])
            ? $options['actions_options']
            : [];

        // adding a default mapped => false config
        $actionsOptions = array_merge_recursive(
            [
                'mapped' => false,
            ],
            $additionalActionsOptions
        );

        // if buttons isn't defnied add some default buttons to the form action
        if (!isset($additionalActionsOptions['buttons'])) {
            $actionsOptions['buttons']['submit'] = [
                'type' => 'submit',
                'label' => '<i class="fa fa-check add-right-margin-10"></i>Save',
                'class' => 'btn green',
            ];

            // if a cancel url is present add a cancel button
            if (isset($options['cancel_url'])) {
                $actionsOptions['buttons']['cancel'] = [
                    'type' => 'il_metronic_button_link_type',
                    'label' => '<i class="fa fa-times add-right-margin-10"></i>Cancel',
                    'class' => 'btn default',
                ];
            }
        }

        // if a cancel url is present add it to the cancel button
        if (isset($options['cancel_url'])
            && isset($actionsOptions['buttons']['cancel'])
            && !isset($actionsOptions['buttons']['cancel']['url'])
        ) {
            $actionsOptions['buttons']['cancel']['url'] = $options['cancel_url'];
        }

        return $actionsOptions;
    }
}
