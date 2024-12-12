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
        $SQL = 'SELECT * FROM "UserInfo" WHERE "userID" = :id';// Postgres
        $smt = $this->dbHandle->prepare($SQL);
        $smt->bindParam(":id", $id, PDO::PARAM_INT);
        $smt->execute();

        $row = $smt->fetch(PDO::FETCH_ASSOC);

        if ($row){
            return new userInfoData($row);
        }

        return null;
    }

    public function setUserInfo($address, $phoneNumber, $dobYMD, $userID, $additionalInfo)
    {
        $this->resetSequenceIfNecessary();

        if(!isset($additionalInfo)){
            $additionalInfo = null;
        }
        $SQL = 'INSERT INTO "UserInfo" ("address", "phoneNumber", "dobYMD", "userID", "additionalInfo") VALUES (:address, :phoneNumber, :dobYMD, :userID, :additionalInfo)';// Postgres
        $smt = $this->dbHandle->prepare($SQL);
        $smt->bindParam(":address", $address, PDO::PARAM_STR);
        $smt->bindParam(":phoneNumber", $phoneNumber, PDO::PARAM_STR);
        $smt->bindParam(":dobYMD", $dobYMD, PDO::PARAM_STR);
        $smt->bindParam(":userID", $userID, PDO::PARAM_INT);
        $smt->bindParam(":additionalInfo", $additionalInfo, PDO::PARAM_STR);
        $smt->execute();
    }

    private function resetSequenceIfNecessary()
    {
        // Check if the sequence is out of sync with the table
        // Get the current maximum ID value
        $SQL = 'SELECT MAX("id") FROM "UserInfo"';
        $stmt = $this->dbHandle->query($SQL);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Get the max ID
        $maxId = $result['max'];

        // Check if the current sequence value is lower than the max ID value
        $SQL = 'SELECT last_value FROM "UserInfo_id_seq"';
        $stmt = $this->dbHandle->query($SQL);
        $sequence = $stmt->fetch(PDO::FETCH_ASSOC);
        $lastValue = $sequence['last_value'];

        // If the sequence value is less than the max ID, reset the sequence
        if ($lastValue <= $maxId) {
            $SQL = 'SELECT setval(pg_get_serial_sequence(\'"UserInfo"\', \'id\'), :maxId)';
            $stmt = $this->dbHandle->prepare($SQL);
            $stmt->bindParam(':maxId', $maxId, PDO::PARAM_INT);
            $stmt->execute();
        }
    }

    public function updateUserInfo($address, $phoneNumber, $dobYMD, $userID){
        $sql = 'UPDATE "UserInfo" 
            SET "address" = :address, 
                "phoneNumber" = :phoneNumber, 
                "dobYMD" = :dob
            WHERE "userID" = :userID';
        $stmt = $this->dbHandle->prepare($sql);
        $stmt->bindParam(":address", $address, PDO::PARAM_STR);
        $stmt->bindParam(":phoneNumber", $phoneNumber, PDO::PARAM_STR);
        $stmt->bindParam(":dob", $dobYMD, PDO::PARAM_STR);
        $stmt->bindParam(":userID", $userID, PDO::PARAM_INT);
        $stmt->execute();
    }
}
