<?php
class Level
{
    protected $dbHandle, $dbInstance;
    public function __construct()
    {
        $this->dbInstance = Database::getInstance();
        $this->dbHandle = $this->dbInstance->getDbConnection();
    }

    public function levelAssign()
    {
        // Query to fetch all skills
        $query = 'SELECT "UniqueID" FROM "Level"';
        $stmt = $this->dbHandle->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $result2 = $result["UniqueID"];
        //var_dump($skills);
        if($result2 == 1){
            var_dump($result2);
        }
        var_dump($result);

        return $result;

    }
}