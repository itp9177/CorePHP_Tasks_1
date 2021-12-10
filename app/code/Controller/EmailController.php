<?php

namespace App\Controller;

use database\DbConnection as db;
use Megebit\AbstractClass\Controller;

class EmailController extends Controller
{
    private static $controller;


    public static function get()
    {
        if (self::$controller == null) {
            self::$controller = new EmailController();
        }
        return self::$controller;
    }

    public function getEmails()
    {
        $sql = "SELECT Emails.id,Emails.Email,Providers.Name From Emails,Providers where Emails.providerID=Providers.id";
        return db::getConnection()->query($sql);
    }

    public function checkEmail($Email)
    {
        $sql = "SELECT * From Emails where Email='$Email'";
        $result = db::getConnection()->query($sql);
        return ($result == NULL) ? FALSE : TRUE;

    }

    public function deleteEmail($emailId)
    {
        $sql = "DELETE FROM Emails WHERE id='$emailId'";
        db::getConnection()->query($sql);
    }
}