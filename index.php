<?php
include_once __DIR__. '/vendor/autoload.php';

use App\Service\QueryFilter;
use App\Controller\SubscriptionController;
use App\Controller\ProviderController;
use App\Controller\EmailController;

if (!isset($_SESSION)) {
    session_start();
}
$url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);


switch ($url) {
    case '/delete':
        {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $request = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING,FILTER_SANITIZE_NUMBER_INT);
                SubscriptionController::deleteSubscription($request);
                header('Location: /page');
                exit;
            }
        }
        break;

    case '/':
        {
            require __DIR__ . '/app/frontend/views/index.php';
        }
        break;
    case '/page':
        {
            $providers = ProviderController::get()->getProviders();
            if (!isset($emails))
                $emails = EmailController::get()->getEmails();

            require __DIR__ . '/app/frontend/views/page.php';
        }
        break;
    case '/addEmail':
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $request = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            SubscriptionController::get()->addSubscription($request);
            header('Location: /');
            exit;
        }
    }
    case '/search':
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $result=QueryFilter::get()->filterSearch($_SERVER['QUERY_STRING']);
            $emails = $result[0];
            $providers = ProviderController::get()->getProviders();
            parse_str($_SERVER['QUERY_STRING'], $filters);
            include_once __DIR__ . '/app/frontend/views/page.php';
            exit;
        }
    }
    default:
    {
        header('Location: /');
        exit;
    }
}
