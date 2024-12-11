<?php

require_once("../Model/jobListDataSet.php");

session_start();

//// Redirect if the user is not logged in
///if (!isset($_SESSION['id']))
//{
//    header("location: login.php");
//    exit;
//}x

$view = new stdClass();
$jobListData = new jobListDataSet();
// Fetch Data for logged in user
$view->jobListData = $jobListData->getJobListData($_SESSION['id']);



// Check user type to control data visibility
if ($_SESSION['userType'] == "2")
{
    $jobListDataSet = new jobListDataSet();
    $view->jobListDataSet = $jobListDataSet->getJobListData($_SESSION['id']);
}
elseif ($_SESSION['userType'] == "1" || $_SESSION['userType'] == "3")
{
    $view->jobListDataSet = $jobListData;
}

// Include the login view (HTML form)
require("../View/placements.phtml");