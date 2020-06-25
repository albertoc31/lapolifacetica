<?php

/**
 * @author: albertosanchez
 * Nuevo Service para enviar el mail de registro
 */

namespace AppBundle\Service;


class SendMailRegistry extends SendMail
{
    private $asociaciones;
    private $baseurl;

    /**
     * @param $baseurl
     */
    public function setBaseurl($baseurl) {

        $this->baseurl = $baseurl;
    }

    /**
     * @param $asociaciones
     */
    public function setAsociaciones($asociaciones) {

        $this->asociaciones = $asociaciones;
    }

    /**
     * @param $user
     * @return bool
     */
    public function __invoke($user)
    {
        // Vamos a generar los datos del mail

        $this->mail['fromName'] = 'La Polifacética';
        $this->mail['asociacion'] = 'La Polifacetica'; // Por defecto, el general

        /*var_dump($this->asociaciones); die(' === eso');*/

        // mail-to ha de ser un array siempre
        $this->mail['to'] = [
            $user->getEmail() => $user->getUsername(),
        ];
        foreach ($this->asociaciones as $asociacion){
            if ($asociacion->getId() == $user->getAsociacion()) {
                if ($asociacion->getEmail() != '') {
                    $this->mail['to'][$asociacion->getEmail()] = $asociacion->getName();
                    $this->mail['asociacion'] = $asociacion->getName();
                }
            }
        }

        $this->mail['subject'] = 'Nuevo registro de usuario en lapolifacetica.net';
        $this->mail['message'] =  'Se ha registrado un nuevo usuario con estos datos:<br /><br />';
        $this->mail['message'] .=  '<strong>Nombre de Usuario: </strong>' . $user->getUsername() . '<br />';
        $this->mail['message'] .=  '<strong>Email de Usuario: </strong>' . $user->getEmail() . '<br />';
        $this->mail['message'] .=  '<strong>Asociación: </strong>' . $this->mail['asociacion'] . '<br /><br />';
        $this->mail['message'] .=  'El usuario será plenamente operativo cuando un/a administrador/a de ' . $this->mail['asociacion'] . ' lo valide.<br />';
        $this->mail['message'] .=  'Puede modificar sus datos en cualquier momento <a href="' . $this->baseurl . '/editSelf/' . $user->getId() . '">aqui</a> una vez se haya logueado.<br />';

        /*var_dump($this->mail); die(' === eso');*/
        if ( $this->sendMail() ){
            return true;
        } else {
            return false;
        }
    }
}