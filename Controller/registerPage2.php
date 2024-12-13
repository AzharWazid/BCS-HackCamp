<?php
require_once ("../Model/studentInfoDataSet.php");

$view = new stdclass();
$studentInfoData = new studentInfoDataSet();

if($_SERVER['REQUEST_METHOD'] == 'POST'){

}
require_once("../View/registerPage2.phtml");