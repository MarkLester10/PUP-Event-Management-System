<?php

function validateUser($user)
{

    $errors = array();
    $uppercase = preg_match('/[A-Z]/', $user['password']);
    $lowercase = preg_match('/[a-z]/', $user['password']);
    $number = preg_match('/[0-9]/', $user['password']);
    $specialChars = preg_match('/[\W]/', $user['password']);

    if (empty($user['username']) || empty($user['email']) || empty($user['password']) || empty($user['passwordConf'])) {
        array_push($errors, 'Please Fill in all fields');
    } elseif (!filter_var($user['email'], FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $user['username'])) {
        array_push($errors, 'Invalid Email and Username');
    } elseif (!filter_var($user['email'], FILTER_VALIDATE_EMAIL)) {
        array_push($errors, 'Invalid Email');
    } elseif (!preg_match("/^[a-zA-Z0-9- -]*$/", $user['username'])) {
        array_push($errors, 'Invalid Username');
    } elseif ($user['passwordConf'] !== $user['password']) {
        array_push($errors, 'Password do not match');
    } elseif (!$uppercase || !$lowercase || !$number || !$specialChars || !strlen($user['password']) >= 8) {
        array_push($errors, 'Password must be 8 characters in length and with combinations of uppercase and lowercase letters and a special character');
    }
    $existingUserEmail = selectOne('users', ['email' => $user['email']]);
    if ($existingUserEmail) {
        if (isset($user['update-user']) && $existingUserEmail['id'] != $user['id']) {
            array_push($errors, 'Email already exists');
        }
        if (isset($user['register-btn']) || isset($user['create-admin'])) {
            array_push($errors, 'Email already exist');
        }
    }
    return $errors;
}