<?php
require_once __DIR__ . "/../Model/Database.php";

class userDataSet
{
    protected $dbHandle;
    protected static $dbInstance;

    public function __construct()
    {
        $this->dbInstance = Database::getInstance();
        $this->dbHandle = $this->dbInstance->getDbConnection();
    }

    // authenticate
    public function authenticate($username, $password)
    {
        try
        {
            $stmt = $this->db->getConnection()->prepare('SELECT * FROM User WHERE username = :username');
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Debugging output
            echo "<pre>";
            print_r($user);
            echo "</pre>";

            return $user && ($password === $user['password']) ? $user : null;
        }
        catch (PDOException $e)
        {
            echo "Error authenticating user: " . $e->getMessage();
            return null;
        }
    }

    // Function to get all users
    public function getAllUsers()
    {
        $stmt = $this->db->query("SELECT * FROM User");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}