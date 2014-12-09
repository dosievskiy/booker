<?php

/* BookerBookBundle:Default:index.html.twig */
class __TwigTemplate_5bd8101e03643ab4363ef390944e094e95b8d7da29313cf6ad9fcbe359e25d5e extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("BookerBookBundle::layout.html.twig");

        $this->blocks = array(
            'date_select' => array($this, 'block_date_select'),
            'booking_table' => array($this, 'block_booking_table'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "BookerBookBundle::layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 3
        $context["period_count"] = ((($this->getContext($context, "time_max") - $this->getContext($context, "time_min")) + 1) / $this->getContext($context, "time_period"));
        // line 5
        if ((!(null === $this->getContext($context, "current_user")))) {
            // line 6
            $context["current_user_id"] = $this->getAttribute($this->getContext($context, "current_user"), "id", array());
        } else {
            // line 8
            $context["current_user_id"] = null;
        }
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 11
    public function block_date_select($context, array $blocks = array())
    {
        // line 12
        echo "    <input id=\"datepicker\" type=\"text\" />
";
    }

    // line 15
    public function block_booking_table($context, array $blocks = array())
    {
        // line 16
        echo "    <p></p>
    <div id=\"booking\">
        <table id=\"booking_table\" class=\"table-style-three\">
            <tbody>
                <thead>
                    <tr>
                        <td id=\"booking_left_column\">
                            Room
                        </td>
                        ";
        // line 25
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable(range(1, $this->getContext($context, "period_count")));
        foreach ($context['_seq'] as $context["_key"] => $context["period_number"]) {
            // line 26
            echo "                            ";
            $context["time_start"] = (($this->getContext($context, "time_min") + ($context["period_number"] * $this->getContext($context, "time_period"))) - $this->getContext($context, "time_period"));
            // line 27
            echo "                            ";
            $context["time_end"] = ($this->getContext($context, "time_min") + ($context["period_number"] * $this->getContext($context, "time_period")));
            // line 28
            echo "                            <th>";
            echo twig_escape_filter($this->env, $this->getContext($context, "time_start"), "html", null, true);
            echo ":00 - ";
            echo twig_escape_filter($this->env, $this->getContext($context, "time_end"), "html", null, true);
            echo ":00</th>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['period_number'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 30
        echo "                    </tr>
                </thead>
                <tfoot>
                    ";
        // line 34
        echo "                </tfoot>
            </tbody>
        </table>   
    </div>
    
    <script type=\"text/javascript\">
        renderBookingTable(";
        // line 40
        echo twig_jsonencode_filter($this->getContext($context, "booking"));
        echo ", ";
        echo twig_jsonencode_filter($this->getContext($context, "rooms"));
        echo ", '";
        echo twig_escape_filter($this->env, $this->getContext($context, "current_user_id"), "html", null, true);
        echo "', ";
        echo twig_jsonencode_filter($this->getContext($context, "constants"));
        echo ");
    </script>
";
    }

    public function getTemplateName()
    {
        return "BookerBookBundle:Default:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  95 => 40,  87 => 34,  82 => 30,  71 => 28,  68 => 27,  65 => 26,  61 => 25,  50 => 16,  47 => 15,  42 => 12,  39 => 11,  33 => 8,  30 => 6,  28 => 5,  26 => 3,);
    }
}
