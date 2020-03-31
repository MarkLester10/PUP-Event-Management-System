<!-- welcome messages -->
<?php if (isset($_SESSION['welcome-message'])): ?>
<div class="modal">
    <div id="result" class="modal-content">
        <img class="welcome" src="<?php echo BASE_URL . '/assets/imgs/indraw.png'; ?>" alt="message">
        <h1><?php echo $_SESSION['welcome-message']; ?></h1>
    </div>
    <?php
unset($_SESSION['welcome-message']);
?>
</div>
<?php endif;?>

<!-- //users messages -->

<?php if (isset($_SESSION['message'])): ?>
<div class="modal">
    <div id="result" class="modal-content">
        <img src="<?php echo BASE_URL . '/assets/imgs/valid.png'; ?>" alt="message">
        <h1><?php echo $_SESSION['message']; ?></h1>
    </div>
    <?php
unset($_SESSION['message']);
?>
</div>
<?php endif;?>


<!-- //upload error messages -->
<?php if (isset($_SESSION['upload-error-msg'])): ?>
<div class="modal">
    <div id="result" class="modal-content error-box">
        <img src="<?php echo BASE_URL . '/assets/imgs/invalid.png'; ?>" alt="message">
        <h1><?php echo $_SESSION['upload-error-msg']; ?></h1>
    </div>
    <?php
unset($_SESSION['upload-error-msg']);
?>
</div>
<?php endif;?>


<!-- deletion confirmation -->

<?php if (isset($_SESSION['confirm'])): ?>
<div class="modal">
    <div id="result" class="modal-content error-box">
        <img src="<?php echo BASE_URL . '/assets/imgs/warning.png'; ?>" alt="message" style="width:100px;">
        <h1><?php echo $_SESSION['confirm']; ?></h1>
        <p style=" color: rgb(204, 204, 204);">Do you really wanna delete this photo?</p>
        <form action="<?php echo BASE_URL . '/application/controllers/profiledelete.php'; ?>" method="post">
            <div class="modal-form">
                <div>
                    <button type="submit" name="confirm" class="confirm" data-aos="fade-up"
                        data-aos-duration="500">Delete</button>
                </div>
                <div>
                    <button type="submit" name="cancel" class="cancel" data-aos="fade-up"
                        data-aos-duration="500">Cancel</button>
                </div>
            </div>
        </form>
    </div>
    <?php
unset($_SESSION['confirm']);
?>
</div>
<?php endif;?>

<!-- Clear Events table -->
<?php if (isset($_SESSION['clear-events'])): ?>
<div class="modal">
    <div id="result" class="modal-content error-box">
        <img src="<?php echo BASE_URL . '/assets/imgs/warning.png'; ?>" alt="message" style="width:100px;">
        <h1>Are You Sure?</h1>
        <p><?php echo $_SESSION['clear-events']; ?></p>
        <form action="<?php echo BASE_URL . '/admin/elists/index.php'; ?>" method="post">
            <div class="modal-form">
                <div>
                    <button type="submit" name="confirm" class="confirm" data-aos="fade-up"
                        data-aos-duration="500">Clear</button>
                </div>
                <div>
                    <button type="submit" name="cancel" class="cancel" data-aos="fade-up"
                        data-aos-duration="500">Cancel</button>
                </div>
            </div>
        </form>
    </div>
    <?php
unset($_SESSION['clear-events']);
?>
</div>
<?php endif;?>

<!-- delete event from events table -->
<?php if (isset($_SESSION['delete-event'])): ?>
<div class="modal">
    <div id="result" class="modal-content error-box">
        <img src="<?php echo BASE_URL . '/assets/imgs/warning.png'; ?>" alt="message" style="width:100px;">
        <h1>Are You Sure?</h1>
        <p>Do you really wanna delete this event? <br>Note: This process cannot be undone</p>
        <div class="modal-form">
            <div>
                <a class="confirm" data-aos="fade-up" data-aos-duration="500"
                    href="<?php echo BASE_URL . '/admin/elists/index.php?delete-event=' . $_SESSION['delete-event']; ?>">Delete</a>
            </div>
            <div>
                <a class="cancel" data-aos="fade-up" data-aos-duration="500"
                    href="<?php echo BASE_URL . '/admin/elists/index.php'; ?>">Cancel</a>
            </div>
        </div>
    </div>
    <?php
unset($_SESSION['delete-event']);
?>
</div>
<?php endif;?>


<!-- delete category from categories table -->
<?php if (isset($_SESSION['delete-category'])): ?>
<div class="modal">
    <div id="result" class="modal-content error-box">
        <img src="<?php echo BASE_URL . '/assets/imgs/warning.png'; ?>" alt="message" style="width:100px;">
        <h1>Are You Sure?</h1>
        <p>Do you really wanna delete this category?<br>Note: This
            process cannot be undone</p>
        <div class="modal-form">
            <div>
                <a class="confirm" data-aos="fade-up" data-aos-duration="500"
                    href="<?php echo BASE_URL . '/admin/ecategories/index.php?del-id=' . $_SESSION['delete-category']; ?>">Delete</a>
            </div>
            <div>
                <a class="cancel" data-aos="fade-up" data-aos-duration="500"
                    href="<?php echo BASE_URL . '/admin/ecategories/index.php'; ?>">Cancel</a>
            </div>
        </div>
    </div>
    <?php
unset($_SESSION['delete-category']);
?>
</div>
<?php endif;?>


<!-- Clear People table -->
<?php if (isset($_SESSION['clear-people'])): ?>
<div class="modal">
    <div id="result" class="modal-content error-box">
        <img src="<?php echo BASE_URL . '/assets/imgs/warning.png'; ?>" alt="message" style="width:100px;">
        <h1>Are You Sure?</h1>
        <p><?php echo $_SESSION['clear-people']; ?></p>
        <form action="<?php echo BASE_URL . '/admin/elists/people.php'; ?>" method="post">
            <div class="modal-form">
                <div>
                    <button type="submit" name="p-confirm" class="confirm" data-aos="fade-up"
                        data-aos-duration="500">Clear</button>
                </div>
                <div>
                    <button type="submit" name="p-cancel" class="cancel" data-aos="fade-up"
                        data-aos-duration="500">Cancel</button>
                </div>
            </div>
        </form>
    </div>
    <?php
unset($_SESSION['clear-people']);
?>
</div>
<?php endif;?>


<!-- Clear active People table -->
<?php if (isset($_SESSION['clear-activepeople'])): ?>
<div class="modal">
    <div id="result" class="modal-content error-box">
        <img src="<?php echo BASE_URL . '/assets/imgs/warning.png'; ?>" alt="message" style="width:100px;">
        <h1>Are You Sure?</h1>
        <p>Do you really want to clear this table?<br>Note: This
            process cannot be undone</p>
        <div class="modal-form">
            <div>
                <a class="confirm" data-aos="fade-up" data-aos-duration="500"
                    href="<?php echo BASE_URL . '/admin/elists/people.php?p-activeconfirm=' . $_SESSION['clear-activepeople']; ?>">Clear</a>
            </div>
            <div>
                <a class="cancel" data-aos="fade-up" data-aos-duration="500"
                    href="<?php echo BASE_URL . '/admin/elists/people.php'; ?>">Cancel</a>
            </div>
        </div>
        </form>
    </div>
    <?php
unset($_SESSION['clear-activepeople']);
?>
</div>
<?php endif;?>

<!-- delete user -->
<?php if (isset($_SESSION['delete-user'])): ?>
<div class="modal">
    <div id="result" class="modal-content error-box">
        <img src="<?php echo BASE_URL . '/assets/imgs/warning.png'; ?>" alt="message" style="width:100px;">
        <h1>Are You Sure?</h1>
        <p>Do you really wanna delete this user? <br>Note: This process cannot be undone</p>
        <div class="modal-form">
            <div>
                <a class="confirm" data-aos="fade-up" data-aos-duration="500"
                    href="<?php echo BASE_URL . '/admin/adminusers/index.php?del-id=' . $_SESSION['delete-user']; ?>">Delete</a>
            </div>
            <div>
                <a class="cancel" data-aos="fade-up" data-aos-duration="500"
                    href="<?php echo BASE_URL . '/admin/adminusers/index.php'; ?>">Cancel</a>
            </div>
        </div>
    </div>
    <?php
unset($_SESSION['delete-user']);
?>
</div>
<?php endif;?>