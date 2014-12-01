<?php

namespace InfoLaverage\MetronicBundle\Twig;

use Symfony\Bridge\Twig\Node\FormThemeNode;

/**
 * Class FormThemingTokenParser
 *
 * @see FormThemingExtension
 */
class FormThemingTokenParser extends \Twig_TokenParser
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
     * @param \Twig_TOken $token
     *
     * @return \Symfony\Bridge\Twig\Node\FormThemeNode|\Twig_NodeInterface
     *
     * @throws \Twig_Error_Syntax
     */
    public function parse(\Twig_TOken $token)
    {
        $lineno = $token->getLine();
        $stream = $this->parser->getStream();

        $form = $this->parser->getExpressionParser()->parseExpression();
        $resource = new \Twig_Node_Expression_Constant($this->resource, $lineno);

        $stream->expect(\Twig_Token::BLOCK_END_TYPE);

        return new FormThemeNode($form, $resource, $lineno, $this->getTag());
    }

    /**
     * @return string
     */
    public function getTag()
    {
        return 'il_metronic_theme_form';
    }
}
