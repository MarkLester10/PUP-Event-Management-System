<?php
include "../../path.php";
include ROOT_PATH . "/application/controllers/events.php";
superUserAndAdmin();
$events = selectAll('events', ['user_id' => $_SESSION['id'], 'raffleSystem' => 1]);
if (count($events) == 0) {
    $_SESSION['upload-error-msg'] = 'Sorry :( No events with raffle system found<h4 style="color: #ddd;">If you wish to have a raffle for your event please make sure to select it upon creating the event</h4>';
    header("Location: " . BASE_URL . '/admin/elists/index.php');
    exit(0);
}

if (isset($_POST['choose-event'])) {
    $title = selectOne('events', ['id' => $_POST["event"]]);
    $candidates = selectAll('people', ['event_id' => $_POST["event"]]);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raffle Time</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo BASE_URL . '/assets/fontawesome/css/all.css'; ?>" />
    <link rel="stylesheet" href="<?php echo BASE_URL . '/assets/css/raffle.css'; ?>" />
    <link rel="icon" href="<?php echo BASE_URL . '/assets/imgs/logofinal.png' ?>">
</head>

<body>
    <a href="<?php echo BASE_URL . '/admin/dashboard.php'; ?> " class="back">Dashboard</a>
    <div class="container">
        <h2>EVERYDAY FEELING LUCKY</h2>
        <div class="input-container">
            <?php if (isset($_POST['choose-event'])): ?>
            <div id="winner">
                <p>Who is the Lucky Guy?</p><span></span>
            </div>
            <h3><?php echo $title['title']; ?></h3>
            <label>Candidates</label>
            <textarea id="candidates" readonly><?php foreach ($candidates as $candidate): ?><?php $names = selectOne('users', ['id' => $candidate['name']]);?><?php echo $names['username']; ?> - <?php echo $candidate['ticket']; ?>

<?php endforeach;?></textarea>
            <button id="choose-winner"><i class="fa fa-hamburger"></i> Pick a Winner</button>


            <?php else: ?>

            <form action="raffle.php" method="POST">
                <div id="winner">
                    <p>Do you think today is your day?</p>
                </div>
                <label>Choose Event</label>
                <select name="event" required>
                    <option value=""></option>
                    <?php foreach ($events as $event): ?>
                    <option value="<?php echo $event['id'] ?>"><?php echo $event['title'] ?></option>
                    <?php endforeach;?>
                </select>
                <button type="submit" name="choose-event"><i class="fa fa-check"></i> Submit</button>
                <?php endif;?>
            </form>
        </div>
    </div>


    <script>
    function rand(min, max) {
        return Math.floor(Math.random() * (max - min - 1)) + min;
    }

    (function(document, undefined) {

        var winner_box = document.querySelector('#winner span'),
            winner_box1 = document.querySelector('#winner p'),
            choose_btn = document.getElementById('choose-winner'),
            candidates = document.getElementById('candidates'),
            last_winner,
            index = -1,
            looper,
            nameLists = candidates.value.split("\n");


        choose_btn.addEventListener('click', function() {
            get_winner(candidates.value.split("\n"));
        }, false);

        (function __cycle() {
            var name = nameLists[++index % nameLists.length];
            winner_box.textContent = name;
            looper = setTimeout(__cycle, 70);
        })();

        // get winner function
        function get_winner(names) {
            setTimeout(function() {
                var name;
                clearTimeout(looper);

                // dont pick the same winner twice
                do {
                    name = names[rand(0, names.length)];
                } while (name == last_winner);
                winner_box.textContent = name;
                winner_box1.textContent = "Congratulations";
                last_winner = name;
            }, rand(350, 700));
        }


    })(document);
    </script>
</body>

</html>