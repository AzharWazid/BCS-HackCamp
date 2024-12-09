<?php
// Include the login view (HTML form)
require("../View/registerPage1.phtml");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];
    $phone = $_POST['phone'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $userTypes = isset($_POST['user_type']) ? $_POST['user_type'] : [];

    var_dump($dob);
    var_dump($_POST);

    // Process the data (e.g., validation, saving to the database)
    // Example:
    // echo "User Registered: $firstName $lastName with email $email";
}