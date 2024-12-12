<?php
require_once ("../Model/Database.php");
require_once ("../Model/jobListData.php");

class jobListDataSet
{

    protected $dbHandle, $dbInstance;

    public function __construct()
    {
        $this->dbInstance = Database::getInstance();
        $this->dbHandle = $this->dbInstance->getDbConnection();
    }

    public function getJobListData()
    {
        // Prepare the SQL Query
        $stmt = $this->dbHandle->prepare('SELECT * FROM "JobList"');
        $stmt->execute();
        // Fetch all rows as array
        $jobList = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $jobList[] = new jobListData($row);
        }
        return $jobList;

    }


    public function getJobListDataById($id)
    {
        // Prepare the SQL Query
        $stmt = $this->dbHandle->prepare('SELECT * FROM "JobList" WHERE "userID" = :id');
        $stmt->execute(['id' => $id]);
        $stmt->execute();
        // Fetch all rows as array
        $jobList = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $jobList[] = new jobListData($row);
        }
        return $jobList;

    }

    public function addJobList($title, $salary, $startDate, $endDate, $description, $skills, $location, $category, $level, $userID){
        $sql = 'INSERT INTO "JobList" ("title", "salary", "startDate", "endDate", "description", "skills", "location", "category", "level", "userID") 
                VALUES (:title, :salary, :startDate, :endDate, :description, :skills, :location, :category, :level, :userID)';

        $stmt = $this->dbHandle->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':salary', $salary);
        $stmt->bindParam(':startDate', $startDate);
        $stmt->bindParam(':endDate', $endDate);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':skills', $skills);
        $stmt->bindParam(':location', $location);
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':level', $level);
        $stmt->bindParam(':userID', $userID);

        $stmt->execute();
    }
}