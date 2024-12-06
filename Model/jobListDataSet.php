<?php
require_once ("Model/Database.php");
require_once ("Model/jobListData.php");

class jobListDataSet {

    private $dbHandle, $dbInstance;

    public function __construct() {
        $this->dbInstance = Database::getInstance();
        $this->dbHandle = $this->dbInstance->getDbConnection();
    }

    public function getJobListData($id)
    {
        // Prepare the SQL Query
        $stmt = $this->dbHandle->prepare("SELECT * FROM JobList");
        $stmt->execute();
        // Fetch all rows as array
        $jobList = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $jobList[] = new jobListData($row);
        }
        return $jobList;

    }
}