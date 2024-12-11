<?php
require_once("../Model/userInfoDataSet.php");
require_once("../Model/studentInfoDataSet.php");

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userInfoDataSet = new userInfoDataSet();

    // Get the values
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $dob = $_POST['dob'];
    $email = $_POST['email'];
    $userId = $_SESSION['id'];

    // Update in database
    $dbInstance = Database::getInstance();
    $dbHandle = $dbInstance->getDbConnection();

    $SQL1 = "UPDATE UserInfo SET address = :address, phoneNumber = :phone, dobYMD = :dob WHERE userID = :userId";
    $stmt1 = $dbHandle->prepare($SQL1);
    $stmt1->bindParam(':address', $address);
    $stmt1->bindParam(':phone', $phone);
    $stmt1->bindParam(':dob', $dob);
    $stmt1->bindParam(':userId', $userId);
    $stmt1->execute();

    $SQL2 = "UPDATE User SET email = :email WHERE ID = :userId";
    $stmt2 = $dbHandle->prepare($SQL2);
    $stmt2->bindParam(':email', $email);
    $stmt2->bindParam(':userId', $userId);
    $stmt2->execute();
}

// load current data (can we re use load function?)
$view = new stdClass();
$UserInfoDataSet = new UserInfoDataSet();
$view->userInfoDataSet = $UserInfoDataSet->getUserInfo($_SESSION["id"]);

if ($_SESSION["userType"] == "2") {
    $studentInfoDataSet = new StudentInfoDataSet();
    if ($studentInfoDataSet->validateStudentInfo($view->userInfoDataSet->getId()) >= 1) {
        $view->studentInfoDataSet = $studentInfoDataSet->getStudentInfo($view->userInfoDataSet->getID());
    }
}

require_once ("../View/editDetails.phtml");