<?php

namespace App\Model;

use Megebit\AbstractClass\Model;
use database\DbConnection as db;


class Email extends Model
{

    private $Email;
    private $providerId;
    private $created;

    function __construct($Email, $providerId)
    {
        $this->Email = $Email;
        $this->providerId = $providerId;
        $this->created = date('Y-m-d');
    }

    public static function delete($emailId)
    {
        $sql = "DELETE FROM Emails WHERE id='$emailId'";
        db::getConnection()->query($sql);
    }

    public function setProiderid($providerId)
    {
        $this->providerId = $providerId;
    }

    public function getEmail()
    {
        return $this->Email;
    }

    public function setEmail($Email)
    {
        $this->Email = $Email;
    }

    public function getProiderid()
    {
        return $this->providerId;
    }

    public function getCreated()
    {
        return $this->created;
    }

    public function setCreated()
    {
        $this->created = date('Y-m-d');
    }

    public function save()
    {
        $email = $this->getEmail();
        $provider = $this->getProiderid();
        $created = $this->getCreated();
        $sql = "INSERT INTO Emails (Email,providerID,Created) VALUES ('$email', '$provider', '$created')";
      return  db::getConnection()->query($sql);

    }

}

?>