<?php include "../path.php";?>
<?php include ROOT_PATH . "/application/controllers/events.php";
superUserAndAdmin();

$hStatus = 0;
$holdComments = getComments($hStatus);
$rStatus = 1;
$comments = getComments($rStatus);

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
    <link rel="stylesheet" href="<?php echo BASE_URL . '/assets/css/modal.css' ?>" />
    <link rel="stylesheet" href="<?php echo BASE_URL . '/assets/css/admin.css'; ?>" />
    <link rel="stylesheet" href="<?php echo BASE_URL . '/assets/css/useradmin.css'; ?>" />
    <link rel="stylesheet" href="<?php echo BASE_URL . '/assets/css/calendar/dycalendar.min.css'; ?>" />
    <link rel="icon" href="<?php echo BASE_URL . '/assets/imgs/logofinal.png' ?>">
</head>

<body>
    <?php include ROOT_PATH . "/application/includes/headeradmin.php";?>
    <div class="admin-wrapper">
        <!-- sidebar -->

        <?php if ($_SESSION['admin'] == 1964): ?>
        <div id="circle" class="circle">
            <i class="fa fa-mail-bulk"><a href="#"><span><?php echo count($holdComments) ?></span></a></i>
        </div>
        <?php endif;?>


        <div class="left-sidebar">
            <ul>
                <li data-aos="fade-right"><a href="<?php echo BASE_URL . '/admin/dashboard.php'; ?> "
                        class="s-list active"><i class="fa fa-home"></i>
                        Home <span style="color:#90CAF9;"> | <?php echo $_SESSION['username']; ?></span></a></li>
                <li data-aos="fade-right" data-aos-delay="100"><a href="<?php echo BASE_URL . '/admin/elists/'; ?> "
                        class="s-list"><i class="fa fa-tasks"></i> Manage
                        Events</a></li>

                <?php if ($_SESSION['admin'] == 1964): ?>
                <li data-aos="fade-right" data-aos-delay="200"><a
                        href="<?php echo BASE_URL . '/admin/adminusers/'; ?>"><i class="fa fa-users"></i>
                        Manage
                        Users</a></li>
                <li data-aos="fade-right" data-aos-delay="300"><a
                        href="<?php echo BASE_URL . '/admin/ecategories/'; ?>"><i class="fa fa-list-alt"></i>
                        Manage
                        Events
                        Categories</a></li>
                <?php endif;?>
            </ul>
            <div style="position:relative; left:35%; bottom:5%;" data-aos="fade-up" data-aos-delay="600">
                <div id="dycalendar-today-with-skin-shadow" class="dycalendar-container skin-black shadow-default">
                </div>
            </div>
        </div>

        <!-- admin content -->
        <?php include ROOT_PATH . "/application/includes/messages.php";?>
        <div class="admin-content" style=" padding: 20px 10px 20px;">
            <div class="monitor-container">
                <div class="monitor">
                    <div data-aos="zoom-in">
                        <h3 style="color: rgb(95, 204, 128) !important;">Event</h3>
                        <div id="events" style="font-size: 25px;">
                        </div>
                    </div>

                    <div data-aos="zoom-in" data-aos-delay="100">
                        <h3 style="color: rgba(239, 83, 80, 1) !important;">Category</h3>
                        <div id="category" style="font-size: 25px;">
                        </div>
                    </div>


                    <div data-aos="zoom-in" data-aos-delay="200">
                        <h3 style="color: rgb(142, 197, 211);">Administrator</h3>
                        <div id="admin" style="font-size: 25px;">
                        </div>
                    </div>

                    <div data-aos="zoom-in" data-aos-delay="300">
                        <h3 style=" color: #919090;">Student</h3>
                        <div id="student" style="font-size: 25px;">
                        </div>
                    </div>
                </div>
                <div class="calendar">
                    <div id="dycalendar-month-prev-next-button" class="dycalendar-container skin-green shadow-default">
                    </div>
                </div>
            </div>

            <div class="table-container">
                <h2 class="page-title">Administrators</h2>
                <table>
                    <thead>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Posts</th>
                    </thead>
                    <tbody id="administrators">

                    </tbody>
                </table>
            </div>
        </div>

        <!-- accordion -->

        <div class="accordion-container">

            <div class="accordion">
                <h1>Feedback</h1>


                <div class="tab-container" style="width:100%; margin:0 auto;">
                    <div id="TAB-1" class="tabs tab-act">Hold</div>
                    <div id="TAB-2" class="tabs">Released</div>
                </div>


                <div id="TAB-2-CONTENT" class="TABLE">
                    <?php foreach ($comments as $rCmts): ?>
                    <div class="accordion-item">
                        <div class="item-header">
                            <img src="<?php echo BASE_URL . '/application/controllers/userimage/' . $rCmts['image'] ?>"
                                alt="">
                            <h3 class="title">
                                <?php echo $rCmts['username'] ?>,
                                <span style="font-size: 16px!important; font-style:italic;">
                                    <?php echo $rCmts['role'] ?></span>
                            </h3>
                            <div class="icon2"></div>
                        </div>
                        <div class="text">
                            <p>
                                <?php echo nl2br($rCmts['comment']); ?>
                            </p>
                            <div class="msgactions">
                                <a href="dashboard.php?state=0&cId=<?php echo $rCmts['id'] ?>" class="hold">Hold</a>
                                <a href="dashboard.php?delete-comment=<?php echo $rCmts['id'] ?>"
                                    class="delete">Delete</a>
                            </div>
                        </div>
                    </div>

                    <?php endforeach;?>



                </div>


                <div id="TAB-1-CONTENT" class="TABLE table-show">

                    <?php foreach ($holdComments as $hCmts): ?>


                    <div class="accordion-item">
                        <div class="item-header">
                            <img src="<?php echo BASE_URL . '/application/controllers/userimage/' . $hCmts['image'] ?>"
                                alt="">
                            <h3 class="title">
                                <?php echo $hCmts['username'] ?>,
                                <span style="font-size: 16px!important; font-style:italic;">
                                    <?php echo $hCmts['role'] ?></span>
                            </h3>
                            <div class="icon2"></div>
                        </div>
                        <div class="text">
                            <p>
                                <?php echo nl2br($hCmts['comment']); ?>
                            </p>
                            <div class="msgactions">
                                <a href="dashboard.php?state=1&cId=<?php echo $hCmts['id'] ?>"
                                    class="release">Release</a>
                                <a href="dashboard.php?delete-comment=<?php echo $hCmts['id'] ?>"
                                    class="delete">Delete</a>
                            </div>
                        </div>
                    </div>

                    <?php endforeach;?>

                </div>



            </div>
        </div>





    </div>








    <script src="<?php echo BASE_URL . '/assets/bootstrap/js/jquery.min.js'; ?>"></script>
    <script src="<?php echo BASE_URL . '/assets/js/main.js'; ?>"></script>
    <script src="<?php echo BASE_URL . '/assets/js/aos-master/dist/aos.js' ?>"></script>
    <script src="<?php echo BASE_URL . '/assets/js/modal.js' ?>"></script>
    <script src="<?php echo BASE_URL . '/assets/js/calendarjs/dycalendar-jquery.min.js' ?>"></script>
    <script src="<?php echo BASE_URL . '/assets/js/calendarjs/default.js' ?>"></script>


    <script>
    jQuery(document).ready(function() {
        // realtime administrator posts count


        setInterval(function() {
            $('#administrators').load(
                '../application/controllers/ajax/administratorRealtime.php');
        }, 300);


        // realtime event count
        setInterval(function() {
            $('#events').load('../application/controllers/ajax/eventsMonitoring.php');
        }, 300);

        // realtime category count
        setInterval(function() {
            $('#category').load('../application/controllers/ajax/categoryMonitoring.php');
        }, 300);

        // realtime student count
        setInterval(function() {
            $('#student').load('../application/controllers/ajax/studentMonitoring.php');
        }, 300);

        // realtime admin count
        setInterval(function() {
            $('#admin').load('../application/controllers/ajax/adminCount.php');
        }, 300);

        // tabs
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

        AOS.init({
            duration: 1000
        });

        $('.icon').on('click', function() {
            $('.nav').toggleClass('show');
            $('.nav ul').toggleClass('show');
        });



        // accordion
        $(".item-header").click(function() {
            // $(".accordion-item").removeClass("expand");
            $(this).parent().toggleClass("expand");
            $(this).children(".icon2").toggleClass("change");
        })



        // modal
        const circle = document.querySelector(".circle");
        const accord = document.querySelector(".accordion-container");
        circle.addEventListener("click", openModal);
        window.addEventListener("click", clearMessagesModal);


        function openModal() {
            accord.style.display = "block";
        }

        function clearMessagesModal(e) {
            if (e.target === accord) {
                accord.style.display = "none";
            }
        }
    });
    </script>
</body>

</html>