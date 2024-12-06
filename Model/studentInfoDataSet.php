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
        $validFileExtensions = ['pdf'];
        if(!in_array($cv["type"], $validFileExtensions)){
            return 'type error';
        }

        //path to user folder
        $uploadDir = 'uploads/user_' . $userId;
        //checks if user folder exists
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }


    }
}