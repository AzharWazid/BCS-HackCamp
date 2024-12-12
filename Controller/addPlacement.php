<?php
require_once ('../Model/jobListDataSet.php');

$jobListDataSet = new JobListDataSet();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate input data
    $title = htmlspecialchars(trim($_POST['placementName'])); // Maps to 'title'
    $salary = filter_var($_POST['salary'], FILTER_VALIDATE_INT); // Maps to 'salary'
    $startDate = $_POST['startDate']; // Maps to 'startDate'
    $endDate = $_POST['endDate']; // Maps to 'endDate'
    $description = htmlspecialchars(trim($_POST['description'])); // Maps to 'description'
    $skills = htmlspecialchars(trim($_POST['skillsNeeded'])); // Maps to 'skills'
    $location = "Default Location"; // Example, should come from form or default value
    $category = 1; // Example, should come from form or default value
    $level = 1; // Example, should come from form or default value
    $userID = 1; // Example, should come from session or context

    $jobListDataSet->addJobList($title, $salary, $startDate, $endDate, $description, $skills, $location, $category, $level, $userID);
    header('Location: ../placement.php');

}



require_once ('../View/addPlacement.phtml');