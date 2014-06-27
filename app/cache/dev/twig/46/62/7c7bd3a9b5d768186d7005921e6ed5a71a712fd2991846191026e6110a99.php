<?php

/* GBEPresentationBundle::Presentation_general.html.twig */
class __TwigTemplate_46627c7bd3a9b5d768186d7005921e6ed5a71a712fd2991846191026e6110a99 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("::index.html.twig");

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'body' => array($this, 'block_body'),
            'swyca_welcome_body' => array($this, 'block_swyca_welcome_body'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "::index.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 5
    public function block_title($context, array $blocks = array())
    {
        // line 6
        echo "  ";
        $this->displayParentBlock("title", $context, $blocks);
        echo "
";
    }

    // line 9
    public function block_body($context, array $blocks = array())
    {
        // line 10
        echo "
  ";
        // line 11
        $this->displayBlock('swyca_welcome_body', $context, $blocks);
        // line 12
        echo "  
  
";
    }

    // line 11
    public function block_swyca_welcome_body($context, array $blocks = array())
    {
        // line 12
        echo "  ";
    }

    public function getTemplateName()
    {
        return "GBEPresentationBundle::Presentation_general.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  57 => 12,  54 => 11,  48 => 12,  46 => 11,  43 => 10,  40 => 9,  33 => 6,  30 => 5,  44 => 10,  41 => 9,  32 => 6,  29 => 5,);
    }
}
