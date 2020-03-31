<?php

include "../../path.php";
include ROOT_PATH . '/application/database/db.php';

// confirmation for deleting user photo
if (isset($_GET['prof-delete'])) {
    $_SESSION['confirm'] = 'Are you sure?';
    header("Location: " . BASE_URL . '/index.php');
    exit();
}

//confirmation for clearing all events in manage event tab
if (isset($_GET['clear'])) {
    $_SESSION['clear-events'] = 'Do you really want to clear events table?<br>Note: All Registered Tickets will not be available';
    header("Location: " . BASE_URL . '/admin/elists/index.php');
    exit();
}

// confirmation for deleting an event
if (isset($_GET['del-event'])) {
    $_SESSION['delete-event'] = $_GET['del-event'];
    header("Location: " . BASE_URL . '/admin/elists/index.php');
    exit();
}

// confirmation for deleting category
if (isset($_GET['del-category'])) {
    $_SESSION['delete-category'] = $_GET['del-category'];
    header("Location: " . BASE_URL . '/admin/ecategories/index.php');
    exit();
}

// confirmatio for clearing all tables from people tab
if (isset($_GET['alter'])) {
    $_SESSION['clear-people'] = 'Do you really want to clear all tables?<br>Note: This process cannot be undone';
    header("Location: " . BASE_URL . '/admin/elists/people.php');
    exit();
}

// confirmatio for clearing active table from people tab
if (isset($_GET['del-id'])) {
    $_SESSION['clear-activepeople'] = $_GET['del-id'];
    header("Location: " . BASE_URL . '/admin/elists/people.php');
    exit();
}

// confirmation for deleting user
if (isset($_GET['del-user'])) {
    $_SESSION['delete-user'] = $_GET['del-user'];
    header("Location: " . BASE_URL . '/admin/adminusers/index.php');
    exit();
}