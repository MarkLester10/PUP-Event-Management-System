<?php
include ROOT_PATH . "/application/helpers/validateCategory.php";
include ROOT_PATH . "/application/controllers/middleware.php";
include ROOT_PATH . "/application/database/db.php";

$errors = array();
$table = 'categories';
$name = '';
$description = '';

$categories = selectAll($table);
$status = 1;
$comments = getComments($status);

$events = array();
$unangTitle = "";
$pangalawangTitle = "";
$ikatlongTitle = "";
$date = date('Y-m-d');
$upcomingEvents = getReleasedUpcomingEvents($date);
$TodayEvents = getReleasedTodayEvents($date);
$nextEventId = nextEventId($date);
$nextEvent = selectOne('events', ['id' => $nextEventId['eventid']]);

if (count($upcomingEvents) > 0) {
    $unangTitle = "Upcoming Events";
} else {
    $unangTitle = "<span style='color:#ddd; font-style: italic'>No Upcoming Events</span>";
}
if (count($TodayEvents) > 0) {
    $ikatlongTitle = "Events Today";
} else {
    $ikatlongTitle = "<span style='color:#E0E0E0; font-style: italic'>Next Event will start in</span>";
}
// PAGINATION
if (isset($_GET['search'])) {
    $eventsCount = searchEvent($_GET['search']);
    $number_of_events = count($eventsCount);

    $events_per_page = 4;
    $total_pages = ceil($number_of_events / $events_per_page);

    if ($number_of_events === 0) {
        $pangalawangTitle = "<span style='color:#ddd; font-style: italic'>Sorry, No Events this time :(</span>";
    } else {
        if (isset($_GET['page']) && !empty($_GET['page'])) {
            $page = $_GET['page'];
            if ($page > $total_pages) {
                $page = 1;
                // header("Location:" . BASE_URL . '/index.php?page=1');
            }
        } else {
            $page = 1;
        }

        $offset = ($page - 1) * $events_per_page;
        $events = searchEventPagination($_GET['search'], $events_per_page, $offset);
        $pangalawangTitle = "Exciting Events About <span style='color:#00E676;font-style: italic; '>" . $_GET['search'] . "</span>";
    }

} else if (isset($_GET['c_id'])) {
    $eventsCount = getEventsByCatId($_GET['c_id']);

    $number_of_events = count($eventsCount);
    $events_per_page = 4;
    $total_pages = ceil($number_of_events / $events_per_page);

    if ($number_of_events === 0) {
        $pangalawangTitle = "<span style='color:#ddd; font-style: italic'>Sorry, No Events this time :(</span>";
    } else {
        if (isset($_GET['page']) && !empty($_GET['page'])) {
            $page = $_GET['page'];
            if ($page > $total_pages) {
                // $page = 1;
                header("Location:" . BASE_URL . '/index.php?page=1');
            }
        } else {
            $page = 1;
        }

        $offset = ($page - 1) * $events_per_page;
        $events = getEventsByCatIdPagination($_GET['c_id'], $events_per_page, $offset);
        // $unangTitle = "Events For <span style='color:#00E676; font-style: italic'>" . $_GET['name'] . "</span>";
        $pangalawangTitle = "Exciting Events For <span style='color:#00E676;font-style: italic; '>" . $_GET['name'] . "</span>";
    }

} else {
    $numevents = getReleasedEvents();
    $number_of_events = count($numevents);

    if ($number_of_events === 0) {
        // $unangTitle = "<span style='color:#ddd; font-style: italic'>No Events Added Yet</span>";
        $pangalawangTitle = "<span style='color:#ddd; font-style: italic'>Sorry, No Events this time :(</span>";
    } else {
        // $unangTitle = "Upcoming Events";
        $pangalawangTitle = "All Of Our Events";
    }

    $events_per_page = 4;
    $total_pages = ceil($number_of_events / $events_per_page);

    if (isset($_GET['page']) && !empty($_GET['page'])) {
        $page = $_GET['page'];
        if ($page > $total_pages) {
            // $page = 1;
            header("Location:" . BASE_URL . '/index.php?page=1');
        }
    } else {
        $page = 1;
    }

    $offset = ($page - 1) * $events_per_page;
    $events = getReleasedEventsPagination($events_per_page, $offset);
}

// add categories
if (isset($_POST['add-category'])) {
    adminOnly();
    $errors = validateCategory($_POST);
    if (count($errors) === 0) {
        unset($_POST['add-category']);
        $catId = create($table, $_POST);
        $_SESSION['message'] = 'Category Created Successfully';
        header("Location: " . BASE_URL . '/admin/ecategories/index.php');
        exit();
    } else {
        $name = $_POST['name'];
        $description = $_POST['description'];
    }
}

//editing the category using get medthod

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $category = selectOne($table, ['id' => $id]);
    $id = $category['id'];
    $name = $category['name'];
    $description = $category['description'];
}

//update the edited category
if (isset($_POST['update-category'])) {
    adminOnly();
    $errors = validateCategory($_POST);
    if (count($errors) === 0) {
        $id = $_POST['id'];
        unset($_POST['update-category'], $_POST['id']);
        $catId = update($table, $id, $_POST);
        if ($catId) {
            $_SESSION['message'] = 'Category Updated Successfully';
            header("Location: " . BASE_URL . '/admin/ecategories/index.php');
            exit();
        } else {
            $_SESSION['upload-error-msg'] = 'Error: Update Unsuccessful!';
            header("Location: " . BASE_URL . '/admin/ecategories/edit.php');
            exit();
        }
    } else {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
    }
}

//delete category
if (isset($_GET['del-id'])) {
    adminOnly();
    $id = $_GET['del-id'];
    $catId = delete($table, $id);
    if (($catId == 1)) {
        $_SESSION['message'] = 'Category Deleted Successfully';
        header("Location: " . BASE_URL . '/admin/ecategories/index.php');
        exit();
    } else {
        $_SESSION['upload-error-msg'] = 'Error: Delete Unsuccessful! <h4 style="color: #ddd;">There are still Events in this Category</h4>';
        header("Location: " . BASE_URL . '/admin/ecategories/index.php');
        exit();
    }
}

// comments
if (isset($_POST['send'])) {
    usersOnly();
    unset($_POST['send']);
    $commentId = create('comment', $_POST);
    $_SESSION['message'] = 'Thank You For your Feedback :) <h4 style="color: #ddd;">We will post it after a review</h4>';
    header("Location: " . BASE_URL . '/index.php');
    exit();
}