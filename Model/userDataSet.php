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

    // authenticate
    public function authenticate($email, $password)
    {
        try
        {
            $stmt = $this->dbHandle->prepare('SELECT * FROM User WHERE email = :email');
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Debugging output
            echo "<pre>";
            print_r($email);
            echo "</pre>";

            return $user && ($password === $user['password']) ? $user : null;
        }
        catch (PDOException $e)
        {
            echo "Error authenticating user: " . $e->getMessage();
            return null;
        }
    }

}