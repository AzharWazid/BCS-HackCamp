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

    $SQL = "UPDATE UserInfo SET address = :address, phoneNumber = :phone, dobYMD = :dob WHERE userID = :userId";
    $stmt = $dbHandle->prepare($SQL);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':dob', $dob);
    $stmt->bindParam(':userId', $userId);

    $SQL = "UPDATE User SET email = :email WHERE userId = :ID";
    $stmt = $dbHandle->prepare($SQL);
    $stmt->bindParam(':email', $email);

    $stmt->execute();
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