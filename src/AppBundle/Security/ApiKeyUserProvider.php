<?php
// src/AppBundle/Security/ApiKeyUserProvider.php
namespace AppBundle\Security;

use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
//use Symfony\Component\Security\Core\User\User;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

use AppBundle\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class ApiKeyUserProvider implements UserProviderInterface
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getUserForApiKey($apiKey)
    {
        // Look up the username based on the token in the database, via
        // an API call, or do something entirely different

        $user = $this->em->getRepository(User::class)->loadUserByApiKey($apiKey);
            //->findOneBy(['apikey' => $apiKey]);

        // var_dump($user);die('  ===> bye ApiProvider');

        $username = $apiKey;

        return $user;
    }

    public function loadUserByUsername($username)
    {
        return new User(
            $username,
            null,
            // the roles for the user - you may choose to determine
            // these dynamically somehow based on the user
            ['ROLE_API']
        );
    }

    public function refreshUser(UserInterface $user)
    {
        // this is used for storing authentication in the session
        // but in this example, the token is sent in each request,
        // so authentication can be stateless. Throwing this exception
        // is proper to make things stateless
        throw new UnsupportedUserException();
    }

    public function supportsClass($class)
    {
        return User::class === $class;
    }
}