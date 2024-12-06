<?php

class userData
{
    protected $ID, $userTypes, $name, $email, $password;
    public function __construct($dbRow)
    {
        $this->ID = $dbRow['ID'];
        $this->userTypes = $dbRow['userTypes'];
        $this->name = $dbRow['name'];
        $this->email = $dbRow['email'];
        $this->password = $dbRow['password'];
    }

    // Getters
    public function getID()
    {
        return $this->ID;
    }
    public function getUserTypes()
    {
        return $this->userTypes;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getPassword(){
        return $this->password;
    }

    // Setters

    public function setID($ID)
    {
        $this->ID = $ID;
    }
    public function setUserTypes($userTypes)
    {
        $this->userTypes = $userTypes;
    }
    public function setName($name)
    {
        $this->name = $name;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function setPassword($password)
    {
        $this->password = $password;
    }

    //


}