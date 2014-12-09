<?php

/* BookerBookBundle::layout.html.twig */
class __TwigTemplate_0dd7e1ab503fa44c1c32abea79a345fcfdcfcd85d1fc418156a05bf0651fe688 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("BookerBookBundle::base.html.twig");

        $this->blocks = array(
            'login_info' => array($this, 'block_login_info'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "BookerBookBundle::base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_login_info($context, array $blocks = array())
    {
        // line 4
        echo "    <p id=\"login\">
        ";
        // line 5
        if ($this->getContext($context, "current_user")) {
            // line 6
            echo "            Logged in as: <span style='font-weight:bold'>";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "current_user"), "username", array()), "html", null, true);
            echo "</span>
                <a href=\"";
            // line 7
            echo $this->env->getExtension('routing')->getPath("fos_user_security_logout");
            echo "\">Logout</a>
        ";
        } else {
            // line 9
            echo "            <a href=\"";
            echo $this->env->getExtension('routing')->getPath("fos_user_security_login");
            echo "\">Login</a>
        ";
        }
        // line 10
        echo "    
    </p>
";
    }

    public function getTemplateName()
    {
        return "BookerBookBundle::layout.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  52 => 10,  46 => 9,  41 => 7,  36 => 6,  34 => 5,  31 => 4,  28 => 3,);
    }
}
