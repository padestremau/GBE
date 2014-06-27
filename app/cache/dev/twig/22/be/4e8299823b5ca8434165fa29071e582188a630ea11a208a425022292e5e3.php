<?php

/* ::index.html.twig */
class __TwigTemplate_22be4e8299823b5ca8434165fa29071e582188a630ea11a208a425022292e5e3 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'body' => array($this, 'block_body'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 2
        echo "
";
        // line 4
        $context["route"] = $this->getAttribute($this->getAttribute($this->getAttribute($this->getContext($context, "app"), "request"), "attributes"), "get", array(0 => "_route"), "method");
        // line 5
        echo "
<!DOCTYPE html>

<!-- BEGIN HEAD -->
<head>
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
    <title>
      ";
        // line 12
        $this->displayBlock('title', $context, $blocks);
        // line 15
        echo "    </title>
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
    <meta content=\"width=device-width, initial-scale=1\" name=\"viewport\"/>
    <meta content=\"\" name=\"description\"/>
    <meta content=\"\" name=\"author\"/>

    ";
        // line 21
        if (isset($context['assetic']['debug']) && $context['assetic']['debug']) {
            // asset "d37d858_0"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_d37d858_0") : $this->env->getExtension('assets')->getAssetUrl("_controller/css/d37d858_swyca_main_1.css");
            // line 26
            echo "      <link rel=\"stylesheet\" href=\"";
            echo twig_escape_filter($this->env, $this->getContext($context, "asset_url"), "html", null, true);
            echo "\" type=\"text/css\" media=\"screen\"/>
    ";
        } else {
            // asset "d37d858"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_d37d858") : $this->env->getExtension('assets')->getAssetUrl("_controller/css/d37d858.css");
            echo "      <link rel=\"stylesheet\" href=\"";
            echo twig_escape_filter($this->env, $this->getContext($context, "asset_url"), "html", null, true);
            echo "\" type=\"text/css\" media=\"screen\"/>
    ";
        }
        unset($context["asset_url"]);
        // line 28
        echo "        
    <link rel=\"icon\" type=\"image/png\" href=\"";
        // line 29
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("img/favicon.png"), "html", null, true);
        echo "\" />
    <link rel=\"icon\" type=\"image/ico\" href=\"";
        // line 30
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("favicon.ico"), "html", null, true);
        echo "\" />
</head>
<!-- END HEAD -->

<!-- BEGIN BODY -->
  <body class=\"page\">
    
    <!-- BEGIN HEADER -->
      ";
        // line 38
        $this->env->loadTemplate("includes/nav.html.twig")->display($context);
        // line 39
        echo "    <!-- END HEADER -->

    <!-- BEGIN ERROR DISPLAY -->
    <div class=\"clearfix\">
      <!-- Erreurs -->    
        ";
        // line 44
        if ((twig_length_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getContext($context, "app"), "session"), "flashbag"), "get", array(0 => "info"), "method")) > 0)) {
            // line 45
            echo "          <div class=\"row-fluid center btn-info\">
            ";
            // line 46
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($this->getAttribute($this->getContext($context, "app"), "session"), "flashbag"), "get", array(0 => "info"), "method"));
            foreach ($context['_seq'] as $context["_key"] => $context["flashMessage"]) {
                // line 47
                echo "              ";
                echo twig_escape_filter($this->env, $this->getContext($context, "flashMessage"), "html", null, true);
                echo "
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['flashMessage'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 49
            echo "          </div>
        ";
        }
        // line 51
        echo "    </div>
    <!-- END ERROR DISPLAY -->
    
    <!-- BEGIN CONTAINER -->
    <div class=\"page-container\">
      ";
        // line 56
        $this->displayBlock('body', $context, $blocks);
        // line 57
        echo "  
    </div>
    <!-- END CONTAINER -->

    <!-- BEGIN FOOTER -->
      ";
        // line 62
        $this->env->loadTemplate("includes/footer.html.twig")->display($context);
        // line 63
        echo "    <!-- END FOOTER -->

    <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->

    ";
        // line 67
        if (isset($context['assetic']['debug']) && $context['assetic']['debug']) {
            // asset "320ca96_0"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_320ca96_0") : $this->env->getExtension('assets')->getAssetUrl("_controller/js/320ca96_tasks_1.js");
            // line 69
            echo "      <script type=\"text/javascript\" src=\"";
            echo twig_escape_filter($this->env, $this->getContext($context, "asset_url"), "html", null, true);
            echo "\"></script>
    ";
        } else {
            // asset "320ca96"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_320ca96") : $this->env->getExtension('assets')->getAssetUrl("_controller/js/320ca96.js");
            echo "      <script type=\"text/javascript\" src=\"";
            echo twig_escape_filter($this->env, $this->getContext($context, "asset_url"), "html", null, true);
            echo "\"></script>
    ";
        }
        unset($context["asset_url"]);
        // line 71
        echo "
    <!-- END JAVASCRIPTS -->
  </body>
  <!-- END BODY -->
</html>";
    }

    // line 12
    public function block_title($context, array $blocks = array())
    {
        // line 13
        echo "        GBE
      ";
    }

    // line 56
    public function block_body($context, array $blocks = array())
    {
        // line 57
        echo "      ";
    }

    public function getTemplateName()
    {
        return "::index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  173 => 57,  170 => 56,  165 => 13,  162 => 12,  154 => 71,  140 => 69,  136 => 67,  130 => 63,  128 => 62,  121 => 57,  119 => 56,  112 => 51,  108 => 49,  99 => 47,  95 => 46,  92 => 45,  90 => 44,  83 => 39,  81 => 38,  70 => 30,  66 => 29,  63 => 28,  49 => 26,  45 => 21,  37 => 15,  35 => 12,  26 => 5,  24 => 4,  21 => 2,  57 => 12,  54 => 11,  48 => 12,  46 => 11,  43 => 10,  40 => 9,  33 => 6,  30 => 5,  44 => 10,  41 => 9,  32 => 6,  29 => 5,);
    }
}
