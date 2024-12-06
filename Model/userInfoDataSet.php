<?php
require_once ('Model/Database.php');
require_once ('Model/userInfoData.php');

class userInfoDataSet{
    protected $dbHandle, $dbInstance;

    public function __construct(){
        $this->dbInstance = Database::getInstance();
        $this->dbHandle = $this->dbInstance->getDbConnection();
    }

    public function getUserInfo($id){
        $SQL = "SELECT * FROM UserInfo WHERE id = :id";
        $smt = $this->dbHandle->query($SQL);
        $smt->bindParam(":id", $id, PDO::PARAM_INT);
        $smt->execute();

        $row = $smt->fetch(PDO::FETCH_ASSOC);

        if ($row){
            return new userInfoData($row);
        }

        return null;
    }

    public function setStudentInfo($id, $address, $phoneNumber, $CV, $userID, $additionallInfo)
    {
        $SQL = "INSERT INTO UserInfo (id, address, phoneNumber, CV, userID, additionallInfo)
        VALUES (:id, :address, :phoneNumber, :CV, :userID, :additionallInfo)
        ON DUPLICATE KEY UPDATE
        address = :address
        phoneNumber = :phoneNumber
        CV = :CV
        userID = :userID
        additionallInfo = :additionallInfo";

        $smt = $this->dbHandle->prepare($SQL);
        $smt->bindParam(":id", $id, PDO::PARAM_INT);
        $smt->bindParam(":address", $address, PDO::PARAM_STR);
        $smt->bindParam(":phoneNumber", $phoneNumber, PDO::PARAM_STR);
        $smt->bindParam(":CV", $CV, PDO::PARAM_STR);
        $smt->bindParam(":userID", $userID, PDO::PARAM_INT);
        $smt->bindParam(":additionallInfo", $additionallInfo, PDO::PARAM_STR);

        return $smt->execute();

    }
}
