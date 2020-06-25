<?php

/**
 * @author: albertosanchez
 * Nuevo Service para enviar el mail de la ApiKey de usuario
 */

namespace AppBundle\Service;


class SendMailApiKey extends SendMail
{

    public function __invoke($user)
    {
        // Vamos a generar los datos del mail

        $this->mail['fromName'] = 'La Polifacética';

        // mail-to ha de ser un array siempre
        $this->mail['to'] = [
            $user->getEmail() => $user->getUsername(),
        ];

        $this->mail['subject'] = 'Nueva ApiKey para usuario ' . $user->getUsername() . ' en lapolifacetica.net';
        $this->mail['message'] =  'Se ha generado una nueva ApiKey para el usuario ' . $user->getUsername() . '<br /><br />';
        $this->mail['message'] .=  '<strong>ApiKey: </strong>' . $user->getApikey() . '<br /><br />';
        $this->mail['message'] .=  'Este token sólo puede utilizarse para operaciones con la api.<br />';
        /*var_dump($this->mail); die(' === eso');*/
        if ( $this->sendMail() ){
            return true;
        } else {
            return false;
        }
    }
}