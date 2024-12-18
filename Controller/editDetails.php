<?php
require_once ("../Model/userDataSet.php");
require_once("../Model/userInfoDataSet.php");
require_once("../Model/studentInfoDataSet.php");

session_start();

$view = new stdClass();
$userId = $_SESSION['id'];
$UserInfoDataSet = new UserInfoDataSet();
$view->userInfoDataSet = $UserInfoDataSet->getUserInfo($userId);
$userDataSet = new UserDataSet();
echo "flag 1";
if ($_SESSION["userType"] == "2") {
    $studentInfoDataSet = new StudentInfoDataSet();
    if ($studentInfoDataSet->validateStudentInfo($view->userInfoDataSet->getId()) >= 1) {
        echo "flag 2";
        $view->studentInfoDataSet = $studentInfoDataSet->getStudentInfo($view->userInfoDataSet->getID());
        echo "flag 3";
    }
    else{
        header("location:registerPage2.php");
    }
}
echo "flag 4";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the values
    $address = trim($_POST['address']);
    $phone = trim($_POST['phone']);
    $dob = trim($_POST['dob']);
    $email = trim($_POST['email']);

    // Update in database
    if($userDataSet->verifyUserEmail($email) || $email == $_SESSION['email']) {
        $userDataSet->updateUserData($userId, $email);
        $UserInfoDataSet->updateUserInfo($address, $phone, $dob, $userId);
        $_SESSION['email'] = $email;
        if(isset($_FILES['cv_file']) && $_FILES['cv_file'] != null) {
            $studentInfoDataSet->updateStudentCV($view->userInfoDataSet->getId(), $_FILES['cv_file']);
        }
        header('Location: account.php');
    }
    else{
        echo 'Email is already in use';
    }
}
else{
    $_POST['address'] = $view->userInfoDataSet->getAddress();
    $_POST['phone'] = $view->userInfoDataSet->getPhoneNumber();
    $_POST['dob'] = $view->userInfoDataSet->getDobYMD();
}

// load current data (can we re use load function?)


//$dbInstance = Database::getInstance();
//$dbHandle = $dbInstance->getDbConnection();
//
//$SQL1 = 'UPDATE "UserInfo" SET "address" = :address, "phoneNumber" = :phone, "dobYMD" = :dob WHERE "userID" = :userId';
//$stmt1 = $dbHandle->prepare($SQL1);
//$stmt1->bindParam(':address', $address);
//$stmt1->bindParam(':phone', $phone);
//$stmt1->bindParam(':dob', $dob);
//$stmt1->bindParam(':userId', $userId);
//$stmt1->execute();
//
//$SQL2 = 'UPDATE "Users" SET "email" = :email WHERE "ID" = :userId';
//$stmt2 = $dbHandle->prepare($SQL2);
//$stmt2->bindParam(':email', $email);
//$stmt2->bindParam(':userId', $userId);
//$stmt2->execute();

require_once ("../View/editDetails.phtml");