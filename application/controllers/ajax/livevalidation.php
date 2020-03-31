<?php
include "../../database/db.php";

// live validation

if (isset($_POST['input_title'])) {
    $input_title = $_POST['input_title'];
    $check = selectAll('events', ['title' => $input_title]);

    if (count($check) > 0) {
        echo "Title Already Exist";
    } else {
        echo "Available";
    }
    exit();
}

if (isset($_POST['input_email'])) {
    $input_email = $_POST['input_email'];
    $check = selectAll('users', ['email' => $input_email]);

    if (count($check) > 0) {
        echo "Email Already Exist";
    } else {
        echo "Available";
    }
    exit();
}

if (isset($_POST['input_username'])) {
    $input_username = $_POST['input_username'];
    $check = selectAll('users', ['email' => $input_username]);
    if (count($check) > 0) {
        echo "Available";
    } else {
        echo "Email does not Exist";
    }
    exit();
}
