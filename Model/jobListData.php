<?php
class jobListData
{
    protected $dbHandle, $dbInstance;
    protected $UniqueID, $title, $description, $skills, $salary, $location, $startDate, $endDate, $category, $level, $userID;

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


    // Getters

    public function getUniqueID()
    {
        return $this->UniqueID;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getSkills()
    {
        return $this->skills;
    }

    public function getSalary()
    {
        return $this->salary;
    }

    public function getLocation()
    {
        return $this->location;
    }

    public function getStartDate()
    {
        return $this->startDate;
    }

    public function getEndDate()
    {
        return $this->endDate;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function getLevel()
    {
        return $this->level;
    }

    public function getUserID()
    {
        return $this->userID;
    }

    // Using the class
//    $jobs = $yourClassInstance->getJobListData($userID);
//
//    foreach ($jobs as $job)
//    {
//        echo "Title: " . $job->getTitle() . "\n";
//        echo "Description: " . $job->getDescription() . "\n";
//        echo "Skills: " . $job->getSkills() . "\n";
//        echo "Salary: " . $job->getSalary() . "\n";
//        echo "Location: " . $job->getLocation() . "\n";
//        echo "Start Date: " . $job->getStartDate() . "\n";
//        echo "End Date: " . $job->getEndDate() . "\n";
//        echo "Category: " . $job->getCategory() . "\n";
//        echo "Level: " . $job->getLevel() . "\n";
//    }
}