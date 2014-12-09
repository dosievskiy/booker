<?php

/* FOSUserBundle:Security:login.html.twig */
class __TwigTemplate_ecc11e7d199c22a30da3acde2777bcba581b250036bacb34c3d1c9ef1f21d23f extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'stylesheets' => array($this, 'block_stylesheets'),
            'fos_user_content' => array($this, 'block_fos_user_content'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 2
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 5
        echo "
";
        // line 6
        $this->displayBlock('fos_user_content', $context, $blocks);
    }

    // line 2
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 3
        echo "    <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/bookerbook/css/login.css"), "html", null, true);
        echo "\" rel=\"stylesheet\" type=\"text/css\" />
";
    }

    // line 6
    public function block_fos_user_content($context, array $blocks = array())
    {
        // line 7
        echo "

<div id=\"login\">
    <form action=\"";
        // line 10
        echo $this->env->getExtension('routing')->getPath("fos_user_security_check");
        echo "\" method=\"post\">
        <input type=\"hidden\" name=\"_csrf_token\" value=\"";
        // line 11
        echo twig_escape_filter($this->env, $this->getContext($context, "csrf_token"), "html", null, true);
        echo "\" />
        ";
        // line 12
        if ($this->getContext($context, "error")) {
            // line 13
            echo "            <div id=\"error\">";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans($this->getAttribute($this->getContext($context, "error"), "messageKey", array()), $this->getAttribute($this->getContext($context, "error"), "messageData", array()), "security"), "html", null, true);
            echo "</div>
        ";
        }
        // line 15
        echo "        <input type=\"text\" id=\"username\" name=\"_username\" value=\"";
        echo twig_escape_filter($this->env, $this->getContext($context, "last_username"), "html", null, true);
        echo "\" required=\"required\" placeholder=\"Username\" />
        <input type=\"password\" id=\"password\" name=\"_password\" required=\"required\" placeholder=\"Password\" />
        <input type=\"submit\" id=\"_submit\" name=\"_submit\" value=\"Log In\" />
    </form>
    <a href=\"";
        // line 19
        echo $this->env->getExtension('routing')->getPath("fos_user_registration_register");
        echo "\" id=\"register\">register</a>
</div>

";
    }

    public function getTemplateName()
    {
        return "FOSUserBundle:Security:login.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  72 => 19,  64 => 15,  58 => 13,  56 => 12,  52 => 11,  48 => 10,  43 => 7,  40 => 6,  33 => 3,  30 => 2,  26 => 6,  23 => 5,  21 => 2,);
    }
}
