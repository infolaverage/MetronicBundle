<?php

namespace InfoLaverage\MetronicBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormActionsType extends AbstractType
{
    /**
     * @var string
     */
    protected $defaultButtonClass;

    /**
     * @param string $defaultButtonClass
     */
    public function __construct($defaultButtonClass)
    {
        $this->defaultButtonClass = $defaultButtonClass;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        foreach ($options['buttons'] as $buttonName => $buttonOptions) {
            $label = isset($buttonOptions['label'])
                ? $buttonOptions['label']
                : $buttonName;

            $fieldType = $buttonOptions['type'];
            $fieldOptions = [
                'label' => $label,
                'attr' => [
                    'class' => $buttonOptions['class'],
                ],
            ];

            if ($fieldType == 'il_metronic_button_link_type') {
                $fieldOptions['url'] = $buttonOptions['url'];
            }

            $builder->add($buttonName, $fieldType, $fieldOptions);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setRequired(['buttons'])
            ->setAllowedTypes('buttons', 'array')
            ->setAllowedValues(
                'buttons',
                \Closure::bind(
                    function ($value) {
                        return $this->validateButtonsValue($value);
                    },
                    $this
                )
            )
            ->setNormalizer(
                'buttons',
                \Closure::bind(
                    function ($options, $value) {
                        return $this->normalizeButtonsValue($options, $value);
                    },
                    $this
                )
            );
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'il_metronic_form_actions_type';
    }

    /**
     * @param $value
     *
     * @return bool
     */
    protected function validateButtonsValue($value)
    {
        $allowedTypes = [
            'button',
            'submit',
            'reset',
            'il_metronic_button_link_type'
        ];

        foreach ($value as $key => $button) {
            if (!isset($button['type'])
                || !in_array($button['type'], $allowedTypes)
            ) {
                throw new \RuntimeException(
                    sprintf(
                        'Missing or invalid type for %s field',
                        $key
                    )
                );
            }

            if ($button['type'] == 'il_metronic_button_link_type'
                && !isset($button['url'])
            ) {
                throw new \RuntimeException(
                    sprintf(
                        'Missing url option for %s field',
                        $key
                    )
                );
            }
        }

        return true;
    }

    /**
     * @param $options
     * @param $value
     *
     * @return mixed
     */
    protected function normalizeButtonsValue($options, $value)
    {
        foreach (array_keys($value) as $key) {
            $value[$key]['class'] = isset($value[$key]['class'])
                ? $value[$key]['class']
                : $this->defaultButtonClass;
        }

        return $value;
    }
}
