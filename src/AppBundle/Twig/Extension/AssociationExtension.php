<?php
/**
 * Created by PhpStorm.
 * User: albertosanchez
 * Date: 2019-06-14
 * Time: 14:27
 */

namespace AppBundle\Twig\Extension;

use Doctrine\ORM\EntityManagerInterface;
use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;

class AssociationExtension  extends AbstractExtension implements GlobalsInterface
{

    protected $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getGlobals()
    {
        return [
            'asociaciones' => $this->em->getRepository(\AppBundle\Entity\Asociacion::class)->findAll(),
        ];
    }

}