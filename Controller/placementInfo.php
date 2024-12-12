<?php require_once('../View/placementInfo.phtml');

session_start();

$view = new stdClass();
$jobListData = new jobListDataSet();
$skill = new Skill();
// Fetch Data for logged in user
if(!isset($_SESSION['id']))
{
    $_SESSION['id'] = null;
}
$view->jobListData = $jobListData->getJobListData($_SESSION['id']);
$view->skill = $skill->skillAssign();
//var_dump($view->skill[1]);

// Check user type to control data visibility
if (isset($_SESSION['userType']) && $_SESSION['userType'] == '2')
{
    $jobListData = new jobListDataSet();
    $view->jobListDataSet = $jobListData->getJobListData($_SESSION['id']);
}
elseif (isset($_SESSION['userType']) && ($_SESSION['userType'] == '1'|| $_SESSION['userType'] == '3'))
{
        $view->jobListDataSet = $jobListData;
}