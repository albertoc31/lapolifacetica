<?php

/* base.html.twig */
class __TwigTemplate_b906a6f16d193b78594d044f49a692dd334316a927c1fda46744e1853492eab0 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'stylesheets' => array($this, 'block_stylesheets'),
            'body' => array($this, 'block_body'),
            'javascripts' => array($this, 'block_javascripts'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html>
<head>
    <meta charset=\"UTF-8\"/>
    <title>";
        // line 5
        $this->displayBlock('title', $context, $blocks);
        echo "</title>

    <!-- Bootstrap core CSS -->
    <link href=\"";
        // line 8
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("vendor/bootstrap/css/bootstrap.min.css"), "html", null, true);
        echo "\" rel=\"stylesheet\">

    <!-- Custom styles for this template -->
    <link href=\"";
        // line 11
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("css/modern-business.css"), "html", null, true);
        echo "\" rel=\"stylesheet\">

    ";
        // line 13
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 14
        echo "    <link rel=\"icon\" type=\"image/x-icon\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("favicon.ico"), "html", null, true);
        echo "\"/>
</head>
<body>

<!-- Navigation -->
<nav class=\"navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top\">
    <div class=\"container\">
        <a class=\"navbar-brand\" href=\"";
        // line 21
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("homepage");
        echo "\">Convergencia de las Culturas</a>
        <button class=\"navbar-toggler navbar-toggler-right\" type=\"button\" data-toggle=\"collapse\"
                data-target=\"#navbarResponsive\" aria-controls=\"navbarResponsive\" aria-expanded=\"false\"
                aria-label=\"Toggle navigation\">
            <span class=\"navbar-toggler-icon\"></span>
        </button>
        <div class=\"collapse navbar-collapse\" id=\"navbarResponsive\">
            <ul class=\"navbar-nav ml-auto\">
                <li class=\"nav-item\">
                    <a class=\"nav-link\" href=\"";
        // line 30
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("nosotros");
        echo "\">Nosotros</a>
                </li>
                <li class=\"nav-item\">
                    <a class=\"nav-link\" href=\"";
        // line 33
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("materiales");
        echo "\">Materiales</a>
                </li>

                <li class=\"nav-item dropdown\">
                    <a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"navbarDropdownPortfolio\" data-toggle=\"dropdown\"
                       aria-haspopup=\"true\" aria-expanded=\"false\">
                        Acciones
                    </a>
                    <div class=\"dropdown-menu dropdown-menu-right\" aria-labelledby=\"navbarDropdownPortfolio\">
                        <a class=\"dropdown-item\" href=\"/accion1\">Accion 1</a>
                        <a class=\"dropdown-item\" href=\"/accion2\">Accion 2</a>
                        <a class=\"dropdown-item\" href=\"/accion3\">Accion 3</a>
                        <a class=\"dropdown-item\" href=\"/accion4\">Accion 4</a>
                    </div>
                </li>
                <li class=\"nav-item dropdown\">
                    <a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"navbarDropdownBlog\" data-toggle=\"dropdown\"
                       aria-haspopup=\"true\" aria-expanded=\"false\">
                        Contacta
                    </a>
                    <div class=\"dropdown-menu dropdown-menu-right\" aria-labelledby=\"navbarDropdownBlog\">
                        <a class=\"dropdown-item\" href=\"";
        // line 54
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("contacto", array("equipo" => "lavapies"));
        echo "\">Contacta en Lavapies </a>
                        <a class=\"dropdown-item\" href=\"";
        // line 55
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("contacto", array("equipo" => "latina"));
        echo "\">Contacta en Latina </a>
                        <a class=\"dropdown-item\" href=\"";
        // line 56
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("contacto", array("equipo" => "usera"));
        echo "\">Contacta en Usera </a>
                    </div>
                </li>
                    <a class=\"nav-link\" href=\"/acceso\">Acceso</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- END Navigation -->

";
        // line 67
        $this->displayBlock('body', $context, $blocks);
        // line 68
        echo "
<!-- Footer -->
<footer class=\"py-5 bg-dark\">
    <div class=\"container\">
        <p class=\"m-0 text-center text-white\">© 2019 Convergencia de las Culturas</p>
    </div>
</footer>
<!-- END Footer -->

<!-- Bootstrap core JavaScript -->
<script src=\"";
        // line 78
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("vendor/jquery/jquery.min.js"), "html", null, true);
        echo "\"></script>
<script src=\"";
        // line 79
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("vendor/bootstrap/js/bootstrap.bundle.min.js"), "html", null, true);
        echo "\"></script>

";
        // line 81
        $this->displayBlock('javascripts', $context, $blocks);
        // line 82
        echo "</body>
</html>
";
    }

    // line 5
    public function block_title($context, array $blocks = array())
    {
        echo "Welcome!";
    }

    // line 13
    public function block_stylesheets($context, array $blocks = array())
    {
    }

    // line 67
    public function block_body($context, array $blocks = array())
    {
    }

    // line 81
    public function block_javascripts($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "base.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  170 => 81,  165 => 67,  160 => 13,  154 => 5,  148 => 82,  146 => 81,  141 => 79,  137 => 78,  125 => 68,  123 => 67,  109 => 56,  105 => 55,  101 => 54,  77 => 33,  71 => 30,  59 => 21,  48 => 14,  46 => 13,  41 => 11,  35 => 8,  29 => 5,  23 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "base.html.twig", "/shared/httpd/convergenciadeculturas/app/Resources/views/base.html.twig");
    }
}
