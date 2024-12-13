<?php
require_once('../Model/jobListDataSet.php');
require_once('../Model/Skill.php');
if(session_status() == PHP_SESSION_NONE){
    session_start();
}

$view = new stdClass();
$jobListData = new jobListDataSet();
$skill = new Skill();
// Fetch Data for logged in user
//var_dump($_POST['job-id']);
if(!isset($_SESSION['id']))
{
    $_SESSION['id'] = null;
}
$view->jobListData = $jobListData->getJobListDataById($_POST['job-id']);
//var_dump($view->jobListData);
$view->skill = $skill->skillAssign();
//var_dump($view->skill[1]);

// Check user type to control data visibility
if (isset($_SESSION['userType']) && $_SESSION['userType'] == '2')
{
    $view->jobListDataSet = $jobListData->getJobListDataById($_POST['job-id']);
}
elseif (isset($_SESSION['userType']) && ($_SESSION['userType'] == '1'|| $_SESSION['userType'] == '3'))
{
        $view->jobListDataSet = $jobListData->getJobListDataById($_POST['job-id']);
}

require_once('../View/placementInfo.phtml');
