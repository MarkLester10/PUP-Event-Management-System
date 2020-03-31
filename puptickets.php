<?php
include "path.php";

include ROOT_PATH . "/application/controllers/ticketgen.php";

usersOnly();
$date = date('Y-m-d');
if (!$withRaffle || empty($_GET['event-id']) || date("Y-m-d", strtotime($eventDate)) < $date || date("Y-m-d", strtotime($eventDate)) != $date) {
    $_SESSION['welcome-message'] = 'Raffle will be available soon!';
    header("Location: " . BASE_URL . '/index.php');
    exit(0);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PUP-E Tickets</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo BASE_URL . '/assets/fontawesome/css/all.css' ?>" />
    <link rel="stylesheet" href="<?php echo BASE_URL . '/assets/css/ticket.css' ?>" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>

    <div class="modal fade" id="ticket-form-modal">
        <div class="modal-dialog modal-md">
            <div class="modal-content modal-style">
                <img src="<?php echo BASE_URL . '/assets/imgs/logofinal.png' ?>" alt="logo" />
                <div class="modal-header text-white border-0">
                    <h5>Do you think it's your lucky Day?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="color: #212121;">&times;</span>
                    </button>
                </div>

                <div class="modal-body pt-0 pb-0">
                    <form action="puptickets.php" class="form-style" method="POST">
                        <div class="form-group has-success">
                            <label class="text-uppercase">
                                Ticket Number
                            </label>
                            <input type="hidden" name="cat_id" value="<?php echo $eventCatId; ?>">
                            <input type="text" class="form-control" required placeholder="PUP-E XXX-XXX-X" name="ticket"
                                style="color: rgb(16, 173, 97)!important;">
                        </div>

                        <div class="form-group has-success">
                            <!-- <label class="text-uppercase">
                                Event Title
                            </label> -->
                            <input type="hidden" class="form-control" name="event_id" value="<?php echo $eventId; ?>"
                                style="color: rgb(16, 173, 97) !important;">
                        </div>

                        <div class="form-group has-success">
                            <input type="hidden" class="form-control" name="name" value="<?php echo $_SESSION['id'] ?>">
                        </div>

                        <div class="form-group has-success">
                            <label class="text-uppercase">
                                Student Number
                            </label>
                            <input type="text" class="form-control" placeholder="0000 00000-XX-0" name="stdnt_num"
                                required>
                        </div>

                        <div class="form-group has-success">
                            <label class="text-uppercase">
                                Address
                            </label>
                            <textarea class="form-control address" placeholder="Your full address here..."
                                name="address" required></textarea>
                        </div>

                        <div class="form-group has-success">
                            <label class="text-uppercase">
                                Course
                            </label>
                            <select name="course" class="form-control" required>
                                <option value=""></option>
                                <option value="BSEE">BSEE</option>
                                <option value="BSIE">BSIE</option>
                                <option value="BSECE">BSECE</option>
                                <option value="BSIT">BSIT</option>
                                <option value="DICT">DICT</option>
                                <option value="BSA">BSA</option>
                                <option value="BSP">BSP</option>
                                <option value="BSENT">BSENT</option>
                                <option value="COED">COED</option>

                            </select>
                        </div>

                        <div class="actions">
                            <a class="btn" data-dismiss="modal">Cancel</a>
                            <button type="submit" name="download-btn" class="btn btn-success">Join Raffle</button>
                        </div>

                    </form>
                </div>
                <div class="modal-footer border-0">

                </div>

            </div>
        </div>
    </div>



    <div class="container">
        <a href="<?php echo BASE_URL . '/index.php' ?>"><i class="fa fa-arrow-left"></i>Home</a>
        <div class="get-button">
            <h1>Terms and Conditions</h1>
            <ul>
                <li>By entering the prize draw you are agreeing to these prize draw terms and conditions.The prize draw
                    is being run by the event creator.
                </li>
                <li>The prize draw is open to entrants that are students of Polytechnic University of the Philippines
                    Santo Tomas Branch. In entering the prize draw, you confirm that you are eligible to do so and
                    eligible to claim any prize you may win.</li>
                <li>A maximum of one entry per individual is permitted.</li>
                <li>The prize draw is free to enter. The prize draw will include those currently on our mailing list and
                    all new subscribers up until the deadline of the prize draw. Entries after that time and date will
                    not be included in the draw.</li>
                <li>To enter the prize draw you should fill up some information needed and download the ticket.</li>
                <li>PUP events will not accept responsibility if contact details provided are incomplete or inaccurate.
                    The winner will be drawn at random. Lastly, the winner will be notified after via the email provided
                    during subscription.</li>
                <div class="btn-container">
                    <div>
                        <input type="checkbox" name="checkbox" id="checkbox">
                        <label for="checkbox">Agree to the terms and conditions</label>
                    </div>
                    <button type="button" data-toggle="modal" data-target="#ticket-form-modal" id="get" name="get"
                        disabled="true">Try my Luck Now</button>
                </div>
            </ul>
        </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>

    <script>
    $(document).ready(function() {
        $('input[type="checkbox"]').click(function() {
            if ($(this).is(":checked")) {
                $('#get').prop('disabled', false);
            } else if ($(this).is(":not(:checked)")) {
                $('#get').prop('disabled', true);
            }
        });
    });
    </script>
</body>

</html>