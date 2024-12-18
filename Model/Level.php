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
        //$result2 = $result[0];
        //var_dump($skills);
        //var_dump($result2["UniqueID"]);
//        if($result2["UniqueID"] == 1){
//            echo "Works ";
//            //var_dump($result[1]);
//        }

        //var_dump($result[0]);
        //$result2 = $result[1];
        //var_dump($result2["UniqueID"]);
        $levelArr = [];
        for ($i = 0; $i < count($result); $i++) {
            $result2 = $result[$i];
            if (!in_array($result2["UniqueID"], $levelArr)) {
                $levelArr[] = $result2["UniqueID"];
            }
        }
        //var_dump($levelArr);
        return $levelArr;
    }
}