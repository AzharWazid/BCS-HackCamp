<?php
require_once ('Model/Database.php');
require_once ('Model/userInfoDataSet.php');

class userInfoDataSet{
    protected $dbHandle, $dbInstance;

    public function __construct(){
        $this->dbInstance = Database::getInstance();
        $this->dbHandle = $this->dbInstance->getDbConnection();
    }
}
