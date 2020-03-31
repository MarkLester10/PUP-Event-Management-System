<?php include "../../path.php";?>
<?php include ROOT_PATH . "/application/controllers/users.php";
adminOnly();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Admin - Manage Users</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="../../assets/fontawesome/css/all.css" />
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="../../assets/css/index.css" />
    <link rel="stylesheet" href="../../assets/css/admin.css" />
    <link rel="stylesheet" href="<?php echo BASE_URL . '/assets/js/aos-master/dist/aos.css' ?>" />
    <link rel="stylesheet" href="<?php echo BASE_URL . '/assets/css/modal.css' ?>" />
    <link rel="stylesheet" href="<?php echo BASE_URL . '/assets/css/useradmin.css'; ?>" />
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
                <li data-aos="fade-right"><a href="<?php echo BASE_URL . '/admin/elists/index.php'; ?> "
                        class="s-list"><i class="fa fa-tasks"></i> Manage
                        Events</a></li>

                        <?php if($_SESSION['admin']==1964):?>
                <li><a href="<?php echo BASE_URL . '/admin/adminusers/index.php'; ?>" class="s-list active"><i
                            class="fa fa-users"></i>
                        Manage
                        Users</a></li>
                <li data-aos="fade-right"><a href="<?php echo BASE_URL . '/admin/ecategories/index.php'; ?>"
                        class="s-list"><i class="fa fa-list-alt"></i>
                        Manage
                        Events
                        Categories</a></li>
                        <?php endif;?>
            </ul>
        </div>
        <!-- admin content -->
        <div class="admin-content">
            <div class="button-group">
                <a href="ucreate.php" class="btn add"><i class="fa fa-check-circle"> Add User</i></a>
                <a href="index.php" class="btn manage act-manage"><i class="fa fa-users"> Manage Users</i></a>
            </div>

            <div class="content">
                <h2 class="page-title">Manage Users</h2>
                <?php include ROOT_PATH . "/application/includes/messages.php";?>
                <div class="tab-container" style="width:100%; margin:0 auto;">
                    <div id="TAB-1" class="tabs tab-act">Administrators</div>
                    <div id="TAB-2" class="tabs">Students</div>
                </div>
                <div id="TAB-1-CONTENT" class="TABLE table-show">
                    <table>
                        <thead>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th colspan="2">Actions</th>
                        </thead>
                        <tbody>
                            <?php foreach ($usersAdmin as $key => $user): ?>
                            <tr>
                                <td><?php echo $key + 1; ?></td>
                                <td><?php echo $user['username']; ?></td>
                                <td><?php echo $user['email']; ?></td>
                                <td><a href="edit.php?e-id=<?php echo $user['id']; ?>" class="edit">Edit</a></td>
                                <td><a href="<?php echo BASE_URL . '/application/controllers/confirmation.php?del-user=' . $user['id']; ?>"
                                        class="delete">Delete</a></td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>

                <div id="TAB-2-CONTENT" class="TABLE">
                    <table>
                        <thead>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th colspan=" 2">Actions</th>
                        </thead>
                        <?php if (count($usersStudents) === 0): ?>
                        <tbody>
                            <td colspan="4">
                                <h2 class="page-title" style="color:gray ;">No Student Users Yet</h2>
                            </td>
                        </tbody>
                        <?php else: ?>
                        <?php foreach ($usersStudents as $key => $user): ?>
                        <tbody>
                            <tr>
                                <td><?php echo $key + 1; ?></td>
                                <td><?php echo $user['username']; ?></td>
                                <td><?php echo $user['email']; ?></td>
                                <td><a href="edit.php?e-id=<?php echo $user['id']; ?>" class="edit">Edit</a></td>
                                <td><a href="<?php echo BASE_URL . '/application/controllers/confirmation.php?del-user=' . $user['id']; ?>"
                                        class="delete">Delete</a></td>
                            </tr>
                        </tbody>
                        <?php endforeach;?>
                        <?php endif;?>
                    </table>
                </div>
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
        const tables = document.querySelectorAll(".TABLE");

        function borderAct(e) {
            inact();
            removeShow();
            this.classList.add("tab-act");
            // grab all tables
            const tabContent = document.querySelector(`#${this.id}-CONTENT`);
            tabContent.classList.add('table-show');

        }

        function inact() {
            tabs.forEach(tab => tab.classList.remove("tab-act"));
        }

        function removeShow() {
            tables.forEach(table => table.classList.remove("table-show"));
        }
        tabs.forEach(tab => tab.addEventListener("click", borderAct));


        //adnimation
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