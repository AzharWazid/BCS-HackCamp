<?php
require_once ('../Model/Database.php');
require_once ('../Model/studentInfoDataSet.php');

class studentInfoDataSet{
    protected $dbHandle, $dbInstance;

    public function __construct(){
        $this->dbInstance = Database::getInstance();
        $this->dbHandle = $this->dbInstance->getDbConnection();
    }

    public function storeStudentCV($userId, $cv){
        //checks for errors
        if($cv['error'] != UPLOAD_ERR_OK){
            echo 'upload error';
            return false;
        }

        //ensures the file type is pdf
        $validFileExtensions = ['application/pdf'];
        if(!in_array($cv["type"], $validFileExtensions)){
            echo 'type error';
            return false;
        }

        //path to user folder
        $uploadDir = 'CV Uploads/user_' . $userId;
        //checks if user folder exists
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $fileName = uniqid('cv_') . '.pdf';
        $filePath = $uploadDir . '/' . $fileName;

        if(move_uploaded_file($cv['tmp_name'], $filePath)){
            return $filePath;
        }
        else{
            echo 'dir upload error';
            return false;
        }
    }

    public function getStudentInfo($id){
        $sql = "SELECT * FROM StudentInfo WHERE id = :id";
        $stmt = $this->dbHandle->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return new studentInfoData($stmt->fetch(PDO::FETCH_ASSOC));
    }

    public function addStudentInfo($userInfoId, $cv, $skills, $category, $level){
        if($cv == null || $cv == ''){
            $cvPath = null;
        }
        elseif(!$this->storeStudentCV($userInfoId, $cv)){
            $cvPath = $this->storeStudentCV($userInfoId, $cv);
        }

        $sql = "INSERT INTO StudentInfo (userInfo, CV, skills, category, level) VALUES (:userInfoId, :cv, :skills, :category, :level)";
        $stmt = $this->dbHandle->prepare($sql);
        $stmt->bindParam(':userInfoId', $userInfoId);
        $stmt->bindParam(':cv', $cvPath);
        $stmt->bindParam(':skills', $skills);
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':level', $level);
        $stmt->execute();
    }

    public function validateStudentInfo($id){
        $sql = "SELECT COUNT(*) FROM StudentInfo WHERE userInfo = :id";
        $stmt = $this->dbHandle->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['COUNT(*)'];
    }
}