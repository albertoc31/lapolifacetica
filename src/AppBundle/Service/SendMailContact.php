<?php

/**
 * @author: albertosanchez
 * Nuevo Service para enviar el mail de contacto
 */

namespace AppBundle\Service;


class SendMailContact extends SendMail
{
    private $asociaciones;

    /**
     * @param $asociaciones
     */
    public function setAsociaciones($asociaciones) {

        $this->asociaciones = $asociaciones;
    }

    public function __invoke($data)
    {
        // Vamos a generar los datos del mail

        $this->mail['fromName'] = 'La Polifacética';

        // mail-to ha de ser un array siempre
        $this->mail['to'] = [
            $data["email"] => $data["name"],
        ];

        $asociaciones_nombres = [];

        if ( in_array(0, $data["asociaciones"]) ) {
            $this->mail['to']['asociacionlapolifacetica@gmail.com'] = 'La Polifacética';
            $asociaciones_nombres[0] = 'La Polifacética';
        }

        foreach ($this->asociaciones as $asociacion){
            if ( in_array($asociacion->getId(), $data["asociaciones"]) ) {
                if ($asociacion->getEmail() != '') {
                    $this->mail['to'][$asociacion->getEmail()] = $asociacion->getName();
                    $asociaciones_nombres[] = $asociacion->getName();
                }
            }
        }

        $asociaciones_nombres = implode(', ',  $asociaciones_nombres );

        $this->mail['subject'] = 'Nuevo mensaje desde www.lapolifacetica.net: ' . $data["subject"];

        $this->mail['message'] =  'Se ha recibido un nuevo mensaje en el formulario de contacto con los siguientes datos:<br /><br />';
        $this->mail['message'] .=  '<strong>Nombre: </strong>' . $data["name"] . '<br />';
        $this->mail['message'] .=  '<strong>Email: </strong>' . $data["email"] . '<br />';
        $this->mail['message'] .=  '<strong>Asociaciones destinatarias: </strong>' . $asociaciones_nombres . '<br /><br />';
        $this->mail['message'] .=  '<strong>Mensaje: </strong>' . $data["message"] . '<br />';

        /*var_dump($this->mail); die(' === eso');*/

        if ( $this->sendMail() ){
            return true;
        } else {
            return false;
        }
    }
}