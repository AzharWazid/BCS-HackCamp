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
    public function addUserData($name, $email, $password, $userType)
    {
        $this->resetSequenceIfNecessary();
        if ($userType == "student"){
            $userType = 2;
        }
        elseif ($userType == "employer"){
            $userType = 3;
        }
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        $SQL='INSERT INTO "Users" (name, email, password, "userTypes") VALUES (:name, :email, :password, :userTypes)';
        $stmt = $this->dbHandle->prepare($SQL);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $passwordHash);
        $stmt->bindParam(':userTypes', $userType);

        $stmt->execute();
    }

    // User Validation
    public function validateUserData($email, $password)
    {
        $stmt = $this->dbHandle->prepare("SELECT * FROM \"Users\" WHERE email = :email");// Postgres
        $stmt->bindParam(':email', $email);
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

    // Check if email is taken
    public function verifyUserEmail($email){
        $stmt = $this->dbHandle->prepare("SELECT COUNT(*) FROM \"Users\" WHERE email = :email");// Postgres
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        //var_dump($result);

        if ($result["count"] <= 0){
            var_dump($result);
            return true;
        }
        else{
            var_dump($result);
            return false;
        }
    }

    // Gets user ID via Email
    public function getUserIdByEmail($email)
    {
        $stmt = $this->dbHandle->prepare('SELECT "ID" FROM "Users" WHERE email = :email');// Postgres
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result["ID"];
    }

    private function resetSequenceIfNecessary()
    {
        // Check if the sequence is out of sync with the table
        // Get the current maximum ID value
        $SQL = 'SELECT MAX("ID") FROM "Users"';
        $stmt = $this->dbHandle->query($SQL);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Get the max ID
        $maxId = $result['max'];

        // Check if the current sequence value is lower than the max ID value
        $SQL = 'SELECT last_value FROM "Users_ID_seq"';
        $stmt = $this->dbHandle->query($SQL);
        $sequence = $stmt->fetch(PDO::FETCH_ASSOC);
        $lastValue = $sequence['last_value'];

        // If the sequence value is less than the max ID, reset the sequence
        if ($lastValue <= $maxId) {
            $SQL = 'SELECT setval(pg_get_serial_sequence(\'"Users"\', \'ID\'), :maxId)';
            $stmt = $this->dbHandle->prepare($SQL);
            $stmt->bindParam(':maxId', $maxId, PDO::PARAM_INT);
            $stmt->execute();
        }
    }

    public function updateUserData($id, $email){
        $sql = "UPDATE \"Users\" SET \"email\" = :email WHERE \"ID\" = :id";
        $stmt = $this->dbHandle->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
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