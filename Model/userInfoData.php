<?php

class userInfoData{
    protected $_id, $_address, $_phoneNumber, $_userID, $_additionalInfo, $_dobYMD;

    public function __construct($dbRow){
        $this->_id = $dbRow['id'];
        $this->_address = $dbRow['address'];
        $this->_phoneNumber = $dbRow['phoneNumber'];
        $this->_dobYMD = $dbRow['dobYMD'];
        $this->_userID = $dbRow['userID'];
        $this->_additionalInfo = $dbRow['additionalInfo'];
    }

    public function getId(){
    return $this->_id;
    }
    public function getAddress(){
    return $this->_address;
    }
    public function getPhoneNumber(){
        return $this->_phoneNumber;
    }
    public function getDobYMD(){
        return $this->_dobYMD;
    }
    public function getUserID(){
    return $this->_userID;
    }
    public function getAdditionalInfo(){
    return $this->_additionalInfo;
    }

    public function setId($id){
        $this->_id = $id;
    }
    public function setAddress($address){
        $this->_address = $address;
    }
    public function setPhoneNumber($phoneNumber){
        $this->_phoneNumber = $phoneNumber;
    }
    public function setUserID($userID){
        $this->_userID = $userID;
    }
    public function setAdditionalInfo($additionalInfo){
        $this->_additionalInfo = $additionalInfo;
    }
}

