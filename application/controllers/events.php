<?php
include ROOT_PATH . "/application/database/db.php";
include ROOT_PATH . "/application/helpers/validateEvent.php";
include ROOT_PATH . "/application/controllers/middleware.php";
require ROOT_PATH . "/assets/fpdf182/fpdf.php";
$table = 'events';
$categories = selectAll('categories');

$errors = array();
$id = '';
$title = '';
$description = '';
$category_id = '';
$released = '';
$raffleSystem = '';
$eventDay = '';

$ticketStudentNumber = '';
$ticketStudentCourse = '';
$ticketStudentAddress = '';
$ticketName = '';
$ticketEventTitle = '';
$ticketNumber = '';
$events = array();
// pagination
if (isset($_GET['search-term'])) {
    if ($_SESSION['admin'] == 1964) {
        $eventsAdmin = searchEventAdmin($_GET['search-term']);
        $number_of_events = count($eventsAdmin);
        $events_per_page = 10;
        $total_pages = ceil($number_of_events / $events_per_page);

        if (isset($_GET['page']) && !empty($_GET['page'])) {
            $page = $_GET['page'];
            if ($page > $total_pages) {
                // $page = 1;
                header("Location:" . BASE_URL . '/admin/elists/index.php?page=1');
            }
        } else {
            $page = 1;
        }
        $search = $_GET['search-term'];
        $offset = ($page - 1) * $events_per_page;
        $events = searchEventAdminPagination($search, $events_per_page, $offset);
    } else {
        $id = $_SESSION['assignment'];
        $eventsbyAdmin = searchEventByAdmin($_GET['search-term'], $id);
        $number_of_events = count($eventsbyAdmin);

        $events_per_page = 10;
        $total_pages = ceil($number_of_events / $events_per_page);

        if (isset($_GET['page']) && !empty($_GET['page'])) {
            $page = $_GET['page'];
            if ($page > $total_pages) {
                // $page = 1;
                header("Location:" . BASE_URL . '/admin/elists/index.php?page=1');
            }
        } else {
            $page = 1;
        }

        $offset = ($page - 1) * $events_per_page;
        $events = searchEventbyAdminPagination($_GET['search-term'], $id, $events_per_page, $offset);
    }
} elseif (isset($_GET['from_date']) && isset($_GET['to_date'])) {
    if ($_SESSION['admin'] == 1964) {
        $from_date = date('Y-m-d', strtotime($_GET['from_date']));
        $to_date = date('Y-m-d', strtotime($_GET['to_date']));
        $filteredevents = filterEvents($from_date, $to_date);
        $number_of_events = count($filteredevents);

        $events_per_page = 10;
        $total_pages = ceil($number_of_events / $events_per_page);

        if (isset($_GET['page']) && !empty($_GET['page'])) {
            $page = $_GET['page'];
            if ($page > $total_pages) {
                // $page = 1;
                header("Location:" . BASE_URL . '/admin/elists/index.php?page=1');
            }
        } else {
            $page = 1;
        }

        $offset = ($page - 1) * $events_per_page;
        $events = filterEventsPagination($from_date, $to_date, $events_per_page, $offset);
    } else {
        $id = $_SESSION['assignment'];
        $from_date = date('Y-m-d', strtotime($_GET['from_date']));
        $to_date = date('Y-m-d', strtotime($_GET['to_date']));
        $filteredevents = filterEventsByCourse($id, $from_date, $to_date);
        $number_of_events = count($filteredevents);

        $events_per_page = 10;
        $total_pages = ceil($number_of_events / $events_per_page);

        if (isset($_GET['page']) && !empty($_GET['page'])) {
            $page = $_GET['page'];
            if ($page > $total_pages) {
                // $page = 1;
                header("Location:" . BASE_URL . '/admin/elists/index.php?page=1');
            }
        } else {
            $page = 1;
        }

        $offset = ($page - 1) * $events_per_page;
        $events = filterEventsByCoursePagination($id, $from_date, $to_date, $events_per_page, $offset);
    }

} else {
    if ($_SESSION['admin'] == 1964) {
        $eventsAll = getEvents();
        $number_of_events = count($eventsAll);

        $events_per_page = 10;
        $total_pages = ceil($number_of_events / $events_per_page);

        if (isset($_GET['page']) && !empty($_GET['page'])) {
            $page = $_GET['page'];
            if ($page > $total_pages) {
                // $page = 1;
                header("Location:" . BASE_URL . '/admin/elists/index.php?page=1');
            }
        } else {
            $page = 1;
        }

        $offset = ($page - 1) * $events_per_page;
        $events = getEventsPagination($events_per_page, $offset);
    } else {
        $id = $_SESSION['assignment'];
        $eventsAllByCourse = getEventsByAdmin($id);
        $number_of_events = count($eventsAllByCourse);

        $events_per_page = 10;
        $total_pages = ceil($number_of_events / $events_per_page);

        if (isset($_GET['page']) && !empty($_GET['page'])) {
            $page = $_GET['page'];
            if ($page > $total_pages) {
                // $page = 1;
                header("Location:" . BASE_URL . '/admin/elists/index.php?page=1');
            }
        } else {
            $page = 1;
        }

        $offset = ($page - 1) * $events_per_page;
        $events = getEventsByAdminPagination($id, $events_per_page, $offset);
    }
}
// add event
if (isset($_POST['add-event'])) {
    $errors = validateEvent($_POST);

    if (!empty($_FILES['image']['name'])) {
        $imageName = time() . "_" . $_FILES['image']['name'];
        $tmpDestination = $_FILES['image']['tmp_name'];
        $imageDestination = ROOT_PATH . "/assets/imgs/eventsimgs/" . $imageName;
        $result = move_uploaded_file($tmpDestination, $imageDestination); //this returns boolean

        if ($result) {
            $_POST['image'] = $imageName;
        } else {
            array_push($errors, "Image Upload Failed");
        }
    } else {
        array_push($errors, "Event Image is Required");
    }

    if (count($errors) == 0) {
        unset($_POST['add-event']);
        $_POST['user_id'] = $_SESSION['id'];
        $_POST['released'] = isset($_POST['released']) ? 1 : 0;
        $_POST['raffleSystem'] = isset($_POST['raffleSystem']) ? 1 : 0;
        $_POST['description'] = htmlentities($_POST['description']);
        $eventId = create($table, $_POST);
        $_SESSION['message'] = 'Event Added Successfully';
        header("Location: " . BASE_URL . '/admin/elists/index.php');
    } else {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $category_id = $_POST['category_id'];
        $released = isset($_POST['released']) ? 1 : 0;
        $raffleSystem = isset($_POST['raffleSystem']) ? 1 : 0;
    }
}

//edit and update event
if (isset($_POST['update-event'])) {
    $errors = validateEvent($_POST);
    $eventDel = selectOne($table, ['id' => $_POST['id']]);
    $file = ROOT_PATH . "/assets/imgs/eventsimgs/" . $eventDel['image'];
    unlink($file);
    if (!empty($_FILES['image']['name'])) {
        $imageName = time() . "_" . $_FILES['image']['name'];
        $tmpDestination = $_FILES['image']['tmp_name'];
        $imageDestination = ROOT_PATH . "/assets/imgs/eventsimgs/" . $imageName;

        $result = move_uploaded_file($tmpDestination, $imageDestination); //this returns boolean

        if ($result) {
            $_POST['image'] = $imageName;
        } else {
            array_push($errors, "Image Upload Failed");
        }
    } else {
        array_push($errors, "Event Image is Required");
    }

    if (count($errors) == 0) {
        $id = $_POST['id'];
        unset($_POST['update-event'], $_POST['id']);
        $_POST['user_id'] = $_SESSION['id'];
        $_POST['released'] = isset($_POST['released']) ? 1 : 0;
        $_POST['raffleSystem'] = isset($_POST['raffleSystem']) ? 1 : 0;
        $_POST['description'] = htmlentities($_POST['description']);

        $categoryupdate = update($table, $id, ['category_id' => $_POST['category_id']]);
        $eventId = update($table, $id, $_POST);
        $_SESSION['message'] = 'Event Updated Successfully';
        header("Location: " . BASE_URL . '/admin/elists/index.php');
    } else {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $category_id = $_POST['category_id'];
        $released = isset($_POST['released']) ? 1 : 0;
        $raffleSystem = isset($_POST['raffleSystem']) ? 1 : 0;
    }
}

//delete event
if (isset($_GET['delete-event'])) {
    $id = $_GET['delete-event'];
    $eventDelete = delete($table, $id);
    if ($eventDelete == 1) {
        $eventDel = selectOne($table, ['id' => $id]);
        $file = ROOT_PATH . "/assets/imgs/eventsimgs/" . $eventDel['image'];
        unlink($file);
        $_SESSION['message'] = 'Event Deleted Successfully';
        header("Location: " . BASE_URL . '/admin/elists/index.php');
        exit();
    } else {
        $_SESSION['upload-error-msg'] = 'Error: Delete Unsuccessful! <h4 style="color: #ddd;">There are still registered raffle tickets in this Event</h4>';
        header("Location: " . BASE_URL . '/admin/elists/index.php');
        exit();
    }
}

//delete event
if (isset($_GET['delete-comment'])) {
    $id = $_GET['delete-comment'];
    $commentDelete = delete('comment', $id);
    $_SESSION['message'] = 'Comment Deleted Successfully';
    header("Location: " . BASE_URL . '/admin/dashboard.php');
    exit();
}

//info of event to be edited
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $selectEvent = selectOne('events', ['id' => $id]);
    $id = $selectEvent['id'];
    $title = $selectEvent['title'];
    $description = $selectEvent['description'];
    $category_id = $selectEvent['category_id'];
    $released = $selectEvent['released'];
    $raffleSystem = $selectEvent['raffleSystem'];
    $eventDay = $selectEvent['eventday'];
}

//update state of event
if (isset($_GET['released']) && isset($_GET['e_id'])) {
    $id = $_GET['e_id'];
    $eventDel = selectOne($table, ['id' => $id]);
    // if ($eventDel['user_id'] != $_SESSION['id']) {
    //     $_SESSION['upload-error-msg'] = "You're not authorized";
    //     header('Location:' . BASE_URL . '/admin/elists/index.php');
    //     exit(0);
    // }
    $state = $_GET['released'];

    $updateAction = update($table, $id, ['released' => $state]);
    $_SESSION['message'] = 'Event state changed';
    header("Location: " . BASE_URL . '/admin/elists/index.php');
    exit();
}

//update state of comment
if (isset($_GET['state']) && isset($_GET['cId'])) {
    adminOnly();
    $id = $_GET['cId'];
    $cmtDelete = selectOne('comment', ['id' => $id]);

    $state = $_GET['state'];

    $updateComment = update('comment', $id, ['status' => $state]);
    $_SESSION['message'] = 'Comment Status Updated';
    header("Location: " . BASE_URL . '/admin/dashboard.php');
    exit();
}

// truncate evnts table
if (isset($_POST['confirm'])) {
    adminOnly();
    $people = selectAll('events');

    if (empty($people)) {
        $_SESSION['upload-error-msg'] = 'Events Table is empty!';
        header("Location: " . BASE_URL . '/admin/elists/index.php');
        exit();
    } else {
        $resetTable = resetAll('events');
        if ($resetTable == 1) {
            $_SESSION['message'] = 'Events Table was Cleared';
            header("Location: " . BASE_URL . '/admin/elists/index.php');
            exit();
        } else {
            $_SESSION['upload-error-msg'] = 'Error: Clearing Events Table';
            header("Location: " . BASE_URL . '/admin/elists/index.php');
            exit();
        }

    }
}
if (isset($_POST['cancel'])) {
    header("Location: " . BASE_URL . '/admin/elists/index.php');
}

//FUNCTIONALITY FOR PEOPLE TAB

//clear the table from the active tab
if (isset($_GET['p-activeconfirm'])) {
    adminOnly();
    $id = $_GET['p-activeconfirm'];
    $peoplePerTab = selectAll('people', ['cat_id' => $id]);
    $tableName = selectOne('categories', ['id' => $id]);

    if (empty($peoplePerTab)) {
        $_SESSION['upload-error-msg'] = $tableName['name'] . ' table is empty!';
        header("Location: " . BASE_URL . '/admin/elists/people.php');
        exit();
    } else {
        $peopleClr = delete('people', $id); //this id is the id of the category not the user
        if ($peopleClr == 1) {
            $_SESSION['message'] = $tableName['name'] . ' List was Cleared';
            header("Location: " . BASE_URL . '/admin/elists/people.php');
            exit();
        } else {
            $_SESSION['upload-error-msg'] = $tableName['name'] . ' List is Empty';
            header("Location: " . BASE_URL . '/admin/elists/people.php');
            exit();
        }
    }

}

// truncate people table
if (isset($_POST['p-confirm'])) {
    adminOnly();
    $people = selectAll('people');

    if (empty($people)) {
        $_SESSION['upload-error-msg'] = 'All tables are empty!';
        header("Location: " . BASE_URL . '/admin/elists/people.php');
        exit();
    } else {
        $resetTable = resetAll('people');
        if ($resetTable == 1) {
            $_SESSION['message'] = 'All Tables was Cleared';
            header("Location: " . BASE_URL . '/admin/elists/people.php');
            exit();
        } else {
            $_SESSION['upload-error-msg'] = 'Error Clearing Tables';
            header("Location: " . BASE_URL . '/admin/elists/people.php');
            exit();
        }
    }
}

if (isset($_POST['p-cancel'])) {
    header("Location: " . BASE_URL . '/admin/elists/people.php');
    exit();
}

if (isset($_POST['download'])) {
    $eventsCopy = array();

    class myPDF extends FPDF
    {

        public function header()
        {
            $this->Image(BASE_URL . '/assets/imgs/PUPLogo.png', 80, 10, -1500);
            $this->Image(BASE_URL . '/assets/imgs/logofinal.png', 193, 10, -1500);
            $this->SetFont('Arial', 'B', 14);
            $this->Cell(276, 5, 'Summary of Events', 0, 0, 'C');
            $this->Ln();
            $this->SetFont('Times', '', 12);
            $this->Cell(276, 10, 'Polytechnic University of the Philippines', 0, 0, 'C');
            $this->Ln();
            $this->SetFont('Times', '', 12);
            $this->Cell(276, 0, 'Sto. Tomas City, Batangas', 0, 0, 'C');
            $this->Ln();
            $this->SetFont('Times', 'I', 12);
            $this->Cell(276, 10, 'The Country\'s 1st PolytechnicU', 0, 0, 'C');
            $this->Ln();
            $this->SetFont('Times', '', 12);
            $this->Cell(276, 0, 'Year ' . date('Y'), 0, 0, 'C');
            $this->Ln(20);
        }

        public function footer()
        {
            $this->SetY(-15);
            $this->SetFont('Arial', '', 8);
            $this->Cell(0, 10, 'Page ' . $this->PageNo() . ' of {nb}', 0, 0, 'C');
        }

        public function headerTable()
        {
            $this->SetFont('Arial', 'B', 12);
            $this->Cell(20, 10, 'No', 1, 0, 'C');
            $this->Cell(80, 10, 'Event Title', 1, 0, 'C');
            $this->Cell(40, 10, 'Administrator', 1, 0, 'C');
            $this->Cell(40, 10, 'Category', 1, 0, 'C');
            $this->Cell(48, 10, 'Date Held', 1, 0, 'C');
            $this->Cell(48, 10, 'Date Posted', 1, 0, 'C');
            $this->Ln();
        }

        public function viewTable()
        {

            $this->SetFont('Arial', '', 12);
            if ($_SESSION['admin'] == 1964) {
                $eventsCopy = getEvents();
            } else {
                $id = $_POST['cat_id'];
                $eventsCopy = getEventsByAdmin($id);
            }

            foreach ($eventsCopy as $key => $data) {
                $this->Cell(20, 10, $key + 1, 1, 0, 'C');

                if ($this->GetStringWidth($data['title']) > 65) {
                    $this->SetFont('Arial', '', 10);
                    $this->Cell(80, 10, $data['title'], 1, 0, 'C');
                } else {
                    $this->SetFont('Arial', '', 10);
                    $this->Cell(80, 10, $data['title'], 1, 0, 'C');
                }

                $this->Cell(40, 10, $data['username'], 1, 0, 'C');
                $this->Cell(40, 10, $data['name'], 1, 0, 'C');
                $this->Cell(48, 10, date('M j, Y', strtotime($data['eventday'])), 1, 0, 'C');
                $this->Cell(48, 10, date('M j, Y', strtotime($data['created_at'])), 1, 0, 'C');
                $this->Ln();
            }

        }

    }

    $pdf = new myPDF();
    $pdf->AliasNbPages();
    $pdf->AddPage('L', 'A4', 0);
    $pdf->headerTable();
    $pdf->viewTable();
    $pdf->Output();
    // $pdf->SetAutoPageBreak(true, 15);

}