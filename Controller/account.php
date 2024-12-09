<?php

require_once __DIR__ . '/../Model/userInfoDataSet.php';


$view = new stdClass();
$UserInfoDataSet = new UserInfoDataSet();
$view->userInfoDataSet=$UserInfoDataSet->getUserInfo($_SESSION["id"]);

if ($_SESSION["userType"] == "2")
{
    $studentInfoDataSet = new StudentInfoDataSet();
    $view->studentInfoDataSet=$studentInfoDataSet->getStudentInfo($view->userInfoDataSet->getID());

}

require_once ("../View/account.phtml");