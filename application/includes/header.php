<header>
    <a href="<?php echo BASE_URL . '/' ?>">
        <img src="<?php echo BASE_URL . '/assets/imgs/logofinal.png' ?>"
            style="width: 135px; position:absolute;top:-10%; left:5%;" alt="logo" />

    </a>
    <i class="fa fa-bars icon"></i>
    <ul class="nav">
        <div>
            <li>
                <a href=" <?php echo BASE_URL . '/' ?>">Home</a>
                <?php if (isset($_SESSION['id'])): ?>
                <ul class="home" style="left:0;">
                    <li><a href="<?php echo BASE_URL . '/index.php' ?>">Landing Page</a></li>
                    <li><a href="<?php echo BASE_URL . '/team.php' ?>">
                            <i class="fas fa-users" style="font-size: 16px;"></i>
                            Our Team</a></li>
                </ul>
                <?php endif;?>
            </li>
            <li><a href="<?php echo BASE_URL . '/index.php#about' ?>">Feedback</a></li>
            <li><a href="<?php echo BASE_URL . '/index.php#content' ?>">Events</a></li>
            <li><a href="#follow" class="tab-item">Follow Us</a></li>

            <?php if (isset($_SESSION['id'])): ?>
            <li>
                <a href="#">
                    <?php echo $_SESSION['username']; ?>
                    <i class="fas fa-chevron-down"></i>
                </a>
                <ul class="home home2">
                    <li>
                        <?php
$users = selectOne('users', ['id' => $_SESSION['id']]);
$id = $users['id'];
$sqlImg = selectOne('profileimg', ['id' => $id]);
$fileRealExt = '';

if ($sqlImg['status'] == 0) {
    $filename = "application/controllers/userimage/profile" . $id . "*";
    $fileinfo = glob($filename);
    $fileExt = explode(".", $fileinfo[0]);
    $fileRealExt = $fileExt[1];
    echo "<img src ='application/controllers/userimage/profile" . $id . "." . $fileRealExt . "?" . mt_rand() . "'>";
} else {
    echo " <img src='application/controllers/userimage/user.svg' >";
}
?>
                        <form action="<?php echo BASE_URL . '/application/controllers/profileImg.php'; ?>" method="post"
                            enctype="multipart/form-data" class="h-form">
                            <input type="file" id="file" name="file" />
                            <label for="file">
                                <i class="fas fa-image" style="font-size: 16px; margin-right: 2px;">
                                </i>
                                Choose a photo
                            </label>
                            <button type="submit" name="prof-upload">Upload</button>
                        </form>
                        <form action="<?php echo BASE_URL . '/application/controllers/confirmation.php'; ?>"
                            class="h-form">
                            <button type="submit" name="prof-delete" class="delete">Delete</button>
                        </form>
                    </li>

                    <?php if ($_SESSION['admin'] == "1964" || $_SESSION['admin'] == "2000"): ?>
                    <li><a href="<?php echo BASE_URL . '/admin/dashboard.php' ?>">Admin Dashboard</a></li>
                    <?php endif;?>

                    <li><a href="<?php echo BASE_URL . '/logout.php' ?>" class="logout">Logout <i
                                class="fa fa-sign-out-alt"></i></a></li>
                </ul>
            </li>
            <?php else: ?>
            <li><a href="<?php echo BASE_URL . '/signup.php' ?>">Sign Up</a></li>
            <li><a href="<?php echo BASE_URL . '/login.php' ?>">Log In <i class="fa fa-sign-in-alt"></i></a></li>
            <?php endif;?>
        </div>

    </ul>
</header>