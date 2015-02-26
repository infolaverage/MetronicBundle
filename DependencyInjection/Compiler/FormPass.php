<?php

namespace InfoLaverage\MetronicBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class FormPass
 *
 * Load custom form types templates automatically.
 */
class FormPass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        $resources = $container->getParameter('twig.form.resources');
        $templates = [
            'il_metronic_datetimepicker_widget',
        ];

        foreach ($templates as $template) {
            $resources[] = 'InfoLaverageMetronicBundle:Form:' . $template . '.html.twig';
        }
        $container->setParameter('twig.form.resources', $resources);
    }
}
