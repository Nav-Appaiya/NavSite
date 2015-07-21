<?php
/**
 * Created by PhpStorm.
 * User: Nav
 * Date: 11-4-2015
 * Time: 3:09
 */

namespace Nav\NotificationBundle\Controller;


use SendGrid\Email;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MailController extends Controller
{

    public function indexAction()
    {
        $sendgrid = $this->get('tystr_sendgrid.sendgrid');
        $email = new Email();
        $email
            ->addTo('navarajh@gmail.com')
            ->setFrom('me@bar.com')
            ->setSubject('Subject goes here')
            ->setText('Hello World!')
            ->setHtml('<strong>Hello World!</strong>');

        print_r($sendgrid->send($email));

        exit;
    }

}