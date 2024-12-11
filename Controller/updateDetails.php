<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve updated details from the form
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $address = trim($_POST['address']);
    $phone = trim($_POST['phone']);
    $dob = trim($_POST['dob']);

    // Ensure database connection exists
    if (!isset($db)) {
        die("Database connection not initialized.");
    }

    // Update the user's details in the database
    $userId = isset($_SESSION['userID']) ? $_SESSION['userID'] : 0; // Assuming userID is stored in the session
    if ($userId) {
        $query = "UPDATE users SET name = ?, email = ?, address = ?, phone = ?, dob = ? WHERE id = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$name, $email, $address, $phone, $dob, $userId]);

        // Update session values
        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;

        // Redirect back to the account page
        header('Location: /View/account.phtml');
        exit;
    } else {
        echo "User ID not found in session.";
    }
}

require_once ("../View/editDetails.phtml");