<?php

class Skill
{
    protected $dbHandle, $dbInstance;
    public function __construct()
    {
        $this->dbInstance = Database::getInstance();
        $this->dbHandle = $this->dbInstance->getDbConnection();
    }

    public function skillAssign()
    {
        // Query to fetch all skills
        $query = 'SELECT * FROM "Skill"';
        $stmt = $this->dbHandle->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Create the associative array
        $skills = [];
        foreach ($result as $row)
        {
            $skills[$row['id']] = $row['skillName'];
        }
        //var_dump($skills);
        return $skills;

    }
}

?>
