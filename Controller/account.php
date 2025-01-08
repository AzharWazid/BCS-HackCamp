<?php
require_once ("../Model/userInfoDataSet.php");
require_once("../Model/studentInfoDataSet.php");

session_start();

$view = new stdClass();
$UserInfoDataSet = new UserInfoDataSet();
$view->userInfoDataSet=$UserInfoDataSet->getUserInfo($_SESSION["id"]);
echo "flag 1";
if ($_SESSION["userType"] == "2")
{
    $studentInfoDataSet = new StudentInfoDataSet();
    echo "flag 3";
    if ($studentInfoDataSet->validateStudentInfo($view->userInfoDataSet->getId()) >= 1){
        //var_dump($view->userInfoDataSet);
        $view->studentInfoDataSet = $studentInfoDataSet->getStudentInfo($view->userInfoDataSet->getID());
        $view->studentCV = $studentInfoDataSet->getStudentCV($view->userInfoDataSet->getID());
    }
}
echo "flag 2";
require_once ("../View/account.phtml");


