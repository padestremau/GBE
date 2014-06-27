<?php

/* includes/nav.html.twig */
class __TwigTemplate_bb7ff7b81c4a4e104d6273df94abe406d9f9b542917bb02747990b671cf7017a extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 2
        $context["route"] = $this->getAttribute($this->getAttribute($this->getAttribute($this->getContext($context, "app"), "request"), "attributes"), "get", array(0 => "_route"), "method");
        // line 3
        echo "

<div class=\"page-header navbar navbar-fixed-top topOfPage\">
    <!-- BEGIN HEADER INNER -->
    <div class=\"page-header-inner\">

      <!-- BEGIN LOGO -->
      <div class=\"page-logo\">
        <a href=\"";
        // line 11
        echo "\">
          <img src=\"";
        // line 12
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("img/logo/logo.png"), "html", null, true);
        echo "\" alt=\"logo\" class=\"logo-default\"/>
        </a>
        <div class=\"menu-toggler sidebar-toggler hide\">
          <!-- DOC: Remove the above \"hide\" to enable the sidebar toggler button on header -->
        </div>
      </div>
      <!-- END LOGO -->

    </div>
    <!-- END HEADER INNER -->

  </div>";
    }

    public function getTemplateName()
    {
        return "includes/nav.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  34 => 12,  31 => 11,  21 => 3,  19 => 2,);
    }
}
