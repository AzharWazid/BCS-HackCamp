<?php
require_once ("../Model/userDataSet.php");
require_once ("../Model/userInfoDataSet.php");

session_start();

$view = new stdClass();
$userData = new userDataSet();
$userInfoData = new userInfoDataSet();

// Include the login view (HTML form)
if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $name = $_POST['first_name'] . " " . $_POST['last_name'];
    $email = $_POST['email'];
    $dobYMD = $_POST['dob'];
    $phoneNumber = $_POST['phone'];
    $password = $_POST['password'];
    $address = $_POST['address'];
    $userTypes = isset($_POST['user_type']) ? $_POST['user_type'] : [];

    //var_dump($email);
    //var_dump($address);

    if($userData->verifyUserEmail($email))
    {
        $userData->addUserData($name, $email, $password, $userTypes);
        $userID = $userData->getUserIdByEmail($email);
        $userInfoData->setUserInfo($address, $phoneNumber, $dobYMD, $userID, null);
        $_SESSION['id'] = $userID;

        if($userTypes == "student")
        {
//            $_SESSION['id'] = $userID;
//            var_dump($_SESSION);
            header("location: registerPage2.php");
        }
        else{
//            $_SESSION['id'] = $userID;
//            var_dump($_SESSION);

            header("location: ../index.php");
        }
    }
    else
    {
        echo "Email is already in use";
    }
}

require("../View/registerPage1.phtml");

//try {
//    // Get database connection
//    $database = Database::getInstance();
//    $dbHandle = $database->getDbConnection();
//    $dbHandle->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//
//    $dbHandle->beginTransaction();
//
//    // Insert into User table
//    $sqlUser = "INSERT INTO User (name, email, password, userTypes)
//                   VALUES (:username, :email, :password, :userType)";
//
//    $stmt = $dbHandle->prepare($sqlUser);
//    $stmt->execute([
//        ':username' => $username,
//        ':email' => $email,
//        ':password' => password_hash($password, PASSWORD_DEFAULT),
//        ':userType' => $userTypes === 'student' ? 1 : 2
//    ]);
//
//    // Get the last inserted user ID
//    $userId = $dbHandle->lastInsertId();
//
//    // Insert into UserInfo table
//    $sqlUserInfo = "INSERT INTO UserInfo (phoneNumber, userID)
//                       VALUES (:phone, :userId)";
//
//    $stmt = $dbHandle->prepare($sqlUserInfo);
//    $stmt->execute([
//        ':phone' => $phone,
//        ':userId' => $userId
//    ]);
//
//    $dbHandle->commit();
//    echo "Registration successful!";
//
//} catch (PDOException $e) {
//    if (isset($dbHandle)) {
//        $dbHandle->rollBack();
//    }
//    echo "Registration failed: " . $e->getMessage();
//
//}