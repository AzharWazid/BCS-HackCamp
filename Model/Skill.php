<?php

class Skill
{
    protected $dbHandle, $dbInstance;
    protected $skillName;

    public function __construct($dbRow)
    {
        $this->dbInstance = Database::getInstance();
        $this->dbHandle = $this->dbInstance->getDbConnection();
        $this->skillName = $dbRow['skillName'];
    }

    public function skillAssign()
    {
        // Query to fetch all skills
        $query = "SELECT id, title FROM Skill";
        $stmt = $this->dbHandle->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Create the associative array
        $skills = [];
        foreach ($result as $row)
        {
            $skills[$row['id']] = $row['title'];
        }

    }
}

?>
