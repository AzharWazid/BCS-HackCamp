<?php
class studentInfoData{
    protected $_id, $_userInfoId, $_CV, $_skills, $_category, $_level;

    public function __construct($dbRow){
        var_dump($dbRow);
        $this->_id = $dbRow['UniqueID'];
        $this->_userInfoId = $dbRow['userInfo'];
        $this->_CV = $dbRow['CV'];
        $this->_skills = $dbRow['skills'];
        $this->_category = $dbRow['category'];
        $this->_level = $dbRow['level'];
    }

    public function getId(){
        return $this->_id;
    }
    public function getUserInfoId(){
        return $this->_userInfoId;
    }
    public function getCV(){
        return $this->_CV;
    }
    public function getSkills(){
        return $this->_skills;
    }
    public function getCategory(){
        return $this->_category;
    }
    public function getLevel(){
        return $this->_level;
    }
}