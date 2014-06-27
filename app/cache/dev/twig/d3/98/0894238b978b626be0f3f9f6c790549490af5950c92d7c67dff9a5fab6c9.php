<?php

/* includes/footer.html.twig */
class __TwigTemplate_d3980894238b978b626be0f3f9f6c790549490af5950c92d7c67dff9a5fab6c9 extends Twig_Template
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
        // line 1
        echo "<div class=\"page-footer\">
\t<div class=\"page-footer-inner\">
\t\t<div class=\"row\">
\t\t\t<div class=\"container\" id=\"footer\">
\t\t\t\t<ul class=\"footer-ul\">
\t\t\t\t\t<li class=\"footer-ul-li\"><a href=\"";
        // line 6
        echo $this->env->getExtension('routing')->getPath("gbe_presentation_homepage");
        echo "\">";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("footer.links.home"), "html", null, true);
        echo "</a></li> |
\t\t\t\t\t<li class=\"footer-ul-li\"><a href=\"";
        // line 7
        echo $this->env->getExtension('routing')->getPath("gbe_user_homepage");
        echo "\">";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("footer.links.myProfile"), "html", null, true);
        echo "</a></li> |
\t\t\t\t\t<li class=\"footer-ul-li\"><a href=\"#\">";
        // line 8
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("footer.links.blog"), "html", null, true);
        echo "</a></li> |
\t\t\t\t\t<li class=\"footer-ul-li\"><a href=\"#\">";
        // line 9
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("footer.links.legal"), "html", null, true);
        echo "</a></li> |
\t\t\t\t\t<li class=\"footer-ul-li\"><a href=\"#\">";
        // line 10
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("footer.links.contact"), "html", null, true);
        echo "</a></li>
\t\t\t\t</ul>
\t\t\t\t2014 &copy; SWYCA
\t\t\t</div>
\t\t</div>
\t</div>
</div>";
    }

    public function getTemplateName()
    {
        return "includes/footer.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  46 => 10,  42 => 9,  38 => 8,  32 => 7,  26 => 6,  19 => 1,);
    }
}
