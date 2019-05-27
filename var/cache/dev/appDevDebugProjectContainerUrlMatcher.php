<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appDevDebugProjectContainerUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($rawPathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($rawPathinfo);
        $trimmedPathinfo = rtrim($pathinfo, '/');
        $context = $this->context;
        $request = $this->request ?: $this->createRequest($pathinfo);
        $requestMethod = $canonicalMethod = $context->getMethod();

        if ('HEAD' === $requestMethod) {
            $canonicalMethod = 'GET';
        }

        if (0 === strpos($pathinfo, '/_')) {
            // _wdt
            if (0 === strpos($pathinfo, '/_wdt') && preg_match('#^/_wdt/(?P<token>[^/]++)$#sD', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => '_wdt')), array (  '_controller' => 'web_profiler.controller.profiler:toolbarAction',));
            }

            if (0 === strpos($pathinfo, '/_profiler')) {
                // _profiler_home
                if ('/_profiler' === $trimmedPathinfo) {
                    $ret = array (  '_controller' => 'web_profiler.controller.profiler:homeAction',  '_route' => '_profiler_home',);
                    if ('/' === substr($pathinfo, -1)) {
                        // no-op
                    } elseif ('GET' !== $canonicalMethod) {
                        goto not__profiler_home;
                    } else {
                        return array_replace($ret, $this->redirect($rawPathinfo.'/', '_profiler_home'));
                    }

                    return $ret;
                }
                not__profiler_home:

                if (0 === strpos($pathinfo, '/_profiler/search')) {
                    // _profiler_search
                    if ('/_profiler/search' === $pathinfo) {
                        return array (  '_controller' => 'web_profiler.controller.profiler:searchAction',  '_route' => '_profiler_search',);
                    }

                    // _profiler_search_bar
                    if ('/_profiler/search_bar' === $pathinfo) {
                        return array (  '_controller' => 'web_profiler.controller.profiler:searchBarAction',  '_route' => '_profiler_search_bar',);
                    }

                }

                // _profiler_phpinfo
                if ('/_profiler/phpinfo' === $pathinfo) {
                    return array (  '_controller' => 'web_profiler.controller.profiler:phpinfoAction',  '_route' => '_profiler_phpinfo',);
                }

                // _profiler_search_results
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/search/results$#sD', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_search_results')), array (  '_controller' => 'web_profiler.controller.profiler:searchResultsAction',));
                }

                // _profiler_open_file
                if ('/_profiler/open' === $pathinfo) {
                    return array (  '_controller' => 'web_profiler.controller.profiler:openAction',  '_route' => '_profiler_open_file',);
                }

                // _profiler
                if (preg_match('#^/_profiler/(?P<token>[^/]++)$#sD', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler')), array (  '_controller' => 'web_profiler.controller.profiler:panelAction',));
                }

                // _profiler_router
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/router$#sD', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_router')), array (  '_controller' => 'web_profiler.controller.router:panelAction',));
                }

                // _profiler_exception
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/exception$#sD', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_exception')), array (  '_controller' => 'web_profiler.controller.exception:showAction',));
                }

                // _profiler_exception_css
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/exception\\.css$#sD', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_exception_css')), array (  '_controller' => 'web_profiler.controller.exception:cssAction',));
                }

            }

            // _twig_error_test
            if (0 === strpos($pathinfo, '/_error') && preg_match('#^/_error/(?P<code>\\d+)(?:\\.(?P<_format>[^/]++))?$#sD', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => '_twig_error_test')), array (  '_controller' => 'twig.controller.preview_error:previewErrorPageAction',  '_format' => 'html',));
            }

        }

        elseif (0 === strpos($pathinfo, '/administracionActivities/nueva')) {
            // nuevaActividad
            if ('/administracionActivities/nuevaActividad' === $pathinfo) {
                return array (  '_controller' => 'AppBundle\\Controller\\ActivityController::nuevaActividadAction',  '_route' => 'nuevaActividad',);
            }

            // nuevaAgrupacion
            if ('/administracionActivities/nuevaAgrupacion' === $pathinfo) {
                return array (  '_controller' => 'AppBundle\\Controller\\ActivityController::nuevaAgrupaciondAction',  '_route' => 'nuevaAgrupacion',);
            }

            // nuevaCategoria
            if ('/administracionActivities/nuevaCategoria' === $pathinfo) {
                return array (  '_controller' => 'AppBundle\\Controller\\ActivityController::nuevaCategoriadAction',  '_route' => 'nuevaCategoria',);
            }

        }

        // homepage
        if (preg_match('#^/(?P<pagina>[^/]++)?$#sD', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'homepage')), array (  'pagina' => 1,  '_controller' => 'AppBundle\\Controller\\DefaultController::indexAction',));
        }

        if (0 === strpos($pathinfo, '/a')) {
            // activity
            if (0 === strpos($pathinfo, '/activity') && preg_match('#^/activity(?:/(?P<id>[^/]++))?$#sD', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'activity')), array (  'id' => NULL,  '_controller' => 'AppBundle\\Controller\\DefaultController::activityAction',));
            }

            // acceso
            if ('/acceso' === $trimmedPathinfo) {
                $ret = array (  '_controller' => 'AppBundle\\Controller\\DefaultController::accesoAction',  '_route' => 'acceso',);
                if ('/' === substr($pathinfo, -1)) {
                    // no-op
                } elseif ('GET' !== $canonicalMethod) {
                    goto not_acceso;
                } else {
                    return array_replace($ret, $this->redirect($rawPathinfo.'/', 'acceso'));
                }

                return $ret;
            }
            not_acceso:

            // agrupacion
            if (0 === strpos($pathinfo, '/agrupacion') && preg_match('#^/agrupacion(?:/(?P<id>[^/]++))?$#sD', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'agrupacion')), array (  'id' => NULL,  '_controller' => 'AppBundle\\Controller\\DefaultController::agrupacionAction',));
            }

        }

        // category
        if (0 === strpos($pathinfo, '/category') && preg_match('#^/category(?:/(?P<id>[^/]++))?$#sD', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'category')), array (  'id' => NULL,  '_controller' => 'AppBundle\\Controller\\DefaultController::categoryAction',));
        }

        // contacto
        if (0 === strpos($pathinfo, '/contacto') && preg_match('#^/contacto(?:/(?P<equipo>[^/]++))?$#sD', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'contacto')), array (  'equipo' => 'none',  '_controller' => 'AppBundle\\Controller\\DefaultController::contactoAction',));
        }

        // nosotros
        if ('/nosotros' === $trimmedPathinfo) {
            $ret = array (  '_controller' => 'AppBundle\\Controller\\DefaultController::nosotrosAction',  '_route' => 'nosotros',);
            if ('/' === substr($pathinfo, -1)) {
                // no-op
            } elseif ('GET' !== $canonicalMethod) {
                goto not_nosotros;
            } else {
                return array_replace($ret, $this->redirect($rawPathinfo.'/', 'nosotros'));
            }

            return $ret;
        }
        not_nosotros:

        // materiales
        if ('/materiales' === $trimmedPathinfo) {
            $ret = array (  '_controller' => 'AppBundle\\Controller\\DefaultController::materialesAction',  '_route' => 'materiales',);
            if ('/' === substr($pathinfo, -1)) {
                // no-op
            } elseif ('GET' !== $canonicalMethod) {
                goto not_materiales;
            } else {
                return array_replace($ret, $this->redirect($rawPathinfo.'/', 'materiales'));
            }

            return $ret;
        }
        not_materiales:

        // registro
        if ('/registro' === $trimmedPathinfo) {
            $ret = array (  '_controller' => 'AppBundle\\Controller\\DefaultController::registroAction',  '_route' => 'registro',);
            if ('/' === substr($pathinfo, -1)) {
                // no-op
            } elseif ('GET' !== $canonicalMethod) {
                goto not_registro;
            } else {
                return array_replace($ret, $this->redirect($rawPathinfo.'/', 'registro'));
            }

            return $ret;
        }
        not_registro:

        // salir
        if ('/salir' === $pathinfo) {
            return array('_route' => 'salir');
        }

        if ('/' === $pathinfo && !$allow) {
            throw new Symfony\Component\Routing\Exception\NoConfigurationException();
        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
