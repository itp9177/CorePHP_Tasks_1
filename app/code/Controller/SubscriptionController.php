<?php

namespace App\Controller;

use App\Model\Email;
use Core\AbstractClass\Controller;

if (!isset($_SESSION)) {
    session_start();
}

class SubscriptionController extends Controller
{

    private static $controller;

    public static function get()
    {
        if (self::$controller == null) {
            self::$controller = new SubscriptionController();
        }
        return self::$controller;
    }
    public function addSubscription($request)
    {
        $this->validator($request);
        $email = $request['email1'];
        $details = $this->domainName($email);
        $provider = $details['provider'];

        if (!ProviderController::get()->checkProvider($provider))
            ProviderController::get()->addProvider($provider);

        $providerID = ProviderController::get()->getProviderId($provider);
        $newEmail = new Email($email, $providerID);
        $newEmail->save();

        $_SESSION['success'] = true;
    }
    public static function deleteSubscription($request)
    {
        $emailId = $request['id'];
        EmailController::get()->deleteEmail($emailId);
    }

    private function validator($request)
    {
        $errorMsgs = ['validEmail' => 'Please provide a valid e-mail address',
            'termsCheck' => 'You must accept the terms and conditions',
            'emailRequier' => 'Email address is required',
            'ColombiaDomain' => 'We are not accepting subscriptions from Colombia emails',
            'emailExists'=>'email already exists'];

        $erros = [];
        $email = $request['email1'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
            array_push($erros, $errorMsgs['validEmail']);

        if (!$request['terms'] == 'checked')
            array_push($erros, $errorMsgs['termsCheck']);

        if ($email == '')
            array_push($erros, $errorMsgs['emailRequier']);

        if ($this->domainName($email)['domain'] == 'co')
            array_push($erros, $errorMsgs['ColombiaDomain']);

        if(EmailController::get()->checkEmail($email))
            array_push($erros, $errorMsgs['emailExists']);

        if ($erros == []) return TRUE;


        $_SESSION["erros"] = $erros;
        $_SESSION["req"] = $request;

        header('Location: /');
        exit;

    }

    private function domainName($email)
    {
        $parts = explode('@', $email);
        $domain = explode('.', $parts[1]);
        return ['provider' => $parts[1], 'domain' => $domain[1]];
    }

}
