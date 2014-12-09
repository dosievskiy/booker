<?php

/* BookerBookBundle::base.html.twig */
class __TwigTemplate_d2680d5a4815ab5d60b01dc721a85895a55e4969fb47b3b469a678de9ba4e1f5 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'stylesheets' => array($this, 'block_stylesheets'),
            'date_select' => array($this, 'block_date_select'),
            'booking_table' => array($this, 'block_booking_table'),
            'login_info' => array($this, 'block_login_info'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv=\"Content-Type\" content=\"text/html\"; charset=utf-8\" />
        <title>";
        // line 5
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
        ";
        // line 6
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 12
        echo "
        <script type=\"text/javascript\" src=\"";
        // line 13
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/bookerbook/js/jquery-1.7.min.js"), "html", null, true);
        echo "\"></script>
        <script type=\"text/javascript\" src=\"";
        // line 14
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/bookerbook/js/main.js"), "html", null, true);
        echo "\"></script>
        <script type=\"text/javascript\" src=\"";
        // line 15
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/bookerbook/js/datepicker/jquery-ui.js"), "html", null, true);
        echo "\"></script>
        <script type=\"text/javascript\" src=\"";
        // line 16
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/bookerbook/js/noty/packaged/jquery.noty.packaged.min.js"), "html", null, true);
        echo "\"></script>
    </head>
    <body>
        <div id=\"container\">
            <h1>Simple booker app</h1>
            ";
        // line 21
        $this->displayBlock('date_select', $context, $blocks);
        // line 23
        echo "
            ";
        // line 24
        $this->displayBlock('booking_table', $context, $blocks);
        // line 26
        echo "
            ";
        // line 27
        $this->displayBlock('login_info', $context, $blocks);
        // line 29
        echo "        </div>
    </body>
</html>";
    }

    // line 5
    public function block_title($context, array $blocks = array())
    {
        echo "Booker";
    }

    // line 6
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 7
        echo "            <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/bookerbook/css/main.css"), "html", null, true);
        echo "\" rel=\"stylesheet\" type=\"text/css\" />
            <link href=\"";
        // line 8
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/bookerbook/css/datepicker/jquery-ui.css"), "html", null, true);
        echo "\" rel=\"stylesheet\" type=\"text/css\" />
            <link href=\"";
        // line 9
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/bookerbook/css/datepicker/jquery-ui.structure.css"), "html", null, true);
        echo "\" rel=\"stylesheet\" type=\"text/css\" />
            <link href=\"";
        // line 10
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/bookerbook/css/datepicker/jquery-ui.theme.css"), "html", null, true);
        echo "\" rel=\"stylesheet\" type=\"text/css\" />
        ";
    }

    // line 21
    public function block_date_select($context, array $blocks = array())
    {
        // line 22
        echo "            ";
    }

    // line 24
    public function block_booking_table($context, array $blocks = array())
    {
        // line 25
        echo "            ";
    }

    // line 27
    public function block_login_info($context, array $blocks = array())
    {
        // line 28
        echo "            ";
    }

    public function getTemplateName()
    {
        return "BookerBookBundle::base.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  122 => 28,  119 => 27,  115 => 25,  112 => 24,  108 => 22,  105 => 21,  99 => 10,  95 => 9,  91 => 8,  86 => 7,  83 => 6,  77 => 5,  71 => 29,  69 => 27,  66 => 26,  64 => 24,  61 => 23,  59 => 21,  51 => 16,  47 => 15,  43 => 14,  39 => 13,  36 => 12,  34 => 6,  30 => 5,  24 => 1,);
    }
}
