<?php

/* GBEPresentationBundle:Presentation:indexPresentation.html.twig */
class __TwigTemplate_e357d413b54bcb8563222561948c646d18b5d8dc171f8d47aacc491152148176 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("GBEPresentationBundle::Presentation_general.html.twig");

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'GBE_Presentation_body' => array($this, 'block_GBE_Presentation_body'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "GBEPresentationBundle::Presentation_general.html.twig";
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
        echo " - ";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("Presentation.titles.Presentation"), "html", null, true);
        echo "
";
    }

    // line 9
    public function block_GBE_Presentation_body($context, array $blocks = array())
    {
        // line 10
        echo "<!-- BLOCK : BODY -->
<!-- BEGIN CONTENT -->

<div>
  Coucou
</div>
  
<!-- END CONTENT -->


";
    }

    public function getTemplateName()
    {
        return "GBEPresentationBundle:Presentation:indexPresentation.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  44 => 10,  41 => 9,  32 => 6,  29 => 5,);
    }
}
