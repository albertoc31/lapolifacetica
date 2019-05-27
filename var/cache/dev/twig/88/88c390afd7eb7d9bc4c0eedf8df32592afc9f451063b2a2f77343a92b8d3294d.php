<?php

/* home/home.html.twig */
class __TwigTemplate_8756eee7a013b7c52eb8bbe88400063fac0ebcd8a1f527dcdb18f0e738ffb31f extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 2
        $this->parent = $this->loadTemplate("base.html.twig", "home/home.html.twig", 2);
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
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "home/home.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "home/home.html.twig"));

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

        echo "Convergencia de las Culturas Home";
        
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
        echo "
    <header>
        <div id=\"carouselExampleIndicators\" class=\"carousel slide\" data-ride=\"carousel\">
            <ol class=\"carousel-indicators\">
                <li data-target=\"#carouselExampleIndicators\" data-slide-to=\"0\" class=\"active\"></li>
                <li data-target=\"#carouselExampleIndicators\" data-slide-to=\"1\"></li>
                <li data-target=\"#carouselExampleIndicators\" data-slide-to=\"2\"></li>
            </ol>
            <div class=\"carousel-inner\" role=\"listbox\">
                <!-- Slide One - Set the background image for this slide in the line below -->
                <div class=\"carousel-item active\" style=\"background-image: url(";
        // line 19
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("img/diversity-01.jpg"), "html", null, true);
        echo ")\">
                    <div class=\"carousel-caption d-none d-md-block\">
                        <h3>Diversidad</h3>
                        <p>Una riqueza para nuestra sociedad.</p>
                    </div>
                </div>
                <!-- Slide Two - Set the background image for this slide in the line below -->
                <div class=\"carousel-item \" style=\"background-image: url(";
        // line 26
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("img/diversity-02.jpg"), "html", null, true);
        echo ")\">
                    <div class=\"carousel-caption d-none d-md-block\">
                        <h3>Interculturalidad</h3>
                        <p>Llevamos la diversidad en nuestro ADN.</p>
                    </div>
                </div>
                <!-- Slide Three - Set the background image for this slide in the line below -->
                <div class=\"carousel-item \" style=\"background-image: url(";
        // line 33
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("img/diversity-03.jpg"), "html", null, true);
        echo ")\">
                    <div class=\"carousel-caption d-none d-md-block\">
                        <h3>Encuentro</h3>
                        <p>Para un efectivo Diálogo entre Culturas.</p>
                    </div>
                </div>
            </div>
            <a class=\"carousel-control-prev\" href=\"#carouselExampleIndicators\" role=\"button\" data-slide=\"prev\">
                <span class=\"carousel-control-prev-icon\" aria-hidden=\"true\"></span>
                <span class=\"sr-only\">Previous</span>
            </a>
            <a class=\"carousel-control-next\" href=\"#carouselExampleIndicators\" role=\"button\" data-slide=\"next\">
                <span class=\"carousel-control-next-icon\" aria-hidden=\"true\"></span>
                <span class=\"sr-only\">Next</span>
            </a>
        </div>
    </header>

    <!-- Page Content -->
    <div class=\"container\">
        <h1 class=\"my-4\">Definición y Principios</h1>
        <p>Convergencia de las Culturas es un organismo que se propone promover la convergencia de las diversas culturas
            vivientes, hacia una cultura de la no-violencia que pueda conducir a la constitución de la Nación Humana
            Universal.</p>
        <p>Hacemos nuestros los 6 principios del Humanismo Universalista:</p>
        <ul>
            <li>La ubicación del ser humano como valor y preocupación central.</li>
            <li>La afirmación de la igualdad de todos los seres humanos.</li>
            <li>El reconocimiento de la diversidad personal y cultural.</li>
            <li>La tendencia al desarrollo del conocimiento por encima de lo aceptado o impuesto como verdad absoluta.</li>
            <li>La afirmación de la libertad de ideas y creencias.</li>
            <li>El repudio a la violencia.</li>
        </ul>

        <!-- Portfolio Section -->
        <h2>Actividades</h2>

        <div class=\"row\">

            ";
        // line 72
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["activities"] ?? $this->getContext($context, "activities")));
        foreach ($context['_seq'] as $context["_key"] => $context["activity"]) {
            // line 73
            echo "                <div class=\"col-lg-4 col-sm-6 portfolio-item\">
                    <div class=\"card h-100\">
                        <a href=\"";
            // line 75
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("activity", array("id" => $this->getAttribute($context["activity"], "id", array()))), "html", null, true);
            echo "\"><img class=\"card-img-top\" src=\"";
            if ((twig_length_filter($this->env, $this->getAttribute($context["activity"], "foto", array())) > 0)) {
                echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl((($context["activityImg"] ?? $this->getContext($context, "activityImg")) . $this->getAttribute($context["activity"], "foto", array()))), "html", null, true);
            } else {
                echo "http://placehold.it/700x400";
            }
            echo "\" alt=\"\"></a>
                        <div class=\"card-body\">
                            <h4 class=\"card-title\">
                                <a href=\"";
            // line 78
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("activity", array("id" => $this->getAttribute($context["activity"], "id", array()))), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute($context["activity"], "activityName", array()), "html", null, true);
            echo "</a>
                            </h4>
                            <p class=\"card-text\">";
            // line 80
            echo twig_escape_filter($this->env, $this->getAttribute($context["activity"], "shortDescription", array()), "html", null, true);
            echo "</p>
                        </div>
                    </div>
                </div>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['activity'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 85
        echo "
        </div>
        <!-- /.row -->

        <!-- Pagination -->
        <ul class=\"pagination justify-content-center\">
            ";
        // line 91
        if ((($context["paginaActual"] ?? $this->getContext($context, "paginaActual")) > 1)) {
            // line 92
            echo "            <li class=\"page-item\">
                <a class=\"page-link\" href=\"";
            // line 93
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("homepage", array("pagina" => ((((($context["paginaActual"] ?? $this->getContext($context, "paginaActual")) - 1) < 1)) ? (1) : ((($context["paginaActual"] ?? $this->getContext($context, "paginaActual")) - 1))))), "html", null, true);
            echo "\" aria-label=\"Previous\">
                    <span aria-hidden=\"true\">&laquo;</span>
                    <span class=\"sr-only\">Previous</span>
                </a>
            </li>
            ";
        }
        // line 99
        echo "
            ";
        // line 100
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(range(1, 3));
        foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
            // line 101
            echo "                <li class=\"page-item\">
                    <a class=\"page-link\" href=\"";
            // line 102
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("homepage", array("pagina" => $context["i"])), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $context["i"], "html", null, true);
            echo "</a>
                </li>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 105
        echo "
            ";
        // line 106
        if ((($context["paginaActual"] ?? $this->getContext($context, "paginaActual")) < 3)) {
            // line 107
            echo "            <li class=\"page-item\">
                <a class=\"page-link\" href=\"";
            // line 108
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("homepage", array("pagina" => (($context["paginaActual"] ?? $this->getContext($context, "paginaActual")) + 1))), "html", null, true);
            echo "\" aria-label=\"Next\">
                    <span aria-hidden=\"true\">&raquo;</span>
                    <span class=\"sr-only\">Next</span>
                </a>
            </li>
            ";
        }
        // line 114
        echo "        </ul>

    </div>


";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 122
    public function block_stylesheets($context, array $blocks = array())
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "stylesheets"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "stylesheets"));

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    public function getTemplateName()
    {
        return "home/home.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  256 => 122,  241 => 114,  232 => 108,  229 => 107,  227 => 106,  224 => 105,  213 => 102,  210 => 101,  206 => 100,  203 => 99,  194 => 93,  191 => 92,  189 => 91,  181 => 85,  170 => 80,  163 => 78,  151 => 75,  147 => 73,  143 => 72,  101 => 33,  91 => 26,  81 => 19,  69 => 9,  60 => 8,  42 => 5,  11 => 2,);
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
{% block title %}Convergencia de las Culturas Home{% endblock %}

{# BODY #}
{% block body %}

    <header>
        <div id=\"carouselExampleIndicators\" class=\"carousel slide\" data-ride=\"carousel\">
            <ol class=\"carousel-indicators\">
                <li data-target=\"#carouselExampleIndicators\" data-slide-to=\"0\" class=\"active\"></li>
                <li data-target=\"#carouselExampleIndicators\" data-slide-to=\"1\"></li>
                <li data-target=\"#carouselExampleIndicators\" data-slide-to=\"2\"></li>
            </ol>
            <div class=\"carousel-inner\" role=\"listbox\">
                <!-- Slide One - Set the background image for this slide in the line below -->
                <div class=\"carousel-item active\" style=\"background-image: url({{ asset('img/diversity-01.jpg') }})\">
                    <div class=\"carousel-caption d-none d-md-block\">
                        <h3>Diversidad</h3>
                        <p>Una riqueza para nuestra sociedad.</p>
                    </div>
                </div>
                <!-- Slide Two - Set the background image for this slide in the line below -->
                <div class=\"carousel-item \" style=\"background-image: url({{ asset('img/diversity-02.jpg') }})\">
                    <div class=\"carousel-caption d-none d-md-block\">
                        <h3>Interculturalidad</h3>
                        <p>Llevamos la diversidad en nuestro ADN.</p>
                    </div>
                </div>
                <!-- Slide Three - Set the background image for this slide in the line below -->
                <div class=\"carousel-item \" style=\"background-image: url({{ asset('img/diversity-03.jpg') }})\">
                    <div class=\"carousel-caption d-none d-md-block\">
                        <h3>Encuentro</h3>
                        <p>Para un efectivo Diálogo entre Culturas.</p>
                    </div>
                </div>
            </div>
            <a class=\"carousel-control-prev\" href=\"#carouselExampleIndicators\" role=\"button\" data-slide=\"prev\">
                <span class=\"carousel-control-prev-icon\" aria-hidden=\"true\"></span>
                <span class=\"sr-only\">Previous</span>
            </a>
            <a class=\"carousel-control-next\" href=\"#carouselExampleIndicators\" role=\"button\" data-slide=\"next\">
                <span class=\"carousel-control-next-icon\" aria-hidden=\"true\"></span>
                <span class=\"sr-only\">Next</span>
            </a>
        </div>
    </header>

    <!-- Page Content -->
    <div class=\"container\">
        <h1 class=\"my-4\">Definición y Principios</h1>
        <p>Convergencia de las Culturas es un organismo que se propone promover la convergencia de las diversas culturas
            vivientes, hacia una cultura de la no-violencia que pueda conducir a la constitución de la Nación Humana
            Universal.</p>
        <p>Hacemos nuestros los 6 principios del Humanismo Universalista:</p>
        <ul>
            <li>La ubicación del ser humano como valor y preocupación central.</li>
            <li>La afirmación de la igualdad de todos los seres humanos.</li>
            <li>El reconocimiento de la diversidad personal y cultural.</li>
            <li>La tendencia al desarrollo del conocimiento por encima de lo aceptado o impuesto como verdad absoluta.</li>
            <li>La afirmación de la libertad de ideas y creencias.</li>
            <li>El repudio a la violencia.</li>
        </ul>

        <!-- Portfolio Section -->
        <h2>Actividades</h2>

        <div class=\"row\">

            {% for activity in activities %}
                <div class=\"col-lg-4 col-sm-6 portfolio-item\">
                    <div class=\"card h-100\">
                        <a href=\"{{ path('activity', {'id':activity.id}) }}\"><img class=\"card-img-top\" src=\"{%- if activity.foto|length > 0 -%}{{ asset(activityImg ~ activity.foto) }}{%- else -%}http://placehold.it/700x400{%- endif -%}\" alt=\"\"></a>
                        <div class=\"card-body\">
                            <h4 class=\"card-title\">
                                <a href=\"{{ path('activity', {'id':activity.id}) }}\">{{ activity.activityName }}</a>
                            </h4>
                            <p class=\"card-text\">{{ activity.shortDescription }}</p>
                        </div>
                    </div>
                </div>
            {% endfor %}

        </div>
        <!-- /.row -->

        <!-- Pagination -->
        <ul class=\"pagination justify-content-center\">
            {% if paginaActual > 1 %}
            <li class=\"page-item\">
                <a class=\"page-link\" href=\"{{ path('homepage', {pagina: paginaActual-1 < 1 ? 1 : paginaActual-1 }) }}\" aria-label=\"Previous\">
                    <span aria-hidden=\"true\">&laquo;</span>
                    <span class=\"sr-only\">Previous</span>
                </a>
            </li>
            {% endif %}

            {% for i in 1..3 %}
                <li class=\"page-item\">
                    <a class=\"page-link\" href=\"{{ path('homepage', {pagina: i}) }}\">{{i}}</a>
                </li>
            {% endfor %}

            {% if paginaActual < 3 %}
            <li class=\"page-item\">
                <a class=\"page-link\" href=\"{{ path('homepage', {pagina: paginaActual+1 }) }}\" aria-label=\"Next\">
                    <span aria-hidden=\"true\">&raquo;</span>
                    <span class=\"sr-only\">Next</span>
                </a>
            </li>
            {% endif %}
        </ul>

    </div>


{% endblock %}

{# CSS #}
{% block stylesheets %}
{#<style>
    body { background: #F5F5F5; font: 18px/1.5 sans-serif; }
</style>#}
{% endblock %}", "home/home.html.twig", "/Users/albertosanchez/Documents/DEV/projects/convergenciadeculturas/app/Resources/views/home/home.html.twig");
    }
}
