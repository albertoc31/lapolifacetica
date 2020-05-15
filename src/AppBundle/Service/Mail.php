<?php

/**
 * @author: albertosanchez
 * Nuevo Service para gestionar los diferentes mails
 */

namespace AppBundle\Service;



class Mail
{
    private $mail = [];

    private $asociaciones;

    private $baseurl = '/';

    private $params;

    public function __construct($mail_config)
    {
        $this->mail['server'] = $mail_config['mail_server'];
        $user = 'mail_user_' . $mail_config['mail_server'];
        $pass = 'mail_pass_' . $mail_config['mail_server'];
        $this->mail['from'] = $mail_config[$user];
        $this->mail['pass'] = $mail_config[$pass];
    }

    public function setBaseurl($baseurl) {

        $this->baseurl = $baseurl;
    }

    public function setAsociaciones($asociaciones) {

        $this->asociaciones = $asociaciones;
    }

    public function registryMail($user)
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

    public function contactMail($data)
    {
        // Vamos a generar los datos del mail

        $this->mail['fromName'] = 'La Polifacética';
        $this->mail['asociacion'] = 'La Polifacetica'; // Por defecto, el general

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

    public function apiMail($user)
    {
        // Vamos a generar los datos del mail

        $this->mail['fromName'] = 'La Polifacética';
        $this->mail['asociacion'] = 'La Polifacetica'; // Por defecto, el general

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

    private function sendMail(){

        // In this case we'll use GMAIL mail services.
        // If your service is another, then read the following article to know which smpt code to use and which port
        // http://ourcodeworld.com/articles/read/14/swiftmailer-send-mails-from-php-easily-and-effortlessly
        if ($this->mail['server'] == 'gmail') {
            $transport = \Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, 'ssl')
                ->setUsername($this->mail['from'])
                ->setPassword($this->mail['pass']);
        }

        if ($this->mail['server'] == 'ionos') {
            $transport = \Swift_SmtpTransport::newInstance('smtp.ionos.es')
                ->setUsername($this->mail['from'])
                ->setPassword($this->mail['pass'])
                ->setPort(587)->setEncryption('tls');
        }

        if (isset($transport)) {
            $mailer = \Swift_Mailer::newInstance($transport);
            $sender = [$this->mail['from'] => $this->mail['fromName']];
            $to = array_merge($sender,$this->mail['to'] );

            $message = \Swift_Message::newInstance($this->mail['subject'])
                ->setFrom($sender)
                ->setTo($to)
                ->setBody($this->mail['message'], 'text/html');

            return $mailer->send($message);
        } else {
            return false;
        }
    }
}