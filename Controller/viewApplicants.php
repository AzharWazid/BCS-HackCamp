<?php
require_once('../View/viewApplicants.phtml');

session_start();

$view = new stdClass();
$studentInfoData = new studentInfoDataSet();
$skill = new Skill();

$view->studentInfoData = $studentInfoData->getStudentInfo();
$view->