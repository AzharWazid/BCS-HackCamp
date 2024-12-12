<?php
session_start();

// Define the directory where CVs will be stored
$uploadDir = '../CV_Uploads/'; // Adjust to match your project's directory structure

// Ensure the directory exists
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true); // Create the directory if it doesn't exist
}

$response = ['status' => '', 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['cv_file'])) {
    $file = $_FILES['cv_file'];
    $fileName = basename($file['name']);
    $targetFilePath = $uploadDir . $fileName;

    // Validate file type
    $allowedTypes = ['pdf', 'doc', 'docx'];
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    if (in_array($fileExtension, $allowedTypes)) {
        // Move the uploaded file to the target directory
        if (move_uploaded_file($file['tmp_name'], $targetFilePath)) {
            $_SESSION['cv_file'] = $fileName; // Save the file name in the session
            $response['status'] = 'success';
            $response['message'] = 'CV uploaded successfully!';
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Error uploading your CV.';
        }
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Invalid file type. Only PDF, DOC, and DOCX files are allowed.';
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'No file uploaded.';
}

echo json_encode($response);
?>