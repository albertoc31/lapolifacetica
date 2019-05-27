<?php

/* home/activity.html.twig */
class __TwigTemplate_d1eaff57f4350a5497662719aa0a7bbf020e0588f47ba2401815b3504a4dedf6 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 2
        $this->parent = $this->loadTemplate("base.html.twig", "home/activity.html.twig", 2);
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
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "home/activity.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "home/activity.html.twig"));

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

        echo "Convergencia de las Culturas - Actividad";
        
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
        echo "<!-- Page Content -->
<div class=\"container\">

    <!-- Page Heading/Breadcrumbs -->
    <h1 class=\"mt-4 mb-3\">Nuestras Actividades</h1>

    <!-- Portfolio Item Row -->
    <div class=\"row\">

        <div class=\"col-md-8\">
            <img class=\"img-fluid\" src=\"";
        // line 19
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl((($context["activityImg"] ?? $this->getContext($context, "activityImg")) . $this->getAttribute(($context["activity"] ?? $this->getContext($context, "activity")), "foto", array()))), "html", null, true);
        echo "\" alt=\"\">
        </div>

        <div class=\"col-md-4\">
            <h3 class=\"my-3\">";
        // line 23
        echo twig_escape_filter($this->env, $this->getAttribute(($context["activity"] ?? $this->getContext($context, "activity")), "activityName", array()), "html", null, true);
        echo "</h3>
            ";
        // line 24
        echo $this->getAttribute(($context["activity"] ?? $this->getContext($context, "activity")), "description", array());
        echo "
            <h3 class=\"my-3\">¿Cuando?</h3>
            <ul>
                <li><strong>Desde: </strong>";
        // line 27
        echo twig_escape_filter($this->env, $this->getAttribute(($context["activity"] ?? $this->getContext($context, "activity")), "desde", array()), "html", null, true);
        echo "</li>
                <li><strong>Hasta: </strong>";
        // line 28
        echo twig_escape_filter($this->env, $this->getAttribute(($context["activity"] ?? $this->getContext($context, "activity")), "hasta", array()), "html", null, true);
        echo "</li>
            </ul>
            <h3 class=\"my-3\">Agrupaciones</h3>
            <ul>
                ";
        // line 32
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["activity"] ?? $this->getContext($context, "activity")), "agrupaciones", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["agrupacion"]) {
            // line 33
            echo "                <li>";
            echo twig_escape_filter($this->env, $this->getAttribute($context["agrupacion"], "name", array()), "html", null, true);
            echo "</li>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['agrupacion'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 35
        echo "            </ul>
        </div>

    </div>
    <!-- /.row -->

    <!-- Related Projects Row -->
    <h3 class=\"my-4\">Related Projects</h3>

    <div class=\"row\">

        <div class=\"col-md-3 col-sm-6 mb-4\">
            <a href=\"#\">
                <img class=\"img-fluid\" src=\"http://placehold.it/500x300\" alt=\"\">
            </a>
        </div>

        <div class=\"col-md-3 col-sm-6 mb-4\">
            <a href=\"#\">
                <img class=\"img-fluid\" src=\"http://placehold.it/500x300\" alt=\"\">
            </a>
        </div>

        <div class=\"col-md-3 col-sm-6 mb-4\">
            <a href=\"#\">
                <img class=\"img-fluid\" src=\"http://placehold.it/500x300\" alt=\"\">
            </a>
        </div>

        <div class=\"col-md-3 col-sm-6 mb-4\">
            <a href=\"#\">
                <img class=\"img-fluid\" src=\"http://placehold.it/500x300\" alt=\"\">
            </a>
        </div>

    </div>
    <!-- /.row -->

</div>
<!-- /.container -->

";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 79
    public function block_stylesheets($context, array $blocks = array())
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "stylesheets"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "stylesheets"));

        // line 80
        echo "    ";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    public function getTemplateName()
    {
        return "home/activity.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  182 => 80,  173 => 79,  122 => 35,  113 => 33,  109 => 32,  102 => 28,  98 => 27,  92 => 24,  88 => 23,  81 => 19,  69 => 9,  60 => 8,  42 => 5,  11 => 2,);
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
{% block title %}Convergencia de las Culturas - Actividad{% endblock %}

{# BODY #}
{% block body %}
<!-- Page Content -->
<div class=\"container\">

    <!-- Page Heading/Breadcrumbs -->
    <h1 class=\"mt-4 mb-3\">Nuestras Actividades</h1>

    <!-- Portfolio Item Row -->
    <div class=\"row\">

        <div class=\"col-md-8\">
            <img class=\"img-fluid\" src=\"{{ asset(activityImg ~ activity.foto) }}\" alt=\"\">
        </div>

        <div class=\"col-md-4\">
            <h3 class=\"my-3\">{{ activity.activityName }}</h3>
            {{ activity.description | raw }}
            <h3 class=\"my-3\">¿Cuando?</h3>
            <ul>
                <li><strong>Desde: </strong>{{ activity.desde }}</li>
                <li><strong>Hasta: </strong>{{ activity.hasta }}</li>
            </ul>
            <h3 class=\"my-3\">Agrupaciones</h3>
            <ul>
                {% for agrupacion in activity.agrupaciones %}
                <li>{{ agrupacion.name }}</li>
                {% endfor %}
            </ul>
        </div>

    </div>
    <!-- /.row -->

    <!-- Related Projects Row -->
    <h3 class=\"my-4\">Related Projects</h3>

    <div class=\"row\">

        <div class=\"col-md-3 col-sm-6 mb-4\">
            <a href=\"#\">
                <img class=\"img-fluid\" src=\"http://placehold.it/500x300\" alt=\"\">
            </a>
        </div>

        <div class=\"col-md-3 col-sm-6 mb-4\">
            <a href=\"#\">
                <img class=\"img-fluid\" src=\"http://placehold.it/500x300\" alt=\"\">
            </a>
        </div>

        <div class=\"col-md-3 col-sm-6 mb-4\">
            <a href=\"#\">
                <img class=\"img-fluid\" src=\"http://placehold.it/500x300\" alt=\"\">
            </a>
        </div>

        <div class=\"col-md-3 col-sm-6 mb-4\">
            <a href=\"#\">
                <img class=\"img-fluid\" src=\"http://placehold.it/500x300\" alt=\"\">
            </a>
        </div>

    </div>
    <!-- /.row -->

</div>
<!-- /.container -->

{% endblock %}

{# CSS #}
{% block stylesheets %}
    {#<style>
        body { background: #F5F5F5; font: 18px/1.5 sans-serif; }
    </style>#}
{% endblock %}




", "home/activity.html.twig", "/Users/albertosanchez/Documents/DEV/projects/convergenciadeculturas/app/Resources/views/home/activity.html.twig");
    }
}
