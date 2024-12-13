<?php
require_once ('../Model/jobListDataSet.php');

session_start();

$jobListDataSet = new JobListDataSet();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate input data
    $title = trim($_POST['placementName']); // Maps to 'title'
   // $company = htmlspecialchars(trim($_POST['company']));
    $salary = filter_var($_POST['salary'], FILTER_VALIDATE_INT); // Maps to 'salary'
    $startDate = $_POST['startDate']; // Maps to 'startDate'
    $endDate = $_POST['endDate']; // Maps to 'endDate'
    $description = trim($_POST['description']); // Maps to 'description'
    $skills = $_POST['skills']; // Maps to 'skills'
    $location = trim($_POST['location']); // Example, should come from form or default value
    $category = $_POST['categories']; // Example, should come from form or default value
    $level = $_POST['levels']; // Example, should come from form or default value

    //$jobListDataSet->addJobList($title, $salary, $startDate, $endDate, $description, $skills, $location, $category, $level, $_SESSION['id']);
    //header('Location: ../placement.php');
    var_dump($skills);

}

require_once ('../View/addPlacement.phtml');