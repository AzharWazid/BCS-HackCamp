<?php
require_once ("../Model/userDataSet.php");


$view = new stdClass();
$view->errorMessage = "";
$userDataSet = new userDataSet();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve email and password from POST data, or set defaults
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $remember_me = isset($_POST['remember_me']);

    // Validates the user inputs
    $view->userDataSet = $userDataSet->validateUserData($email, $password);
    if (!$view->userDataSet) {
        $view->errorMessage = "Invalid email or password";
    }

    else{
        session_start();

        $_SESSION["id"] = $view->userDataSet->getID();
        $_SESSION["userType"] = $view->userDataSet->getUserTypes();
        $_SESSION["name"] = $view->userDataSet->getName();
        $_SESSION["email"] = $view->userDataSet->getEmail();

        header("Location:../index.php");
    }

}

// Include the login view (HTML form)
require("../View/login.phtml");