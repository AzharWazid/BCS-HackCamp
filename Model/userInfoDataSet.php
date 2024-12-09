<?php
require_once __DIR__ . "/../Model/Database.php";
require_once ('../Model/userInfoData.php');

class userInfoDataSet{
    protected $dbHandle, $dbInstance;

    public function __construct(){
        $this->dbInstance = Database::getInstance();
        $this->dbHandle = $this->dbInstance->getDbConnection();
    }

    public function getUserInfo($id){
        $SQL = "SELECT * FROM UserInfo WHERE userID = :id";
        $smt = $this->dbHandle->query($SQL);
        $smt->bindParam(":id", $id, PDO::PARAM_INT);
        $smt->execute();

        $row = $smt->fetch(PDO::FETCH_ASSOC);

        if ($row){
            return new userInfoData($row);
        }

        return null;
    }

    public function setStudentInfo($address, $phoneNumber, $CV, $userID, $additionalInfo)
    {
        $SQL = "INSERT INTO UserInfo (address, phoneNumber, CV, userID, additionalInfo)
        VALUES (:address, :phoneNumber, :CV, :userID, :additionalInfo)
        ON DUPLICATE KEY UPDATE
        address = :address
        phoneNumber = :phoneNumber
        CV = :CV
        userID = :userID
        additionalInfo = :additionalInfo";

        $smt = $this->dbHandle->prepare($SQL);
        $smt->bindParam(":id", $id, PDO::PARAM_INT);
        $smt->bindParam(":address", $address, PDO::PARAM_STR);
        $smt->bindParam(":phoneNumber", $phoneNumber, PDO::PARAM_STR);
        $smt->bindParam(":CV", $CV, PDO::PARAM_STR);
        $smt->bindParam(":userID", $userID, PDO::PARAM_INT);
        $smt->bindParam(":additionalInfo", $additionalInfo, PDO::PARAM_STR);

        return $smt->execute();

    }
}
