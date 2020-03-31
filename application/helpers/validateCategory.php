<?php

function validateCategory($category)
{

    $errors = array();
    if (empty($category['name'])) {
        array_push($errors, 'Name is Required');
    }
    $existingCategory = selectOne('categories', ['name' => $category['name']]);
    if ($existingCategory) {
        if (isset($category['update-category']) && $category['id'] != $existingCategory['id']) {
            array_push($errors, "Category Already Exists");
        }

        if (isset($category['add-category'])) {
            array_push($errors, "Category Already Exists");
        }
    }
    return $errors;
}