<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appProdProjectContainerUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
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

        // homepage
        if ('' === $trimmedPathinfo) {
            $ret = array (  '_controller' => 'AppBundle\\Controller\\DefaultController::indexAction',  '_route' => 'homepage',);
            if ('/' === substr($pathinfo, -1)) {
                // no-op
            } elseif ('GET' !== $canonicalMethod) {
                goto not_homepage;
            } else {
                return array_replace($ret, $this->redirect($rawPathinfo.'/', 'homepage'));
            }

            return $ret;
        }
        not_homepage:

        // nosotros
        if ('/nosotros' === $pathinfo) {
            return array (  '_controller' => 'AppBundle\\Controller\\DefaultController::nosotrosAction',  '_route' => 'nosotros',);
        }

        // materiales
        if ('/materiales' === $pathinfo) {
            return array (  '_controller' => 'AppBundle\\Controller\\DefaultController::materialesAction',  '_route' => 'materiales',);
        }

        // contacto
        if (0 === strpos($pathinfo, '/contacto') && preg_match('#^/contacto(?:/(?P<equipo>[^/]++))?$#sD', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'contacto')), array (  'equipo' => 'none',  '_controller' => 'AppBundle\\Controller\\DefaultController::contactoAction',));
        }

        // acceso
        if ('/acceso' === $pathinfo) {
            return array (  '_controller' => 'AppBundle\\Controller\\DefaultController::accesoAction',  '_route' => 'acceso',);
        }

        if ('/' === $pathinfo && !$allow) {
            throw new Symfony\Component\Routing\Exception\NoConfigurationException();
        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
