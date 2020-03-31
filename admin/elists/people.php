<?php include "../../path.php";?>
<?php include ROOT_PATH . "/application/controllers/events.php";
superUserAndAdmin();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Admin - People in Events</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="<?php echo BASE_URL . '/assets/fontawesome/css/all.css'; ?>" />
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo BASE_URL . '/assets/js/aos-master/dist/aos.css' ?>" />
    <link rel="stylesheet" href="<?php echo BASE_URL . '/assets/css/index.css'; ?>" />
    <link rel="stylesheet" href="<?php echo BASE_URL . '/assets/css/admin.css'; ?>" />
    <link rel="stylesheet" href="<?php echo BASE_URL . '/assets/css/people.css'; ?>" />
    <link rel="stylesheet" href="<?php echo BASE_URL . '/assets/css/modal.css' ?>" />
    <link rel="icon" href="<?php echo BASE_URL . '/assets/imgs/logofinal.png' ?>">
</head>

<body>
    <?php include ROOT_PATH . "/application/includes/headeradmin.php";?>
    <div class="admin-wrapper">
        <!-- sidebar -->
        <div class="left-sidebar">
            <ul>
                <li><a href="<?php echo BASE_URL . '/admin/dashboard.php'; ?> " class="s-list"><i
                            class="fa fa-home"></i>
                        Home <span style="color: gray;"> | <?php echo $_SESSION['username']; ?></span></a></li>
                <li><a href="<?php echo BASE_URL . '/admin/elists/index.php'; ?> " class="s-list active"><i
                            class="fa fa-tasks"></i> Manage
                        Events</a></li>

                          <?php if($_SESSION['admin']==1964):?>
                <li><a href="<?php echo BASE_URL . '/admin/adminusers/index.php'; ?>"><i class="fa fa-users"></i>
                        Manage
                        Users</a></li>
                <li><a href="<?php echo BASE_URL . '/admin/ecategories/index.php'; ?>" class="s-list"><i
                            class="fa fa-list-alt"></i>
                        Manage
                        Events
                        Categories</a></li>
                          <?php endif;?>
            </ul>
        </div>
        <!-- admin content -->
        <div class="admin-content">
            <div class="button-group">
                <a href="ecreate.php" class="btn add"><i class="fa fa-check-circle"> Add
                        Event</i></a>
                <a href="index.php" class="btn manage"><i class="fa fa-clipboard-check"> Manage
                        Events</i></a>
                <a href="people.php" class="btn pips act-pips"><i class="fa fa-users">
                        People</i></a>
            </div>

            <div class="content">
                <?php include ROOT_PATH . "/application/includes/messages.php";?>

                <h2 class="page-title">People in Events</h2>
                <div class="tab-container">
                    <?php foreach ($categories as $key => $category): ?>
                    <?php if ($key == 0): ?>
                    <div id="tab-<?php echo $key + 1; ?>" class="tabs tab-act">
                        <?php echo $category['name']; ?>
                    </div>
                    <?php else: ?>
                    <div id="tab-<?php echo $key + 1; ?>" class="tabs">
                        <?php echo $category['name']; ?>
                    </div>
                    <?php endif;?>
                    <?php endforeach;?>
                </div>



                        <!-- first tab -->
                <?php foreach ($categories as $key => $category): ?>
                <?php if ($key == 0): ?>
                <div id="tab-<?php echo $key + 1; ?>-content" class="tables table-show">
                    <table>
                        <thead style="font-size: 16px;">
                            <th>Ticket No.</th>
                            <th>Name</th>
                            <th>Course</th>
                            <th>Student Number</th>
                            <th>Event Title</th>
                            <th>Date Joined</th>
                        </thead>
                        <?php $id = $category['id'];
$people = people($id);
?>
                        <?php foreach ($people as $key => $individual): ?>
                        <tbody>
                            <tr>
                                <td><?php echo $individual['ticket']; ?></td>
                                <td><?php echo $individual['username']; ?></td>
                                <td><?php echo $individual['course']; ?></td>
                                <td><?php echo $individual['stdnt_num']; ?></td>
                                <td style="width:200px;"><?php echo $individual['title']; ?></td>
                                <td><?php echo date('M j,Y - h:i:s a', strtotime($individual['joined_at'])); ?></td>
                            </tr>
                        </tbody>
                        <?php endforeach;?>
                    </table>
                    <div class=" button">
                        <a href="<?php echo BASE_URL . '/application/controllers/confirmation.php?del-id=' . $category['id']; ?>"
                            class="edit"> <i class="fa fa-trash"></i>
                            Clear List</a>
                    </div>
                    <div class="button" style="left:77%!important;">
                        <a href="<?php echo BASE_URL . '/application/controllers/confirmation.php?alter=people'; ?>"
                            class="edit"><i class="fa fa-trash-alt"></i> Clear All</a>
                    </div>
                </div>


                            <!-- second tab -->

                <?php else: ?>
                <div id="tab-<?php echo $key + 1; ?>-content" class="tables">
                    <table>
                        <thead style="font-size: 16px;">
                            <th>Ticket No.</th>
                            <th>Name</th>
                            <th>Course</th>
                            <th>Student Number</th>
                            <th>Event Title</th>
                            <th>Date Joined</th>
                        </thead>
                        <?php $id = $category['id'];
$people = people($id);
?>
                        <?php foreach ($people as $key => $individual): ?>
                        <tbody>
                            <tr>
                                <td><?php echo $individual['ticket']; ?></td>
                                <td><?php echo $individual['username']; ?></td>
                                <td><?php echo $individual['course']; ?></td>
                                <td><?php echo $individual['stdnt_num']; ?></td>
                                <td style="width:200px;"><?php echo $individual['title']; ?></td>
                                <td><?php echo date('M j,Y - h:i:s a', strtotime($individual['joined_at'])); ?></td>
                            </tr>
                        </tbody>
                        <?php endforeach;?>
                    </table>
                    <div class="button">
                        <a href="<?php echo BASE_URL . '/application/controllers/confirmation.php?del-id=' . $category['id']; ?>"
                            class="edit"> <i class="fa fa-trash"></i>
                            Clear List</a>
                    </div>
                    <div class="button" style="left:77%!important;">
                        <a href="<?php echo BASE_URL . '/application/controllers/confirmation.php?alter=people'; ?>"
                            class="edit"><i class="fa fa-trash-alt"></i> Clear All</a>
                    </div>
                </div>
                <?php endif;?>
                <?php endforeach;?>
            </div>

        </div>
    </div>


    <script src="<?php echo BASE_URL . '/assets/bootstrap/js/jquery.min.js'; ?>"></script>
    <script src="<?php echo BASE_URL . '/assets/js/main.js'; ?>"></script>
    <script src="<?php echo BASE_URL . '/assets/js/aos-master/dist/aos.js' ?>"></script>
    <script src="<?php echo BASE_URL . '/assets/js/modal.js' ?>"></script>


    <script>
    jQuery(document).ready(function() {
        const tabs = document.querySelectorAll(".tabs");
        const tables = document.querySelectorAll(".tables");

        function borderAct(e) {
            inact();
            removeShow();
            this.classList.add("tab-act");
            // grab all tables
            const tabContent = document.querySelector(`#${this.id}-content`);
            tabContent.classList.add('table-show');

        }

        function inact() {
            tabs.forEach(tab => tab.classList.remove("tab-act"));
        }

        function removeShow() {
            tables.forEach(table => table.classList.remove("table-show"));
        }

        tabs.forEach(tab => tab.addEventListener("click", borderAct));
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