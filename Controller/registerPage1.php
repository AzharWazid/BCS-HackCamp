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

try {
    // Get database connection
    $database = Database::getInstance();
    $dbHandle = $database->getDbConnection();
    $dbHandle->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $dbHandle->beginTransaction();

    // Insert into User table
    $sqlUser = "INSERT INTO User (name, email, password, userTypes) 
                   VALUES (:username, :email, :password, :userType)";

    $stmt = $dbHandle->prepare($sqlUser);
    $stmt->execute([
        ':username' => $username,
        ':email' => $email,
        ':password' => password_hash($password, PASSWORD_DEFAULT),
        ':userType' => $userTypes === 'student' ? 1 : 2
    ]);

    // Get the last inserted user ID
    $userId = $dbHandle->lastInsertId();

    // Insert into UserInfo table
    $sqlUserInfo = "INSERT INTO UserInfo (phoneNumber, userID) 
                       VALUES (:phone, :userId)";

    $stmt = $dbHandle->prepare($sqlUserInfo);
    $stmt->execute([
        ':phone' => $phone,
        ':userId' => $userId
    ]);

    $dbHandle->commit();
    echo "Registration successful!";

} catch (PDOException $e) {
    if (isset($dbHandle)) {
        $dbHandle->rollBack();
    }
    echo "Registration failed: " . $e->getMessage();

}