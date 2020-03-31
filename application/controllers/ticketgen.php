<?php
include ROOT_PATH . "/application/database/db.php";
include ROOT_PATH . "/application/controllers/middleware.php";

$ticket = '';
$eventName = '';
$eventCatId = '';
$eventId = '';
$withRaffle = '';
$eventDate = '';

$first3dNumbers = rand(100, 999);
$second3dNumbers = rand(300, 999);
$ticket = "PUP-E " . $first3dNumbers . "-" . $second3dNumbers . "-" . $_SESSION['id'];

if (isset($_POST['download-btn'])) {
    unset($_POST['download-btn']);
    // dump($_POST);

    $result = selectOne('people', ['ticket' => $_POST['ticket']]);
    if ($result) {
        $_SESSION['upload-error-msg'] = "Sorry Only One Entry Per Raffle";
        header('Location:' . BASE_URL . '/index.php');
        exit(0);
    } else {
        $insert = create('people', $_POST);
        $_SESSION['message'] = "Thank You For Joining";
        header('Location:' . BASE_URL . '/index.php');
        exit(0);
    }

}

if (isset($_GET['event-id'])) {
    $id = $_GET['event-id'];
    $event = selectOne('events', ['id' => $id]);
    $eventName = $event['title'];
    $eventCatId = $event['category_id'];
    $eventId = $event['id'];
    $withRaffle = $event['raffleSystem'];
    $eventDate = $event['eventday'];
}