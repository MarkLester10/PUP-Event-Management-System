<?php include "path.php";?>
<?php include ROOT_PATH . "/application/controllers/category.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>PUP Events</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo BASE_URL . '/assets/css/index.css' ?>" />
    <link rel="stylesheet" href="<?php echo BASE_URL . '/assets/css/modal.css' ?>" />
    <link rel="stylesheet" href="<?php echo BASE_URL . '/assets/fontawesome/css/all.css' ?>" />
    <link rel="stylesheet" href="<?php echo BASE_URL . '/assets/js/aos-master/dist/aos.css' ?>" />
    <link rel="stylesheet" href="<?php echo BASE_URL . '/assets/css/owl.carousel.min.css' ?>" />
    <link rel="stylesheet" href="<?php echo BASE_URL . '/assets/inc/TimeCircles.css' ?>" />
    <link rel="icon" href="<?php echo BASE_URL . '/assets/imgs/logofinal.png' ?>">
</head>

<body>

    <?php include ROOT_PATH . "/application/includes/header.php";?>

    <!-- message modal -->
    <?php include ROOT_PATH . "/application/includes/messages.php";?>

    <main>
        <!--POST SLIDER SECTION-->
        <a href="#"><i class="fa fa-arrow-circle-up Arrow"></i></a>

        <section>
            <div class="page-wrapper" data-aos="fade-down">
                <div class="post-slider">
                    <h1 class=" slider-title" data-aos="fade-up" data-aos-delay="500"><?php echo $unangTitle; ?>
                    </h1>
                    <i class="fas fa-chevron-right prev"></i>
                    <i class="fas fa-chevron-left next"></i>
                    <div class="post-wrapper">

                        <!-- INDIVIDUAL EVENTS -->
                        <?php foreach ($upcomingEvents as $upcomingevent): ?>
                        <div class="post">

                            <img src="<?php echo BASE_URL . '/assets/imgs/eventsimgs/' . $upcomingevent['image'] ?>"
                                alt="event image" class="slider-img" />
                            <div class="post-info">
                                <h4>
                                    <a
                                        href="<?php echo BASE_URL . '/whole.php?event-id=' . $upcomingevent['id']; ?>"><?php echo $upcomingevent['title']; ?></a>
                                </h4>
                                <i class="far fa-user"> <?php echo $upcomingevent['username']; ?></i>
                                &nbsp;
                                <i class="far fa-sticky-note">
                                    <?php echo date("M j, Y D g:i A", strtotime($upcomingevent['eventday'])); ?></i>
                            </div>
                        </div>
                        <?php endforeach;?>

                    </div>
                </div>
            </div>
        </section>

        <!-- today -->
        <?php if(count($TodayEvents) > 0 || $nextEvent):?>
        <div class="post-slider today" style="height:95vh; margin-top:-100px;">
            <h1 class="slider-title" style="top: 3rem; color: #fff;"><?php echo $ikatlongTitle; ?>
            </h1>

            <i class="fas fa-chevron-right prev" style=" top:60%; font-size: 30px;   color: #fff;"></i>
            <i class="fas fa-chevron-left next" style=" top:60%; font-size: 30px;   color: #fff; "></i>
            <div class="post-wrapper" style="margin:0 auto; position:relative; top: .7rem;">

                <!-- INDIVIDUAL EVENTS -->
                <?php if (count($TodayEvents) === 0): ?>
                <div id="CountDown" data-date="<?php echo $nextEvent['eventday']; ?>"></div>
                <?php else: ?>
                <?php foreach ($TodayEvents as $todayevent): ?>
                <div class="post">

                    <img src="<?php echo BASE_URL . '/assets/imgs/eventsimgs/' . $todayevent['image'] ?>"
                        alt="event image" class="slider-img" />
                    <div class="post-info">
                        <h4>
                            <a
                                href="<?php echo BASE_URL . '/whole.php?event-id=' . $todayevent['id']; ?>"><?php echo $todayevent['title']; ?></a>
                        </h4>
                        <i class="far fa-user"> <?php echo $todayevent['username']; ?></i>
                        &nbsp;
                        <i class="far fa-sticky-note">
                            <?php echo date("M j, Y D g:i A", strtotime($todayevent['eventday'])); ?></i>
                    </div>
                </div>

                <?php endforeach;?>
                <?php endif;?>
            </div>
        </div>
        <?php endif;?>
        <!-- MAIN CONTENT SECTION -->
        <section id="content">
            <div class="service">
                <div class="section search">
                    <h2 class="section-title"><i class="fa fa-search-plus"></i> Find Your Events</h2>
                    <form action="index.php" method="GET">
                        <input type="text" name="search" class="text-input" required>
                        <label>Search</label>
                    </form>
                </div>

                <div class="section topics">
                    <h2 class="section-title"><i class="fa fa-list-alt"></i> Categories</h2>
                    <ul>
                        <?php if (count($categories) > 0): ?>
                        <?php foreach ($categories as $key => $category): ?>
                        <li><a
                                href="<?php echo BASE_URL . '/index.php?c_id=' . $category['id'] ?>&name=<?php echo $category['name']; ?>">
                                <?php echo $category['name']; ?>
                            </a>
                        </li>
                        <?php endforeach;?>
                        <?php else: ?>

                        <h1 style="width:300px; color:gray; font-size:16px;">No Categories Yet
                        </h1>

                        <?php endif;?>
                    </ul>
                </div>
            </div>

            <h1 class="recent-events-title"><?php echo $pangalawangTitle; ?></h1>

            <div class="content">
                <div class="main-content">
                    <!-- INDIVIDUAL EVENTS -->
                    <?php foreach ($events as $event): ?>

                    <div class="post" data-aos="fade-up" data-aos-duration="400">

                        <?php if (date("Y-m-d", strtotime($event['eventday'])) > $date): ?>
                        <h4 class="tag">UPCOMING</h4>
                        <h4 class="tag3"><?php echo date("M d", strtotime($event['eventday'])); ?></h4>
                        <?php elseif (date("Y-m-d", strtotime($event['eventday'])) === $date): ?>
                        <h4 class="tag4">Today</h4>
                        <?php else: ?>
                        <h4 class="tag2">RECENT</h4>
                        <?php endif;?>

                        <div class="image-post">
                            <img src="<?php echo BASE_URL . '/assets/imgs/eventsimgs/' . $event['image']; ?>" alt="post"
                                class="post-img">
                            <?php if ($event['raffleSystem'] && date("Y-m-d", strtotime($event['eventday'])) >= $date): ?>
                            <div class="post-s">
                                <a href="<?php echo BASE_URL . '/puptickets.php?event-id=' . $event['id']; ?>">Join Our
                                    Raffle</a>
                            </div>
                            <?php endif;?>
                        </div>
                        <div class="post-preview">
                            <h1><a
                                    href="<?php echo BASE_URL . '/whole.php?event-id=' . $event['id']; ?>"><?php echo nl2br($event['title']); ?></a>
                            </h1>
                            <i class="far fa-user">&nbsp;<?php echo $event['username']; ?></i>
                            &nbsp;
                            <i
                                class="far fa-calendar">&nbsp;<?php echo date("M j, Y l", strtotime($event['eventday'])); ?></i>
                            <p class="preview-text">
                                <?php echo nl2br(html_entity_decode(substr($event['description'], 0, 215) . '. . .')); ?>
                            </p>
                            <a href="<?php echo BASE_URL . '/whole.php?event-id=' . $event['id']; ?>" class="btn">Read
                                More</a>
                        </div>
                    </div>
                    <?php endforeach;?>
                    <div class="pagination">
                        <?php for ($i = 1; $i <= $total_pages; $i++) {
    if ($i == $page) {
        echo '<a class="active-page">' . $i . '</a>';
    } else {
        if (isset($_GET['c_id']) and $_GET['name']) {
            echo '<a href="' . BASE_URL . '/?c_id=' . $_GET['c_id'] . '&name=' . $_GET['name'] . '&page=' . $i . '' . '" class="active">' . $i . '</a>';
        } elseif (isset($_GET['search'])) {
            echo '<a href="' . BASE_URL . '/?search=' . $_GET['search'] . '&page=' . $i . '' . '" class="active">' . $i . '</a>';
        } else {
            echo '<a href="' . BASE_URL . '/?page=' . $i . '' . '" class="active">' . $i . '</a>';
        }
    }
}
?>
                    </div>
                </div>
            </div>

        </section>



        <!-- about -->
        <section id="about" class="testimonial bg-lightred">
            <h1 style="color:#212121;">People Love Our Events</h1>
            <div class="container">
                <div class="test-caro owl-carousel">

                    <?php foreach ($comments as $comment): ?>
                    <div class="single-tst">
                        <img src="assets/imgs/quote.png" alt="" />
                        <p>
                            <?php echo nl2br($comment['comment']); ?>
                        </p>

                        <div class="client-info">
                            <img src="<?php echo BASE_URL . "/application/controllers/userimage/" . $comment['image'] ?>"
                                alt="" class="thumb" />
                            <p><?php echo $comment['username']; ?>, <span><?php echo $comment['role'] ?></span></p>
                        </div>
                    </div>

                    <?php endforeach;?>

                </div>
            </div>
        </section>
        <!-- Testimonial section end -->



        <!-- <?php include ROOT_PATH . "/loader.php";?> -->
    </main>
    <?php include ROOT_PATH . "/application/includes/footer.php";?>


    <script src="<?php echo BASE_URL . '/assets/bootstrap/js/jquery.min.js' ?>"></script>
    <script src="<?php echo BASE_URL . '/assets/js/main.js' ?>"></script>
    <script src="<?php echo BASE_URL . '/assets/js/modal.js' ?>"></script>

    <!-- slick carousel -->
    <script src="<?php echo BASE_URL . '/assets/js/slick/slick.min.js' ?>"></script>
    <!-- animate on scroll -->
    <script src="<?php echo BASE_URL . '/assets/js/aos-master/dist/aos.js' ?>"></script>
    <script src="<?php echo BASE_URL . '/assets/js/owl.carousel.min.js' ?>"></script>
    <script src="<?php echo BASE_URL . '/assets/inc/TimeCircles.js' ?>"></script>
    <script>
    $('#CountDown').TimeCircles({
        "animation": "smooth",
        "circle_bg_color": "#455A64",
        "time": {
            "Days": {
                "color": "#FFF176"
            },
            "Hours": {
                "color": "#69F0AE"
            },
            "Minutes": {
                "color": "rgba(239, 83, 80, 1)"
            },
            "Seconds": {
                "color": "#fff"
            }
        }
    });

    AOS.init({
        duration: 1000
    });
    </script>
</body>

</html>