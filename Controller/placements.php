<?php

require_once("../Model/jobListDataSet.php");

session_start();

$view = new stdClass();
$jobListData = new jobListDataSet();
$view->jobListData = $jobListData->getJobListData($_SESSION['id']);

if ($_SESSION['userType'] == "2")
{
    $jobListDataSet = new jobListDataSet();
    $view->jobListDataSet = $jobListDataSet->getJobListData($view->jobListDataSet->getJobListData());
}
elseif ($_SESSION['userType'] == "3")
{
    // Employer view of placements
}
elseif ($_SESSION['userType'] == "1")
{
    // Admin view of placements
}


// Include the login view (HTML form)
require("../View/placements.phtml");