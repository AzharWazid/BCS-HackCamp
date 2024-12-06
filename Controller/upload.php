<?php

define('UPLOAD_DIRECTORY', '/path/to/upload/'); # replace 
define('MAXSIZE', 5242880);

$ALLOWED_EXTENSIONS = array('pdf');
$ALLOWED_MIMES = array('application/pdf');

function validFileType($uploadedTempFile, $destFilePath) {
    global $ALLOWED_EXTENSIONS, $ALLOWED_MIMES;

    $fileExtension = pathinfo($destFilePath, PATHINFO_EXTENSION);
    $fileMime = mime_content_type($uploadedTempFile);

    $validFileExtension = in_array($fileExtension, $ALLOWED_EXTENSIONS);
    $validFileMime = in_array($fileMime, $ALLOWED_MIMES);

    $validFileType = $validFileExtension && $validFileMime;

    return $validFileType;
}
function handleUpload() {
    $uploadedTempFile = $_FILES['file']['tmp_name'];
    $filename = basename($_FILES['file']['name']);
    $destFile = UPLOAD_DIRECTORY . $filename;

    $isUploadedFile = is_uploaded_file($uploadedTempFile);
    $validSize = $_FILES['file']['size'] <= MAXSIZE && $_FILES['file']['size'] >= 0;

    if ($isUploadedFile && $validSize && validFileType($uploadedTempFile, $destFile)) {
        $success = move_uploaded_file($uploadedTempFile, $destFile);

        if ($success) {
            $response = 'The file was uploaded successfully!';
        } else {
            $response = 'An unexpected error occurred; the file could not be uploaded.';
        }
    } else {
        $response = 'Error: the file you tried to upload is not a valid file. Check file type and size.';
    }

    return $response;
}

$validFormSubmission = !empty($_FILES);

if ($validFormSubmission) {
    $error = $_FILES['file']['error'];

    switch($error) {
        case UPLOAD_ERR_OK:
            $response = handleUpload();
            break;

        case UPLOAD_ERR_INI_SIZE:
            $response = 'Error: file size is bigger than allowed.';
            break;

        case UPLOAD_ERR_PARTIAL:
            $response = 'Error: the file was only partially uploaded.';
            break;

        case UPLOAD_ERR_NO_FILE:
            $response = 'Error: no file could have been uploaded.';
            break;

        case UPLOAD_ERR_NO_TMP_DIR:
            $response = 'Error: no temp directory! Contact the administrator.';
            break;

        case UPLOAD_ERR_CANT_WRITE:
            $response = 'Error: it was not possible to write in the disk. Contact the administrator.';
            break;

        case UPLOAD_ERR_EXTENSION:
            $response = 'Error: a PHP extension stopped the upload. Contact the administrator.';
            break;

        default:
            $response = 'An unexpected error occurred; the file could not be uploaded.';
            break;
    }
} else {
    $response = 'Error: the form was not submitted correctly - did you try to access the action url directly?';
}

echo $response;
