<?php

namespace InfoLaverage\MetronicBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\DateTime;

class DateTimePickerType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        // processing widget options to use in view
        $view->vars['widget_options'] = [];
        foreach ($options as $key => $value) {
            if (substr($key, 0, 6) == 'widget') {
                $key = lcfirst(substr($key, 6));
                $view->vars['widget_options'][$key] = $value;
            }
        }

        // passing options to view
        $view->vars['allowRemove'] = $options['allowRemove'];
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'format' => 'yyyy-MM-dd\THH:mm:ss',
                'html5' => false,
                'widget' => 'single_text',
                'attr' => [
                    'readonly' => true,
                ],
                'constraints' => [
                    new DateTime(),
                ],
                // enable/disable remove button in widget
                'allowRemove' => true,
                // picker options
                // @see http://www.malot.fr/bootstrap-datetimepicker/#options
                'widgetFormat' => 'yyyy-mm-ddThh:ii:ss',
                'widgetWeekStart' => 1,
                'widgetAutoclose' => true,
                'widgetTodayBtn' => true,
                'widgetTodayHighlight' => true,
                'widgetPickerPosition' => 'bottom-left',
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'datetime';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'il_metronic_datetimepicker';
    }
}
