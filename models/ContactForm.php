<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $name;
    public $email;
    public $subject;
    public $body;
    //public $verifyCode;
    public $to;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'email', 'subject', 'body','to'], 'required'],
            // email has to be a valid email address
            ['email', 'email'],
            // verifyCode needs to be entered correctly
            //['verifyCode', 'captcha'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Nombre',
            'email' => 'Correo',
            'subject' => 'Asunto',
            'body' => 'Texto',
            'to' => 'Enviar a',
            //'verifyCode' => 'Código de Verificación',
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param  string  $email the target email address
     * @return boolean whether the model passes validation
     */
    public function contact($email=null)
    {
        if ($this->validate()) {
            $transport = new \Swift_SmtpTransport('smtp.zoho.com', 587,'tls');
            $transport->setUsername($this->to);
            $transport->setPassword($this->passmail($this->to));
            $transport->setAuthMode('login');
            $mailer = \Swift_Mailer::newInstance($transport);

            $message = \Swift_Message::newInstance()
                ->setTo([($email == null) ? $this->to : $email])
                ->setFrom([$this->email => $this->name])
                //->setTo(array('receiver@domain.org', 'other@domain.org' => 'A name'))
                ->setSubject($this->subject)
                ->setBody($this->body);
            $mailer->send($message);
            return true;
        } else {
            return false;
        }
    }

    static public function correos()
    {
        $correos = [];
        $dominio = 'graficasingular.com';

        array_push($correos,['correo'=>'ctplp'.'@'.$dominio,'nombre'=>'CTP La Paz']);
        array_push($correos,['correo'=>'ctpea'.'@'.$dominio,'nombre'=>'CTP El Alto']);
        array_push($correos,['correo'=>'ctpcbba'.'@'.$dominio,'nombre'=>'CTP Cochabamba']);
        array_push($correos,['correo'=>'ctpscz'.'@'.$dominio,'nombre'=>'CTP Santa Cruz']);

        array_push($correos,['correo'=>'imprenta'.'@'.$dominio,'nombre'=>'Imprenta']);
        array_push($correos,['correo'=>'cotizacion'.'@'.$dominio,'nombre'=>'Cotizaciones']);
        array_push($correos,['correo'=>'gerencia'.'@'.$dominio,'nombre'=>'Gerencia']);
        //array_push($correos,['correo'=>'admingral'.'@'.$dominio,'nombre'=>'Administracion General']);
        array_push($correos,['correo'=>'adminctp'.'@'.$dominio,'nombre'=>'Administracion CTP']);

        return $correos;
    }

    private function passmail($mail)
    {
        $dominio = 'graficasingular.com';
        $standar = 's1ngul4r';
        $emails=[
            'ctplp'.'@'.$dominio=>'l'.$standar.'p',
            'ctpea'.'@'.$dominio=>'e'.$standar.'a',
            'ctpcbba'.'@'.$dominio=>'cb'.$standar.'ba',
            'ctpscz'.'@'.$dominio=>'s'.$standar.'cz',
        ];
        return $emails[$mail];
    }
}
