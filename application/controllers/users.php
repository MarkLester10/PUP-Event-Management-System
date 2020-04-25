<?php
include ROOT_PATH . "/application/database/db.php";
include ROOT_PATH . "/application/helpers/validateSignup.php";
include ROOT_PATH . "/application/helpers/validateLogin.php";
include ROOT_PATH . "/application/controllers/middleware.php";
$table = 'users';
$usersAdmin = selectAll($table, ['admin' => 2000]);
$usersStudents = selectAll($table, ['admin' => 1100]);
$categories = selectAll('categories');

$errors = array();
$username = '';
$id = '';
$email = '';
$password = '';
$passwordConf = '';
$admin = '';
$assignment = '';

// USER-LOGIN PAGE REDIRECTION
function userLogin($user)
{
    $_SESSION['id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['admin'] = $user['admin'];
    $_SESSION['assignment'] = $user['assignment'];
    $_SESSION['type'] = 'ekis';

    if ($_SESSION['admin'] == 1964 || $_SESSION['admin'] == 2000) {
        $_SESSION['welcome-message'] = 'Welcome Back <span>' . $_SESSION['username'] . '</span>';
        header('location: ' . BASE_URL . '/admin/dashboard.php');
    } else {
        $_SESSION['welcome-message'] = 'Welcome Back <span>' . $_SESSION['username'] . '</span>';
        header('location: ' . BASE_URL . '/index.php');
    }
    exit();
}

// USER-REGISTRATION both admin and students
if (isset($_POST['register-btn']) || isset($_POST['create-admin'])) {
    if (isset($_POST['create-admin'])) {
        adminOnly();
    }
    $errors = validateUser($_POST);
    if (count($errors) === 0) {
        unset($_POST['passwordConf'], $_POST['register-btn'], $_POST['create-admin']);
        $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

        if ($_POST['admin'] == 2000) {
            $user_id = create($table, $_POST);
            $userImg = create('profileimg', ['id' => $user_id, 'status' => 1]);
            $_SESSION['message'] = 'Admin user created successfully';
            header('location: ' . BASE_URL . '/admin/adminusers/index.php');
            exit();
        } else {
            $user_id = create($table, $_POST);
            $user = selectOne($table, ['id' => $user_id]);
            $userImg = create('profileimg', ['id' => $user_id, 'status' => 1]);
            //login user
            userLogin($user);
        }
    } else {
        $username = $_POST['username']; 
        $email = $_POST['email'];
        // $admin = $_POST['admin'];
    }
}

// USER-LOGIN PAGE
if (isset($_POST['signin-submit'])) {
    $errors = validateLogin($_POST);
    if (count($errors) === 0) {
        $user = selectOne($table, ['email' => $_POST['username']]/*|| ['username' => $_POST['username']]*/);

        if ($user) {
            if ($user && password_verify($_POST['password'], $user['password'])) {
                // login user
                userLogin($user);
            } else {
                array_push($errors, 'Wrong Password');
            }
        } else {
            array_push($errors, 'No User Found');
        }
    }
    $username = $_POST['username'];
    $password = $_POST['password'];
}

//info of user to be edited
if (isset($_GET['e-id'])) {
    $id = $_GET['e-id'];

    $selectedUser = selectOne($table, ['id' => $id]);
    // dump($selectedUser);
    $id = $selectedUser['id'];
    $username = $selectedUser['username'];
    $email = $selectedUser['email'];
    $admin = $selectedUser['admin'];
    $password = $selectedUser['password'];
    $passwordConf = $selectedUser['password'];
    $assignment = $selectedUser['assignment'];
}

//edit and update user
if (isset($_POST['update-user'])) {
    adminOnly();
    $errors = validateUser($_POST);
    $user_id = $_POST['id'];
    if (count($errors) === 0) {
        unset($_POST['passwordConf'], $_POST['update-user'], $_POST['id']);
        $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $user_id = update($table, $user_id, $_POST);
        if ($user_id) {
            $_SESSION['message'] = 'User updated successfully';
            header('location: ' . BASE_URL . '/admin/adminusers/index.php');
            exit();
        }
    } else {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $passwordConf = $_POST['passwordConf'];
        $admin = $_POST['admin'];
    }
}

//delete user
if (isset($_GET['del-id'])) {
    adminOnly();
    $id = $_GET['del-id'];
    $user = selectOne($table, ['id' => $id]);
    $userImg = delete('profileimg', $id);
    $userDelete = delete($table, $id);
    if ($userDelete) {
        if ($user['admin'] === 1100) {
            $_SESSION['message'] = 'Student user Deleted';
            header("Location: " . BASE_URL . '/admin/adminusers/index.php');
            exit();
        } else {
            $_SESSION['message'] = 'Admin user Deleted';
            header("Location: " . BASE_URL . '/admin/adminusers/index.php');
            exit();
        }
    } else {
        $_SESSION['upload-error-msg'] = 'Error: User Delete Unsuccessful!';
        header("Location: " . BASE_URL . '/admin/adminusers/index.php');
        exit();
    }
}