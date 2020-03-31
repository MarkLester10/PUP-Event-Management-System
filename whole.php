<?php
include "path.php";
include ROOT_PATH . "/application/controllers/category.php";
usersOnly();
$date = date('Y-m-d');
$events = getReleasedEvents();
if (isset($_GET['event-id'])) {
    $id = $_GET['event-id'];
    $selectedEvent = selectOne('events', ['id' => $id]);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Event - Description</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="assets/fontawesome/css/all.css" />
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/index.css" />
    <link rel="stylesheet" href="assets/css/description.css" />
    <link rel="stylesheet" href="assets/js/aos-master/dist/aos.css" />
    <link rel="icon" href="<?php echo BASE_URL . '/assets/imgs/logofinal.png' ?>">
</head>

<body>
    <?php include ROOT_PATH . "/application/includes/header.php";?>
    <!-- decription content -->
    <a href="#"><i class="fa fa-arrow-circle-up Arrow"></i></a>
    <div class="desc-content clearfix">
        <div class="desc-main-content single">
            <h1 data-aos="zoom-in" data-aos-delay="100" class="e-title"><?php echo $selectedEvent['title']; ?>
                <br><span
                    style='color:#E91E63; font-style: italic; font-size:12px;'><?php echo date("M d, Y", strtotime($selectedEvent['eventday'])) ?></span>
            </h1>
            <img src="<?php echo BASE_URL . '/assets/imgs/eventsimgs/' . $selectedEvent['image']; ?>"
                alt="event-imagee">
            <div class="d-content">
                <?php echo nl2br(html_entity_decode($selectedEvent['description'])); ?>
            </div>


            <?php if ($selectedEvent['raffleSystem']): ?>
            <?php if (date("Y-m-d", strtotime($selectedEvent['eventday'])) < $date): ?>
            <div class="ticket">
                <div>
                    <p>Raffle has ended, thank you to all participants!</p>
                </div>
            </div>
            <?php elseif ($date != date("Y-m-d", strtotime($selectedEvent['eventday']))): ?>
            <div class="ticket">
                <div>
                    <p>Raffle will be available soon!</p>
                </div>
            </div>
            <?php else: ?>
            <div class="ticket">
                <div>
                    <p>Join our Raffle Now!</p>
                    <p>We have exciting prizes</p>
                    <a href="puptickets.php?event-id=<?php echo $selectedEvent['id']; ?>" class="ticket-btn">Join
                        Now</a>
                </div>
                <div>
                    <h4>How to Join?</h4>
                    <ul>
                        <li><img src="<?php echo BASE_URL . '/assets/imgs/gif/tap.gif'; ?>" alt="tap">Click Join
                            Now
                            Button</li>
                        <li><img src="<?php echo BASE_URL . '/assets/imgs/gif/eye.gif'; ?>" alt="tap">Read the
                            Terms and
                            Conditions</li>
                        <li><img src="<?php echo BASE_URL . '/assets/imgs/gif/tap.gif'; ?>" alt="tap">Click Try my
                            Luck
                            Now
                            Button</li>
                        <li><img src="<?php echo BASE_URL . '/assets/imgs/gif/document.gif'; ?>" alt="tap">Fill out the
                            form</li>
                        <li><img src="<?php echo BASE_URL . '/assets/imgs/gif/download.gif'; ?>" alt="tap">Click
                            Join Raffle
                            Button</li>
                        <li><img src="<?php echo BASE_URL . '/assets/imgs/gif/tea.gif'; ?>" alt="tap">Wish you Luck!
                        </li>
                    </ul>
                </div>
            </div>

            <?php endif;?>
            <?php endif;?>


        </div>

        <!-- sidebar -->
        <div class="side-bar single">
            <div class="sect popular" data-aos="fade-up" data-aos-easing="ease">
                <div class="section-title" data-aos="slide-right" data-aos-delay="400">
                    Our Popular Events</div>

                <!-- data-aos="fade-left" data-aos-delay="200" -->
                <?php foreach ($events as $event): ?>
                <div class="post clearfix">

                    <img src="<?php echo BASE_URL . '/assets/imgs/eventsimgs/' . $event['image']; ?>" alt="alt">
                    <a href="<?php echo BASE_URL . '/whole.php?event-id=' . $event['id']; ?>" class="title">
                        <div class="pamagat">
                            <h4><?php echo nl2br(substr($event['title'], 0, 40) . ' ...'); ?></h4>
                        </div>
                    </a>

                    <?php if (date("Y-m-d", strtotime($event['eventday'])) > $date): ?>
                    <h5 class="tag">Upcoming</h5>
                    <?php elseif (date("Y-m-d", strtotime($event['eventday'])) == $date): ?>
                    <h5 class="tag1">Today</h5>
                    <?php endif;?>
                </div>
                <?php endforeach;?>

            </div>
            <div class="sect topic">
                <div class="section-title" style="border-bottom: 1px solid #747272; padding-bottom:.5rem;"> <i
                        class="fa fa-list-alt"></i> Categories
                </div>
                <ul>
                    <?php if (count($categories) > 0): ?>
                    <?php foreach ($categories as $key => $category): ?>
                    <li data-aos="fade-up"><a
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
    </div>

    <?php include ROOT_PATH . "/application/includes/footer.php";?>


    <script src="assets/bootstrap/js/jquery.min.js"></script>
    <script src="assets/js/main.js"></script>

    <!-- slick carousel -->
    <script src="assets/js/slick/slick.min.js"></script>
    <!-- animate on scroll -->
    <script src="assets/js/aos-master/dist/aos.js"></script>
    <script>
    $('.icon').on('click', function() {
        $('.nav').toggleClass('show');
        $('.nav ul').toggleClass('show');
    });

    AOS.init({
        duration: 1000
    });
    </script>
</body>

</html>