<?php include "../../path.php";?>
<?php include ROOT_PATH . "/application/controllers/events.php";
superUserAndAdmin();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Admin - Manage Events</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="<?php echo BASE_URL . '/assets/fontawesome/css/all.css'; ?>" />
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo BASE_URL . '/assets/js/aos-master/dist/aos.css' ?>" />
    <link rel="stylesheet" href="<?php echo BASE_URL . '/assets/css/index.css'; ?>" />
    <link rel="stylesheet" href="<?php echo BASE_URL . '/assets/css/admin.css'; ?>" />
    <link rel="stylesheet" href="<?php echo BASE_URL . '/assets/css/modal.css' ?>" />
    <link rel="icon" href="<?php echo BASE_URL . '/assets/imgs/logofinal.png' ?>">
</head>

<body>
    <?php include ROOT_PATH . "/application/includes/headeradmin.php";?>
    <div class="admin-wrapper">
        <!-- sidebar -->
        <div class="left-sidebar">
            <ul>
                <li data-aos="fade-right"><a href="<?php echo BASE_URL . '/admin/dashboard.php'; ?> " class="s-list"><i
                            class="fa fa-home"></i>
                        Home <span style="color: gray;"> | <?php echo $_SESSION['username']; ?></span></a></li>
                <li><a href="<?php echo BASE_URL . '/admin/elists/index.php'; ?> " class="s-list active"><i
                            class="fa fa-tasks"></i> Manage
                        Events</a></li>
                <?php if ($_SESSION['admin'] == 1964): ?>
                <li data-aos="fade-right"><a href="<?php echo BASE_URL . '/admin/adminusers/index.php'; ?>"><i
                            class="fa fa-users"></i>
                        Manage
                        Users</a></li>
                <li data-aos="fade-right"><a href="<?php echo BASE_URL . '/admin/ecategories/index.php'; ?>"><i
                            class="fa fa-list-alt"></i>
                        Manage
                        Events
                        Categories</a></li>
                <?php endif;?>
            </ul>
        </div>
        <!-- admin content -->
        <div class="admin-content" style="overflow-x:hidden !important;">
            <div class="button-group">
                <a href="ecreate.php" class="btn add"><i class="fa fa-check-circle"> Add
                        Event</i></a>
                <a href="index.php" class="btn manage act-manage"><i class="fa fa-tasks"> Manage
                        Events</i></a>
                <a href="people.php" class="btn pips"><i class="fa fa-users">
                        People</i></a>
            </div>
            <div class="content">
                <h2 class="page-title">Manage Events</h2>
                <div class="tabo">
                    <div style="width: 300px; padding: .5rem;">
                        <form action="index.php" method="GET"
                            style="display:flex; align-items:center; justify-content:space-evenly;">
                            <i class="fa fa-search" style="font-size:25px;"></i>
                            <input type="text" name="search-term" id="search-term"
                                placeholder="Search Event or Admin..."
                                style="width: 70%; border:none; border-bottom:2px solid #212121; padding:.5rem; outline:none;">
                        </form>
                    </div>
                    <div class="filter">
                        <form action="index.php" method="GET" id='filterform'>
                            <div class="from">
                                <h4>From</h4>
                                <input type="date" name="from_date" id="from_date">
                            </div>
                            <div class="to">
                                <h4>to</h4>
                                <input type="date" name="to_date" id="to_date">
                            </div>
                            <div>
                                <input type="submit" id="filter" value="Filter">
                            </div>
                        </form>
                    </div>
                </div>
                <?php include ROOT_PATH . "/application/includes/messages.php";?>

                <?php if ($_SESSION['admin'] == 1964): ?>
                <div class="button" style="position: relative;left:90%;">
                    <a href="<?php echo BASE_URL . '/application/controllers/confirmation.php?clear=events'; ?>"
                        class="edit"><i class="fa fa-trash-alt"></i> Clear All</a>
                </div>
                <?php endif;?>

                <table>
                    <thead>
                        <th>ENo.</th>
                        <th style="width:190px;">Event Title</th>
                        <th>Administrator</th>
                        <th>Category</th>
                        <th>Date Posted</th>
                        <th colspan="3">Actions</th>
                    </thead>
                    <tbody>
                        <?php if (count($events) > 0): ?>
                        <?php foreach ($events as $key => $event): ?>
                        <tr>
                            <td><?php echo $key + 1; ?></td>
                            <td style="font-size:14px;"><?php echo $event['title'] ?></td>
                            <td><?php echo $event['username']; ?></td>
                            <td><?php echo $event['name']; ?></td>
                            <td><?php echo date('M j, Y', strtotime($event['created_at'])); ?></td>
                            <?php if ($event['released']): ?>
                            <td><a href="index.php?released=0&e_id=<?php echo $event['id']; ?>" class="hold">Hold</a>
                            </td>
                            <?php else: ?>
                            <td><a href="index.php?released=1&e_id=<?php echo $event['id']; ?>"
                                    class="release">Release</a>
                            </td>
                            <?php endif;?>
                            <td><a href="edit.php?id=<?php echo $event['id']; ?>" class="edit">Edit</a></td>
                            <td><a href="<?php echo BASE_URL . '/application/controllers/confirmation.php?del-event=' . $event['id']; ?>"
                                    class="delete">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach;?>

                        <?php else: ?>
                        <tr>
                            <td colspan="6">
                                <h2 class="page-title" style="color:gray ;">No Events Added Yet</h2>
                            </td>
                        </tr>
                        <?php endif;?>
                    </tbody>
                </table>
                <form action="index.php" method="POST">
                    <input type="hidden" name="cat_id" value="<?php echo $_SESSION['assignment']; ?>">
                    <button type="submit" name="download" class="btn"
                        style="font-size:16px;position:relative; top:2rem; left:5rem; padding:8px !important;"><i
                            class="fa fa-download"></i> Get a
                        Copy</button>
                </form>

            </div>

            <div class="paginationAdmin">
                <?php for ($i = 1; $i <= $total_pages; $i++) {
    if ($i == $page) {
        echo '<a class="active-page">' . $i . '</a>';
    } else {
        if (isset($_GET['search-term'])) {
            echo '<a href="' . BASE_URL . '/admin/elists/index.php?search-term=' . $_GET['search-term'] . '&page=' . $i . '' . '" class="active">' . $i . '</a>';
        } elseif (isset($_GET['from_date']) && isset($_GET['to_date'])) {
            echo '<a href="' . BASE_URL . '/admin/elists/index.php?from_date=' . $_GET['from_date'] . '&to_date=' . $_GET['to_date'] . '&page=' . $i . '' . '" class="active">' . $i . '</a>';
        } else {
            echo '<a href="' . BASE_URL . '/admin/elists/index.php?page=' . $i . '' . '" class="active">' . $i . '</a>';
        }
    }
}
?>
            </div>
        </div>
    </div>


    <script src="<?php echo BASE_URL . '/assets/bootstrap/js/jquery.min.js'; ?>"></script>
    <script src="<?php echo BASE_URL . '/assets/js/main.js'; ?>"></script>
    <script src="<?php echo BASE_URL . '/assets/js/aos-master/dist/aos.js' ?>"></script>
    <script src="<?php echo BASE_URL . '/assets/js/modal.js' ?>"></script>


    <script>
    jQuery(document).ready(function() {


        $('#filter').click(function() {
            if ($('#from_date').val() == '' && $('#to_date').val() == '') {
                alert('Please select a date');
            }
        });


        AOS.init({
            duration: 1000
        });

        $('.icon').on('click', function() {
            $('.nav').toggleClass('show');
            $('.nav ul').toggleClass('show');
        });
    });
    </script>
</body>

</html>