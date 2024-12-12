<?php

require_once("../Model/userInfoDataSet.php");
require_once("../Model/studentInfoDataSet.php");

session_start();

$view = new stdClass();
$UserInfoDataSet = new UserInfoDataSet();
$view->userInfoDataSet = $UserInfoDataSet->getUserInfo($_SESSION["id"]);

if ($_SESSION["userType"] == "3")
{
    $jobListDataSet = new JobListDataSet();
    if ($jobListDataSet->getJobListData($view->userInfoDataSet->getID()) >= 1){
        $view->jobListDataSet = $jobListDataSet->getJobListData($view->userInfoDataSet->getID());

    }
}

require_once ("../View/myListings.phtml");