<?php
require_once('../Model/studentInfoDataSet.php');
require_once('../Model/userInfoDataSet.php');
require_once('../Model/Skill.php');
require_once('../Model/Category.php');
require_once('../Model/Level.php');

session_start();


$view = new stdClass();
$studentInfo = new studentInfoDataSet();
$userInfo = new userInfoDataSet();
$skill = new Skill();
$category = new Category();
$level = new Level();

$view->userInfo = $userInfo->getUserInfo($_SESSION['id']);
$userInfoId = $view->userInfo->getId();
$skillArr = $skill->skillAssign();
$categoryArr = $category->categoryAssign();
$levelArr = $level->levelAssign();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {

    // Process selected skills
    if (isset($_POST['skills'])) {
        $selectedSkills = $_POST['skills'];
    }

    // Process selected categories
    if (isset($_POST['categories'])) {
        $selectedCategories = $_POST['categories'];
    }

    // Process selected levels
    if (isset($_POST['levels'])) {
        $selectedLevels = $_POST['levels'];
    }
    //var_dump($selectedLevels);

    if (!isset($_FILES['file_input_name']) || $_FILES['file_input_name']['error'] === UPLOAD_ERR_NO_FILE){
        $_FILES['cv_file'] = null;
    }
    //var_dump($_FILES['cv_file']);
    for($i = 0; $i < count($selectedSkills); $i++)
    {
        $skillKey = array_search($selectedSkills[$i], $skillArr);
        $categoryKey = array_search($selectedCategories[$i], $categoryArr);
        $levelKey = $levelArr[$selectedLevels[$i]];
        //var_dump($levelKey);
        $studentInfo->addStudentInfo($userInfoId, $_FILES['cv_file'], $skillKey, $categoryKey, $levelKey);
    }
}


require_once("../View/registerPage2.phtml");