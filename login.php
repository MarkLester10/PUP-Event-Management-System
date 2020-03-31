<?php
include "path.php";
include ROOT_PATH . "/application/controllers/users.php";
visitorsOnly();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="<?php echo BASE_URL . '/assets/css/signup.css' ?>" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo BASE_URL . '/assets/fontawesome/css/all.css' ?>">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="<?php echo BASE_URL . '/assets/bootstrap/css/bootstrap.min.css' ?>">
    <link rel="stylesheet" href="<?php echo BASE_URL . '/assets/js/aos-master/dist/aos.css' ?>" />
    <link rel="stylesheet" href="<?php echo BASE_URL . '/assets/css/modal.css' ?>" />
    <link rel="icon" href="<?php echo BASE_URL . '/assets/imgs/logofinal.png' ?>">
    <title>Log In</title>
</head>

<body>
    <header>
        <a href="<?php echo BASE_URL . '/index.php' ?>">
            <img src="<?php echo BASE_URL . '/assets/imgs/logofinal.png' ?>"
                style="width: 150px; position:absolute;top:-10%; left:5%;" alt="logo" />
        </a>
        <i class="fa fa-bars icon"></i>
        <ul class="nav">
            <div>
                <li class="list">
                    <a href="<?php echo BASE_URL . '/index.php' ?>" class="tab-item act">Home</a>
                </li>
                <li><a href="#follow" class="tab-item">Follow Us</a></li>
            </div>
        </ul>
    </header>


    <main>
        <?php include ROOT_PATH . "/application/helpers/formErrors.php";?>
        <section class="form-container">
            <form action="login.php" method="post" data-aos="fade-right" data-aos-delay="500">
                <h1>Log In</h1>
                <div class="social-container" style="margin:.5rem;">
                    <a href="#" class="social" data-aos="zoom-in" data-aos-delay="600"><i
                            class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social" data-aos="zoom-in" data-aos-delay="800"><i
                            class="fab fa-google-plus-g"></i></a>
                    <a href="#" class="social" data-aos="zoom-in" data-aos-delay="1000"><i
                            class="fab fa-linkedin-in"></i></a>
                </div>
                <span id="usernamecheck"></span>
                <input type="text" id="email" name="username" value="<?php echo $username; ?>" placeholder="Email"
                    onkeyup="checkUsername();" />
                <i id="eye" class="fa fa-eye" style="display:none;"></i>
                <i id="eye2" class="fa fa-eye-slash"></i>
                <input type="password" name="password" id="pwd" value="<?php echo $password; ?>"
                    placeholder="Password" />
                <a href="<?php echo BASE_URL . '/signup.php' ?>" class="create">Create Account</a>
                <a href="#" class="forgot">Forgot Password</a>
                <button type="submit" name="signin-submit" id="signin-btn">Log In</button>
            </form>
            <div class="overlay-container" data-aos="fade-up">
                <div>
                    <h1>Welcome Back!</h1>
                    <h2>Keep yourself updated to the latest events. <br> Log in Now!</h2>
                    <a href="<?php echo BASE_URL . '/signup.php' ?>"><button class="ghost" id="signUp">SIGN
                            UP</button></a>
                </div>
            </div>
        </section>
    </main>

    <?php include ROOT_PATH . "/application/includes/footer.php";?>

    <script src="<?php echo BASE_URL . '/assets/bootstrap/js/jquery.min.js' ?>"></script>
    <script src="<?php echo BASE_URL . '/assets/js/main.js' ?>"></script>
    <script src="<?php echo BASE_URL . '/assets/js/modal.js' ?>"></script>

    <!-- slick carousel -->
    <script src="<?php echo BASE_URL . '/assets/js/slick/slick.min.js' ?>"></script>
    <!-- animate on scroll -->
    <script src="<?php echo BASE_URL . '/assets/js/aos-master/dist/aos.js' ?>"></script>
    <script>
    function checkUsername() {
        var username = document.getElementById('email').value;
        if (username) {
            $.ajax({
                type: 'post',
                url: 'application/controllers/ajax/livevalidation.php',
                data: {
                    input_username: username,
                },
                success: function(response) {
                    $('#usernamecheck').html(response);
                    if (response != 'Available') {
                        $('#usernamecheck').addClass("invalid");
                        return true;
                    } else {
                        $('#usernamecheck').removeClass("invalid");
                        $('#usernamecheck').addClass("valid");
                        return false;
                    }
                }
            });
        } else {
            $('#usernamecheck').html("");
            $('#usernamecheck').removeClass("valid");
            $('#usernamecheck').removeClass("invalid");
            return false;
        }
    }

    // nav
    $('.icon').on('click', function() {
        $('.nav').toggleClass('show');
        $('.nav ul').toggleClass('show');
    });

    const pwd = document.getElementById('pwd');
    const eye = document.getElementById('eye');
    const eye2 = document.getElementById('eye2');

    eye.addEventListener('click', togglePass);

    function togglePass() {
        this.style.display = "none";
        eye2.style.display = "block";

        (pwd.type == 'text') ? pwd.type = 'password': pwd.type = 'text';
    }

    eye2.addEventListener('click', UnTogglePass);

    function UnTogglePass() {
        this.style.display = "none";
        eye.style.display = "block";
        (pwd.type == 'password') ? pwd.type = 'text': pwd.type = 'password';
    }



    AOS.init({
        duration: 1000
    });
    </script>
</body>

</html>