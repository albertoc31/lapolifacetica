<?php

/* home/nosotros.html.twig */
class __TwigTemplate_ff24203c410fd09f5d256e0fec44fcc0e07f6825e9d68977fd440043c63acd98 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 2
        $this->parent = $this->loadTemplate("base.html.twig", "home/nosotros.html.twig", 2);
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
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "home/nosotros.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "home/nosotros.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    // line 5
    public function block_title($context, array $blocks = array())
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        echo "Convergencia de las Culturas - Nosotros";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 8
    public function block_body($context, array $blocks = array())
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 9
        echo "    <div class=\"container\">

        <!-- Page Heading/Breadcrumbs -->
        <h1 class=\"mt-4 mb-3\">Sobre Convergencia
            <small> y nuestras acciones</small>
        </h1>
        <!-- END Page Heading/Breadcrumbs -->

        <!-- Image Header -->
        <img class=\"img-fluid rounded mb-4\" src=\"";
        // line 18
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("img/nosotros.convergencia.jpeg"), "html", null, true);
        echo "\" alt=\"\">
        <!-- END Image Header -->

        <p>Son muchas las actividades que realiza Convergencia de las Culturas a lo largo y ancho del planeta. Nuestros
            equipos se caracterizan por su activismo y su trabajo voluntario en diversas áreas. ¿Te gustaría participar con nosotros?
        Contáctanos a través de nuestro <a href=\"";
        // line 23
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("contacto");
        echo "\">formulario de contacto</a></p>

        <!-- Acciones -->
        <h2>Algunas de nuestra acciones</h2>
        <div class=\"row\">
            <div class=\"col-lg-4 col-sm-6 portfolio-item\">
                <div class=\"card h-100\">
                    <a href=\"#\"><img class=\"card-img-top\" src=\"";
        // line 30
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("images/apoyo_escolar.jpg"), "html", null, true);
        echo "\" alt=\"\"></a>
                    <div class=\"card-body\">
                        <h4 class=\"card-title\">Apoyo Escolar en el barrio de Lavapiés
                        </h4>
                        <p class=\"card-text\">Partiendo de una actividad de apoyo escolar, buscamos generar una red de contactos con adolescentes
                            y familias para poder trabajar en un Proyecto Educativo que intenta fomentar entre los más jóvenes
                            valores de tolerancia, igualdad, respeto y solidaridad.</p>
                    </div>
                </div>
            </div>
            <div class=\"col-lg-4 col-sm-6 portfolio-item\">
                <div class=\"card h-100\">
                    <a href=\"#\"><img class=\"card-img-top\" src=\"";
        // line 42
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("images/cena_ramadan.jpg"), "html", null, true);
        echo "\" alt=\"\"></a>
                    <div class=\"card-body\">
                        <h4 class=\"card-title\">
                            Cena de Ramadán con los vecinos
                        </h4>
                        <p class=\"card-text\">Aprovechando el mes del Ramadán, hicimos en el Barrio del Pilar de Madrid una cena compartida
                            a la que invitamos a los vecinos y los amigos en un precioso ejemplo de convivencia multicultural,
                            a la vez que reivinidcábamos el papel histórico del Islam en nuestra historia.</p>
                    </div>
                </div>
            </div>
            <div class=\"col-lg-4 col-sm-6 portfolio-item\">
                <div class=\"card h-100\">
                    <a href=\"#\"><img class=\"card-img-top\" src=\"";
        // line 55
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("images/mesa_interculturalidad.jpg"), "html", null, true);
        echo "\" alt=\"\"></a>
                    <div class=\"card-body\">
                        <h4 class=\"card-title\">
                            Mesa de Interculturalidad del Foro Humanista Europeo
                        </h4>
                        <p class=\"card-text\">Durante el Foro Humanista Europeo celebrado en Madrid el 2018 organizamos la Mesa de
                            Interculturalidad, compartiendo un espacio de reflexión y diálogo con numerosas amigas y amigos representativos
                            de las diversas culturas que convivimos en este proyecto común.</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Acciones -->


    </div>
";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 74
    public function block_stylesheets($context, array $blocks = array())
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "stylesheets"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "stylesheets"));

        // line 75
        echo "    ";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    public function getTemplateName()
    {
        return "home/nosotros.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  165 => 75,  156 => 74,  129 => 55,  113 => 42,  98 => 30,  88 => 23,  80 => 18,  69 => 9,  60 => 8,  42 => 5,  11 => 2,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("{# Pagina Index #}
{% extends 'base.html.twig' %}

{# TITULO #}
{% block title %}Convergencia de las Culturas - Nosotros{% endblock %}

{# BODY #}
{% block body %}
    <div class=\"container\">

        <!-- Page Heading/Breadcrumbs -->
        <h1 class=\"mt-4 mb-3\">Sobre Convergencia
            <small> y nuestras acciones</small>
        </h1>
        <!-- END Page Heading/Breadcrumbs -->

        <!-- Image Header -->
        <img class=\"img-fluid rounded mb-4\" src=\"{{ asset('img/nosotros.convergencia.jpeg') }}\" alt=\"\">
        <!-- END Image Header -->

        <p>Son muchas las actividades que realiza Convergencia de las Culturas a lo largo y ancho del planeta. Nuestros
            equipos se caracterizan por su activismo y su trabajo voluntario en diversas áreas. ¿Te gustaría participar con nosotros?
        Contáctanos a través de nuestro <a href=\"{{ path('contacto') }}\">formulario de contacto</a></p>

        <!-- Acciones -->
        <h2>Algunas de nuestra acciones</h2>
        <div class=\"row\">
            <div class=\"col-lg-4 col-sm-6 portfolio-item\">
                <div class=\"card h-100\">
                    <a href=\"#\"><img class=\"card-img-top\" src=\"{{ asset('images/apoyo_escolar.jpg') }}\" alt=\"\"></a>
                    <div class=\"card-body\">
                        <h4 class=\"card-title\">Apoyo Escolar en el barrio de Lavapiés
                        </h4>
                        <p class=\"card-text\">Partiendo de una actividad de apoyo escolar, buscamos generar una red de contactos con adolescentes
                            y familias para poder trabajar en un Proyecto Educativo que intenta fomentar entre los más jóvenes
                            valores de tolerancia, igualdad, respeto y solidaridad.</p>
                    </div>
                </div>
            </div>
            <div class=\"col-lg-4 col-sm-6 portfolio-item\">
                <div class=\"card h-100\">
                    <a href=\"#\"><img class=\"card-img-top\" src=\"{{ asset('images/cena_ramadan.jpg') }}\" alt=\"\"></a>
                    <div class=\"card-body\">
                        <h4 class=\"card-title\">
                            Cena de Ramadán con los vecinos
                        </h4>
                        <p class=\"card-text\">Aprovechando el mes del Ramadán, hicimos en el Barrio del Pilar de Madrid una cena compartida
                            a la que invitamos a los vecinos y los amigos en un precioso ejemplo de convivencia multicultural,
                            a la vez que reivinidcábamos el papel histórico del Islam en nuestra historia.</p>
                    </div>
                </div>
            </div>
            <div class=\"col-lg-4 col-sm-6 portfolio-item\">
                <div class=\"card h-100\">
                    <a href=\"#\"><img class=\"card-img-top\" src=\"{{ asset('images/mesa_interculturalidad.jpg') }}\" alt=\"\"></a>
                    <div class=\"card-body\">
                        <h4 class=\"card-title\">
                            Mesa de Interculturalidad del Foro Humanista Europeo
                        </h4>
                        <p class=\"card-text\">Durante el Foro Humanista Europeo celebrado en Madrid el 2018 organizamos la Mesa de
                            Interculturalidad, compartiendo un espacio de reflexión y diálogo con numerosas amigas y amigos representativos
                            de las diversas culturas que convivimos en este proyecto común.</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Acciones -->


    </div>
{% endblock %}

{# CSS #}
{% block stylesheets %}
    {#<style>
        body { background: #F5F5F5; font: 18px/1.5 sans-serif; }
    </style>#}
{% endblock %}", "home/nosotros.html.twig", "/Users/albertosanchez/Documents/DEV/projects/convergenciadeculturas/app/Resources/views/home/nosotros.html.twig");
    }
}
