<?php
// Include the login view (HTML form)
require("../View/login.phtml");

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve email and password from POST data, or set defaults
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $remember_me = isset($_POST['remember_me']);

    // Example validation (you can replace this with your actual logic)
    if (!empty($email) && !empty($password)) {
        // Placeholder: Check credentials
        if ($email === 'test@example.com' && $password === 'password123') {
            echo "Login successful!";
        } else {
            echo "Invalid credentials!";
        }
    } else {
        echo "Please fill in all fields!";
    }
}

?>