<?php
namespace App\Model;
use database\DbConnection as db;

class Provider extends Model
{

    private $name;

    function __construct($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function save()
    {
        $provider=$this->getName();
        $sql = "INSERT INTO Providers (Name) VALUES ('$provider')";
        db::getConnection()->query($sql);
    }

}
