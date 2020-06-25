<?php

/**
 * @author: albertosanchez
 * Nuevo Service para gestionar los diferentes mails
 * Abstract class para ser extendida
 */

namespace AppBundle\Service;



Abstract class SendMail
{
    protected $mail = [];

    public function __construct($mail_config)
    {
        $this->mail['server'] = $mail_config['mail_server'];
        $user = 'mail_user_' . $mail_config['mail_server'];
        $pass = 'mail_pass_' . $mail_config['mail_server'];
        $this->mail['from'] = $mail_config[$user];
        $this->mail['pass'] = $mail_config[$pass];
    }

    protected function sendMail(){

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