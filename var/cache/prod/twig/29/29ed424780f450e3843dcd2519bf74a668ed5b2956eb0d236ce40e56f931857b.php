<?php

/* home/contacto.html.twig */
class __TwigTemplate_a2a91385d3c4fb30ed5d39d12e9321a63bfff9f6097fea3f5043fb31fb87cb91 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 2
        $this->parent = $this->loadTemplate("base.html.twig", "home/contacto.html.twig", 2);
        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'body' => array($this, 'block_body'),
            'stylesheets' => array($this, 'block_stylesheets'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 5
    public function block_title($context, array $blocks = array())
    {
        echo "Convergencia de las Culturas Contacto";
    }

    // line 8
    public function block_body($context, array $blocks = array())
    {
        // line 9
        echo "    <div class=\"container\">
        <h2>Contacta </h2>
        con nosotros
    </div>

    ";
        // line 14
        if (((($context["equipo"] ?? null) == "lavapies") || (($context["equipo"] ?? null) == "none"))) {
            // line 15
            echo "        Contacta con nosotros en Lavapies <br />
    ";
        }
        // line 17
        echo "    ";
        if (((($context["equipo"] ?? null) == "latina") || (($context["equipo"] ?? null) == "none"))) {
            // line 18
            echo "        Contacta con nosotros en Latina <br />
    ";
        }
        // line 20
        echo "    ";
        if (((($context["equipo"] ?? null) == "usera") || (($context["equipo"] ?? null) == "none"))) {
            // line 21
            echo "        Contacta con nosotros en Usera <br />
    ";
        }
        // line 23
        echo "
";
    }

    // line 27
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 28
        echo "    ";
    }

    public function getTemplateName()
    {
        return "home/contacto.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  74 => 28,  71 => 27,  66 => 23,  62 => 21,  59 => 20,  55 => 18,  52 => 17,  48 => 15,  46 => 14,  39 => 9,  36 => 8,  30 => 5,  11 => 2,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "home/contacto.html.twig", "/shared/httpd/convergenciadeculturas/app/Resources/views/home/contacto.html.twig");
    }
}
