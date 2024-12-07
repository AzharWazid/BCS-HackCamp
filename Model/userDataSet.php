<?php
require_once __DIR__ . "/../Model/Database.php";
require_once __DIR__ . "/../Model/userData.php";
class userDataSet
{
    protected $dbHandle, $dbInstance;

    public function __construct()
    {
        $this->dbInstance = Database::getInstance();
        $this->dbHandle = $this->dbInstance->getDbConnection();
    }

    // Authenticate for plain text (not needed)
//    public function authenticate($email, $password)
//    {
//        try
//        {
//            $stmt = $this->dbHandle->prepare('SELECT * FROM User WHERE email = :email');
//            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
//            $stmt->execute();
//
//            // Debugging output
//            echo "<pre>";
//            print_r($email);
//            echo "</pre>";
//
//            // Verifies password
//            $userData = new userData($stmt->fetch(PDO::FETCH_ASSOC));
//            if ($password == $userData->getPassword())
//            {
//                return $userData;
//            }
//            else
//            {
//                return false;
//            }
//        }
//        catch (PDOException $e)
//        {
//            echo "Error authenticating user: " . $e->getMessage();
//            return null;
//        }
//    }

    // Add User Data
    public function addUserData($name, $email, $password)
    {
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        $SQL="INSERT into User (name, email, password) VALUES (:name, :email, :password)";
        $stmt = $this->dbHandle->prepare($SQL);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $passwordHash, PDO::PARAM_STR);
        $stmt->execute();
    }

    // User Validation
    public function validateUserData($email, $password)
    {
        $stmt = $this->dbHandle->prepare("SELECT * FROM User WHERE email = :email");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result && password_verify($password, $result['password']))
        {
            //echo "Logged in successfully!";
            return new userData($result);
        }
        else
        {
            //echo "Invalid email or password!";
            return false;
        }
    }

    // Example usage for user validation (Cut and paste this where it's needed)
//    try
//    {
//    // Register a new user
//        addUserData($dbHandle, 'example_name', 'example_password');
//
//    // Validate the user
//        validateUserData($dbHandle, 'example_email', 'example_password');
//    }
//    catch (PDOException $e)
//    {
//        echo "Database error: " . $e->getMessage();
//    }

}