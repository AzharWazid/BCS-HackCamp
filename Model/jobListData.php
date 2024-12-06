<?php
class jobListData
{
    protected $dbHandle, $dbInstance, $UniqueID, $title, $description, $skills, $salary, $location, $startDate, $endDate, $category, $level, $userID;

    public function __construct($dbRow)
    {
        $this->UniqueID = $dbRow['UniqueID'];
        $this->title = $dbRow['title'];
        $this->description = $dbRow['description'];
        $this->skills = $dbRow['skills'];
        $this->salary = $dbRow['salary'];
        $this->location = $dbRow['location'];
        $this->startDate = $dbRow['startDate'];
        $this->endDate = $dbRow['endDate'];
        $this->category = $dbRow['category'];
        $this->level = $dbRow['level'];
        $this->userID = $dbRow['userID'];
    }
}
    // Example usage of getters

