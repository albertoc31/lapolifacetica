<?php
// src/AppBundle/Security/UserAuthenticator.php
namespace AppBundle\Security;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;

use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;


class UserAuthenticator extends AbstractGuardAuthenticator
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    /**
     * Called on every request to decide if this authenticator should be
     * used for the request. Returning `false` will cause this authenticator
     * to be skipped.
     */
    public function supports(Request $request)
    {
        // var_dump($this->security->getUser());die(' ==> Paso por supports');
        /*if ($this->security->getUser()) {
            // Si ya es un usuario logueado, me salto comprobaciones.
            return false;
        }*/
        if ( substr($request->attributes->get('_route'), 0,4) == 'api_'){
            return true;
        }
        // si trae token de API pero no va a ruta de api, de todos modos lo obligo a autenticarse
        return $request->headers->has('X-AUTH-TOKEN');
    }

    /**
     * Called on every request. Return whatever credentials you want to
     * be passed to getUser() as $credentials.
     */
    public function getCredentials(Request $request)
    {
        // var_dump($request);die(' ==> Paso por getCredentials');
        return $request->headers->get('X-AUTH-TOKEN');

    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        /*if ($user = $this->security->getUser()) {
            // Si ya es un usuario logueado, me salto comprobaciones.
            return $user;
        }*/
        if (null === $credentials) {
            // The token header was empty, authentication fails with HTTP Status
            // Code 401 "Unauthorized"
            return null;
        }

        // if a User is returned, checkCredentials() is called
        $user = $userProvider->getUserForApiKey($credentials);
        return $user;
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        // check credentials - e.g. make sure the password is valid

        $user_credentials = $user->getApikey();

        // We search user in database with half the apiKey to avoid remote timing attack
        // https://blog.ircmaxell.com/2014/11/its-all-about-time.html

        if (!hash_equals($user_credentials, $credentials)) {
            throw new CustomUserMessageAuthenticationException(
                'Not equal API key: are you faking the app?'
            );
        }
        if ($credentials == 'PoromPompero') {
            throw new CustomUserMessageAuthenticationException(
                'PoromPompero is not a real API key: it\'s just a silly phrase'
            );
        }

        // return true to cause authentication success
        return true;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        // on success, let the request continue
        return null;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        $data = [
            // you may want to customize or obfuscate the message first
            'message' => strtr($exception->getMessageKey(), $exception->getMessageData())

            // or to translate this message
            // $this->translator->trans($exception->getMessageKey(), $exception->getMessageData())
        ];

        return new JsonResponse($data, Response::HTTP_UNAUTHORIZED);
    }

    /**
     * Called when authentication is needed, but it's not sent
     */
    public function start(Request $request, AuthenticationException $authException = null)
    {
        $data = [
            // you might translate this message
            'message' => 'Authentication Required Neng'
        ];

        return new JsonResponse($data, Response::HTTP_UNAUTHORIZED);
    }

    public function supportsRememberMe()
    {
        return false;
    }
}