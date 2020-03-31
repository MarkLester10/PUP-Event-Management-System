<?php

function validateLogin($user)
{

    $errors = array();
    if (empty($user['username'] || $user['password'])) {
        array_push($errors, 'Please Fill in all Fields');
    } elseif (empty($user['password'])) {
        array_push($errors, 'Password is Required');
    } elseif (empty($user['username'])) {
        array_push($errors, 'Username is Required');
    }

    return $errors;
}