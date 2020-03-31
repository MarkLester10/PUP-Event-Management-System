<?php

function usersOnly($redirect = '/login.php')
{
    if (empty($_SESSION['id'])) {
        header('Location:' . BASE_URL . $redirect);
        exit();
    }
}

function superUserAndAdmin($redirect = '/index.php')
{
    if (!($_SESSION['admin']==2000) && !($_SESSION['admin']==1964)) {
        $_SESSION['upload-error-msg'] = "You're not Authorized";
        header('Location:' . BASE_URL . $redirect);
        exit(0);
    }
}

function adminOnly($redirect = '/admin/dashboard.php')
{
    if ($_SESSION['admin'] != 1964) {
        $_SESSION['upload-error-msg'] = "You're not Authorized";
        header('Location:' . BASE_URL . $redirect);
        exit(0);
    }
}

function visitorsOnly($redirect = '/index.php')
{
    if (!empty($_SESSION['id'])) {
        $_SESSION['message'] = 'You already logged in';
        header('Location:' . BASE_URL . $redirect);
        exit(0);
    }
}