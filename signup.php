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
    <title>Sign Up</title>
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
                <li><a href="#follow" class="tab-item">Follow Us</a>
                    <li />
            </div>
        </ul>
    </header>

    <main>
        <?php include ROOT_PATH . "/application/helpers/formErrors.php";?>
        <section class="form-container">
            <form action="signup.php" method="post" data-aos="fade-right" data-aos-delay="500">
                <h1>Create <br> Account</h1>
                <input type="text" name="username" value="<?php echo $username; ?>" placeholder="Username" />
                <input type="email" id="email" name="email" value="<?php echo $email; ?>" placeholder="Email"
                    onkeyup="checkEmail();" />
                <span id="text"></span>
                <div class="eye-container">
                    <input type="password" name="password" id="pwd1" value="<?php echo $password; ?>"
                        placeholder="Password" onkeyup="validatePassword();" />
                    <i id="eye" class="fa fa-eye" style="display:none;"></i>
                    <i id="eye2" class="fa fa-eye-slash"></i>
                </div>
                <span id="text1"></span>
                <input type="password" name="passwordConf" id="pwd2" value="<?php echo $passwordConf; ?>"
                    placeholder="Confirm Password" onkeyup="confirmPass();" />
                <span id="text2"></span>
                <button type="submit" name=register-btn id=signup-btn>Sign Up</button>
                <input type="hidden" name="admin" value="1100">
            </form>
            <div class="overlay-container" data-aos="fade-up">
                <div class="overlay">
                    <h1>Hello, Friend!</h1>
                    <h2>Come and Join Us. <br> Enter your personal details <br> and we'll update you to the latest
                        events.
                    </h2>
                    <a href="<?php echo BASE_URL . '/login.php' ?>"><button class="ghost" id="signUp">Log
                            In</button></a>
                    <div class="social-container">
                        <a href="#" class="social" data-aos="zoom-in" data-aos-delay="400"><i
                                class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social" data-aos="zoom-in" data-aos-delay="600"><i
                                class="fab fa-google-plus-g"></i></a>
                        <a href="#" class="social" data-aos="zoom-in" data-aos-delay="800"><i
                                class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </section>
        <?php include ROOT_PATH . "/loader.php";?>
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
    // validate password and password strength
    function validatePassword() {
        var pwd = document.getElementById("pwd1").value;
        var pwd2 = document.getElementById("pwd2").value;
        var text1 = document.getElementById("text1");



        if (pwd.length > 8) {
            if (pwd.match(/[a-z]+/)) {
                if (pwd.match(/[A-Z]+/)) {
                    if (pwd.match(/[0-9]+/)) {
                        if (pwd.match(/[!@$%^&*()#_?.]+/)) {
                            text1.classList.add("valid");
                            text1.classList.remove("invalid");
                            text1.textContent = "Strong Password";
                        } else {
                            text1.classList.add("invalid");
                            text1.classList.remove("valid");
                            text1.textContent = "Password must contain at least one special character";
                        }
                    } else {
                        text1.classList.add("invalid");
                        text1.classList.remove("valid");
                        text1.textContent = "Password must contain at least one number";
                    }
                } else {
                    text1.classList.add("invalid");
                    text1.classList.remove("valid");
                    text1.textContent = "Password must contain at least one uppercase letter";
                }

            } else {
                text1.classList.add("invalid");
                text1.classList.remove("valid");
                text1.textContent = "Password must contain at least one lowercase letter";
            }

        } else {
            text1.classList.add("invalid");
            text1.classList.remove("valid");
            text1.textContent = "Password must be 8 characters in length";
        }
    }


    // confirm pass
    function confirmPass() {
        var pwd = document.getElementById("pwd1").value;
        var pwd2 = document.getElementById("pwd2").value;
        var text2 = document.getElementById("text2");
        if (pwd != pwd2) {
            text2.classList.add("invalid");
            text2.classList.remove("valid");
            text2.textContent = "Passwords do not match";
        } else {
            text2.classList.add("valid");
            text2.classList.remove("invalid");
            text2.textContent = "Passwords match";
        }
    }

    // checkemail if exist in database
    function checkEmail() {
        var email = document.getElementById('email').value;
        if (email) {
            $.ajax({
                type: 'post',
                url: 'application/controllers/ajax/livevalidation.php',
                data: {
                    input_email: email,
                },
                success: function(response) {
                    $('#text').html(response);
                    if (response == "Available") {
                        $('#text').addClass("valid");
                        return true;
                    } else {
                        $('#text').removeClass("valid");
                        $('#text').addClass("invalid");
                        return false;
                    }
                }
            });
        } else {
            $('#text').html("");
            $('#text').removeClass("valid");
            $('#text').removeClass("invalid");
            return false;
        }
    }



    // eye
    const pwd1 = document.getElementById('pwd1');
    const pwd2 = document.getElementById('pwd2');
    const eye = document.getElementById('eye');
    const eye2 = document.getElementById('eye2');

    eye.addEventListener('click', togglePass);

    function togglePass() {
        this.style.display = "none";
        eye2.style.display = "block";

        (pwd1.type == 'text') ? pwd1.type = 'password': pwd1.type = 'text';
        (pwd2.type == 'text') ? pwd2.type = 'password': pwd2.type = 'text';
    }

    eye2.addEventListener('click', UnTogglePass);

    function UnTogglePass() {
        this.style.display = "none";
        eye.style.display = "block";
        (pwd1.type == 'password') ? pwd1.type = 'text': pwd1.type = 'password';
        (pwd2.type == 'password') ? pwd2.type = 'text': pwd2.type = 'password';
    }



    // nav
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