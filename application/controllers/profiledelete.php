<?php

include("../../path.php");
include(ROOT_PATH . '/application/database/db.php');

if (isset($_POST['confirm'])) {
    $id = $_SESSION['id'];
    $filename = "userimage/profile" . $id . "*";
    $fileinfo = glob($filename);
    $fileExt = explode(".", $fileinfo[0]);
    $fileRealExt = $fileExt[1];

    $file = "userimage/profile" . $id . "." . $fileRealExt;
    if (!unlink($file)) {
        header("Location: " . BASE_URL . '/index.php');
        $_SESSION['upload-error-msg'] = 'Photo was not Deleted!';
        echo 'not deleted';
    } else {
        header("Location: " . BASE_URL . '/index.php');
        $_SESSION['message'] = 'Photo was Deleted';
    }

    update('profileimg', $id, ['status' => 1]);
}

if (isset($_POST['cancel'])) {
    header("Location: " . BASE_URL . '/index.php');
}