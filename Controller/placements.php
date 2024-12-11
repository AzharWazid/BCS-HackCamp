<?php

require_once("../Model/jobListDataSet.php");
require_once("../Model/Skill.php");


session_start();

//// Redirect if the user is not logged in
///if (!isset($_SESSION['id']))
//{
//    header("location: login.php");
//    exit;
//}

$view = new stdClass();
$jobListData = new jobListDataSet();
$skill = new Skill();
// Fetch Data for logged in user
$view->jobListData = $jobListData->getJobListData($_SESSION['id']);
$view->skill = $skill->skillAssign();
//var_dump($view->skill[1]);

// Check user type to control data visibility
if ($_SESSION['userType'] == "2")
{
    $jobListData = new jobListDataSet();
    $view->jobListDataSet = $jobListData->getJobListData($_SESSION['id']);

}
elseif ($_SESSION['userType'] == "1" || $_SESSION['userType'] == "3")
{
    $view->jobListDataSet = $jobListData;
}
// Include the login view (HTML form)
require("../View/placements.phtml");