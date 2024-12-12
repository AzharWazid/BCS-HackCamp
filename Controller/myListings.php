<?php

require_once("../Model/userInfoDataSet.php");
require_once("../Model/studentInfoDataSet.php");
require_once("../Model/jobListDataSet.php");
require_once("../Model/userDataSet.php");
require_once("../Model/Skill.php");


session_start();

$view = new stdClass();
$skill = new Skill();
$UserInfoDataSet = new UserInfoDataSet();
$view->userInfoDataSet = $UserInfoDataSet->getUserInfo($_SESSION["id"]);
$view->skill = $skill->skillAssign();
if ($_SESSION["userType"] == "3")
{
    $jobListDataSet = new JobListDataSet();
    if ($jobListDataSet->getJobListDataById($_SESSION['id']) >= 1){
        $view->jobListDataSet = $jobListDataSet->getJobListDataById($_SESSION['id']);
        //var_dump($jobListDataSet->getJobListDataById($_SESSION['id']));
    }
}

$user_id = $_SESSION['id'];

require_once ("../View/myListings.phtml");