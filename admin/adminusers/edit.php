<?php include "../../path.php";?>
<?php include ROOT_PATH . "/application/controllers/users.php";
adminOnly();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Admin - Edit Users</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="../../assets/fontawesome/css/all.css" />
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="../../assets/css/index.css" />
    <link rel="stylesheet" href="../../assets/css/admin.css" />
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
                <li><a href="<?php echo BASE_URL . '/admin/elists/index.php'; ?> " class="s-list"><i
                            class="fa fa-tasks"></i> Manage
                        Events</a></li>

                <?php if ($_SESSION['admin'] == 1964): ?>
                <li><a href="<?php echo BASE_URL . '/admin/adminusers/index.php'; ?>" class="s-list active"><i
                            class="fa fa-users"></i>
                        Manage
                        Users</a></li>
                <li><a href="<?php echo BASE_URL . '/admin/ecategories/index.php'; ?>" class="s-list"><i
                            class="fa fa-list-alt"></i>
                        Manage
                        Events
                        Categories</a></li>
                <?php endif;?>

            </ul>
            </ul>
        </div>

        <!-- admin content -->
        <div class="admin-content">
            <div class="button-group">
                <a href="index.php" class="btn manage"><i class="fa fa-users"> Manage User</i></a>
            </div>

            <div class="content user">
                <h2 class="page-title">Edit User</h2>
                <?php include ROOT_PATH . "/application/helpers/formErrors.php";?>
                <form action="edit.php" method="POST" class="form">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <span>
                        <h4>Username</h4> <input type="text" name="username" value="<?php echo $username; ?>" />
                    </span>
                    <span>
                        <h4>Email</h4><input type="email" name="email" value="<?php echo $email; ?>" />
                    </span>
                    <span class="validationEmail">
                        <i id="eye" class="fa fa-eye" style="display:none;"></i>
                        <i id="eye2" class="fa fa-eye-slash"></i>
                        <h4>Password</h4> <input type="password" id="pwd1" name="password"
                            onkeyup="validatePassword();" />
                        <p id="text1"></p>
                    </span>
                    <span class="validationEmail">
                        <h4>Confirm Password</h4> <input type="password" id="pwd2" name="passwordConf"
                            onkeyup="confirmPass();" />
                        <p id="text2"></p>
                    </span>


                    <span>
                        <h4>Assign To</h4>
                        <?php if ($admin == 1100 && $admin != 2000): ?>
                        <select name="assignment" id="assignment" required disabled>
                            <option value=""></option>
                            <?php foreach ($categories as $key => $category): ?>
                            <?php if (!empty($assignment) && $assignment == $category['id']): ?>
                            <option selected value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?>
                            </option>
                            <?php else: ?>
                            <option value="<?php echo $category['id']; ?>">
                                <?php echo $category['name']; ?></option>
                            <?php endif;?>
                            <?php endforeach;?>
                        </select>
                        <?php else: ?>
                        <select name="assignment" id="assignment" required>
                            <option value=""></option>
                            <?php foreach ($categories as $key => $category): ?>
                            <?php if (!empty($assignment) && $assignment == $category['id']): ?>
                            <option selected value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?>
                            </option>
                            <?php else: ?>
                            <option value="<?php echo $category['id']; ?>">
                                <?php echo $category['name']; ?></option>
                            <?php endif;?>
                            <?php endforeach;?>
                        </select>
                        <?php endif;?>
                    </span>

                    <span class="role">
                        <?php if ($admin == 1100 && $admin != 2000): ?>
                        <div class="check">
                            <input type="radio" name="admin" id="admin" value="2000" onclick="enable()" required>
                            <h4>Course Admin</h4>
                        </div>

                        <div class="check">
                            <input type="radio" checked name="admin" id="student" value="1100" onclick="disable()"
                                required>
                            <h4>Student</h4>
                        </div>

                        <?php else: ?>
                        <div class="check">
                            <input type="radio" checked name="admin" id="admin" value="2000" onclick="enable()"
                                required>
                            <h4>Course Admin</h4>
                        </div>

                        <div class="check">
                            <input type="radio" name="admin" id="student" value="1100" onclick="disable()" required>
                            <h4>Student</h4>
                        </div>
                        <?php endif;?>
                    </span>

                    <span class="button">
                        <button type="submit" name="update-user" class="btn a"><i class="fa fa-check-circle"> Update
                                User</i></button>
                    </span>
                </form>
            </div>
        </div>
    </div>
    </div>

    <script src="<?php echo BASE_URL . '/assets/bootstrap/js/jquery.min.js'; ?>"></script>
    <script src="<?php echo BASE_URL . '/assets/js/main.js'; ?>"></script>
    <script src="<?php echo BASE_URL . '/assets/js/modal.js'; ?>"></script>

    <script>
    // passwords
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

    function disable() {
        document.getElementById("assignment").disabled = true;
    }

    function enable() {
        document.getElementById("assignment").disabled = false;
    }


    jQuery(document).ready(function() {
        $("textarea").focus(function() {
            $(this).animate({
                "height": "500px",
            }, "slow");
        });

        $("textarea").blur(function() {
            $(this).animate({
                "height": "100px",
            }, "slow");
        });

        $('.icon').on('click', function() {
            $('.nav').toggleClass('show');
            $('.nav ul').toggleClass('show');
        });
    });

    AOS.init({
        duration: 1000
    });
    </script>
</body>

</html>