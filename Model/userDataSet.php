<?php
require_once __DIR__ . "/../Model/Database.php";

class userDataSet
{
    protected $dbHandle, $dbInstance;

    public function __construct()
    {
        $this->dbInstance = Database::getInstance();
        $this->dbHandle = $this->dbInstance->getDbConnection();
    }

    // Authenticate
    public function authenticate($email, $password)
    {
        try
        {
            $stmt = $this->dbHandle->prepare('SELECT * FROM User WHERE email = :email');
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();

            // Debugging output
            echo "<pre>";
            print_r($email);
            echo "</pre>";

            // Verifies password
            $userData = new userData($stmt->fetch(PDO::FETCH_ASSOC));
            if ($password == $userData->getPassword())
            {
                return $userData;
            }
            else
            {
                return false;
            }
        }
        catch (PDOException $e)
        {
            echo "Error authenticating user: " . $e->getMessage();
            return null;
        }
    }

}