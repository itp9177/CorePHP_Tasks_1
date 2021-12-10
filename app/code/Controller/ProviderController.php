<?php

namespace App\Controller;

use database\DbConnection as db;
use Megebit\AbstractClass\Controller;

class ProviderController extends Controller
{
    private static $controller;

    public static function get()
    {
        if (self::$controller == null) {
            self::$controller = new ProviderController();
        }
        return self::$controller;
    }

    public function addProvider($provider)
    {
        $sql = "INSERT INTO Providers (Name) VALUES ('$provider')";
        return db::getConnection()->query($sql);
    }

    public function checkProvider($provider)
    {
        $sql = "SELECT * From Providers where Name='$provider'";
        $result = db::getConnection()->query($sql);
        return ($result != NULL) ? TRUE : FALSE;

    }

    public function getProviders()
    {
        $sql = "SELECT * From Providers";
        return db::getConnection()->query($sql);
    }

    public function getProviderId($provider)
    {
        $sql = "SELECT id From Providers where Providers.Name='$provider'";
        $result = db::getConnection()->query($sql);
        return $result[0]['id'];
    }
}