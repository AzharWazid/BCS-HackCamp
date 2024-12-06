<?php
require_once ('Model/Database.php');
require_once ('Model/studentInfoDataSet.php');

class studentInfoDataSet{
    protected $dbHandle, $dbInstance;

    public function __construct(){
        $this->dbInstance = Database::getInstance();
        $this->dbHandle = $this->dbInstance->getDbConnection();
    }

    public function storeStudentCV($userId, $cv){
        //checks for errors
        if($cv['error'] != UPLOAD_ERR_OK){
            return 'upload error';
        }

        //ensures the file type is pdf
        $validFileExtensions = ['application/pdf'];
        if(!in_array($cv["type"], $validFileExtensions)){
            return 'type error';
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
            return 'dir upload error';
        }
    }

    public function getStudentInfo($id){
        $sql = "SELECT * FROM student_info WHERE id = :id";
        $stmt = $this->dbHandle->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return new studentInfoData($stmt->fetch(PDO::FETCH_ASSOC));
    }

    public function addStudentInfo($cv, $skills, $category, $level){

    }
}