<?php
function validateEvent($event)
{
    $errors = array();
    if ($_SESSION['admin'] != 1964 && $event['category_id'] != $_SESSION['assignment']) {
        array_push($errors, 'You\'re Authorized to add in this Category');
    }
    if (empty($event['title'])) {
        array_push($errors, 'Title is Required');
    }
    if (empty($event['eventday'])) {
        array_push($errors, 'Event Date is required');
    }
    if (empty($event['description'])) {
        array_push($errors, 'Event description is Required');
    }
    if (empty($event['category_id'])) {
        array_push($errors, 'Please select a category');
    }
    $existingEvent = selectOne('events', ['title' => $event['title']]);
    if ($existingEvent) {
        if (isset($event['update-event']) && $existingEvent['id'] != $event['id']) {
            array_push($errors, 'Event title already exists');
        }
        if (isset($event['add-event'])) {
            array_push($errors, 'Event title already exists');
        }
    }
    return $errors;
}