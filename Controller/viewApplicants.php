<?php
require_once('../View/viewApplicants.phtml');
require_once('../Model/studentInfoDataSet.php');
require_once('../Model/Skill.php');



$view = new stdClass();
$studentInfoData = new studentInfoDataSet();
$skill = new Skill();

$view->studentInfoData = $studentInfoData->getStudentInfo();
$view->skill = $skill->skillAssign();
//var_dump($view->skill[1]);

