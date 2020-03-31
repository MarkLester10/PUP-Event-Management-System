<?php

include("../../path.php");
include(ROOT_PATH . '/application/database/db.php');

$id = $_SESSION['id'];
if (isset($_POST['prof-upload'])) {
    $file = $_FILES['file'];
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];
    $fileType = $file['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png', 'pdf', 'svg');

    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 1000000) {
                $fileNameNew = "profile" . $id . "." . $fileActualExt;
                $fileDestination = 'userimage/' .
                    $fileNameNew;
                foreach (glob("userimage/profile{$id}.*") as $match) {
                    unlink($match);
                }
                move_uploaded_file($fileTmpName, $fileDestination);
                $sql = update('profileimg', $id, ['status' => 0]);
                header("location:../../index.php");
                $_SESSION['message'] = 'Photo was Uploaded';
            } else {
                header("location:../../index.php");
                $_SESSION['upload-error-msg'] = 'File is too Big';
            }
        } else {
            header("location:../../index.php");
            $_SESSION['upload-error-msg'] = 'Upload Error';
        }
    } else {
        header("location:../../index.php");
        $_SESSION['upload-error-msg'] = 'No File Selected/File not Supported';
    }
}