<?php include "../../path.php";?>
<?php include ROOT_PATH . "/application/controllers/events.php";
superUserAndAdmin();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Admin - Edit Events</title>
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
                <li><a href="<?php echo BASE_URL . '/admin/adminusers/index.php'; ?>"><i class="fa fa-users"></i>
                        Manage
                        Users</a></li>
                <li><a href="<?php echo BASE_URL . '/admin/ecategories/index.php'; ?>" class="s-list active"><i
                            class="fa fa-list-alt"></i>
                        Manage
                        Events
                        Categories</a></li>
                <?php endif;?>
            </ul>
        </div>
        <!-- admin content -->
        <div class="admin-content">
            <div class="button-group">
                <a href="index.php" class="btn manage"><i class="fa fa-clipboard-check"> Manage
                        Events</i></a>
                <a href="people.php" class="btn pips"><i class="fa fa-users">
                        People</i></a>
            </div>

            <div class="content">
                <h2 class="page-title">Edit Events</h2>
                <?php include ROOT_PATH . "/application/helpers/formErrors.php";?>
                <form action="edit.php" method="POST" enctype="multipart/form-data">

                    <input type="hidden" name="id" value="<?php echo $id; ?>">

                    <div>
                        <h4>Title</h4>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </div>

                    <div>
                        <h4>Event Information</h4>
                        <textarea name="description" id="description"><?php echo $description; ?></textarea>
                    </div>


                    <div>
                        <h4>Categories</h4>
                        <select name="category_id">
                            <option value=""></option>
                            <?php foreach ($categories as $key => $category): ?>
                            <?php if (!empty($category_id) && $category_id == $category['id']): ?>
                            <option selected value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?>
                            </option>
                            <?php else: ?>
                            <option value="<?php echo $category['id']; ?>">
                                <?php echo $category['name']; ?></option>
                            <?php endif;?>
                            <?php endforeach;?>
                        </select>
                    </div>

                    <div style="width: 30%;">
                        <h4>Event Date</h4>
                        <input type="datetime-local" required name="eventday">
                        <?php echo date("d-m-Y g:i a", strtotime($eventDay)); ?>
                    </div>


                    <div>
                        <h4>Image</h4>
                        <i class="fas fa-image" style="font-size: 32px; position:relative;"></i>
                        <button type="button" id="custom-button">Choose Image</button>
                        <span id="custom-text">No file chosen</span>
                        <input type="file" name="image" id="real-file" style="display: none" />
                    </div>
                    <div class="choice">
                        <div style="width: 20%;" class="check">
                            <?php if (empty($released)): ?>
                            <input type="checkbox" name="released" class="square">
                            <h4>Release</h4>
                            <?php else: ?>
                            <input type="checkbox" name="released" checked class="square">
                            <h4>Release</h4>
                            <?php endif;?>
                        </div>

                        <div class="raffle">
                            <?php if (empty($raffleSystem)): ?>
                            <input type="checkbox" name="raffleSystem" class="square">
                            <h4>Select if you wish to have a Raffle System</h4>
                            <?php else: ?>
                            <input type="checkbox" name="raffleSystem" checked class="square">
                            <h4>Select if you wish to have a Raffle System</h4>
                            <?php endif;?>
                        </div>
                    </div>
                    <div>
                        <button type="submit" name="update-event" class="btn a add-event"><i
                                class=" fa fa-check-circle"> Update
                                Event</i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="<?php echo BASE_URL . '/assets/bootstrap/js/jquery.min.js'; ?>"></script>
    <script src="<?php echo BASE_URL . '/assets/js/main.js'; ?>"></script>
    <script src="<?php echo BASE_URL . '/assets/ckeditor/ckeditor4/ckeditor.js'; ?>"></script>
    <script src="<?php echo BASE_URL . '/assets/js/modal.js' ?>"></script>

    <script>
    CKEDITOR.replace('description');
    const realFileBtn = document.getElementById('real-file');
    const customBtn = document.getElementById('custom-button');
    const customTxt = document.getElementById('custom-text');


    customBtn.addEventListener('click', function() {
        realFileBtn.click();
    });

    realFileBtn.addEventListener('change', function() {
        if (realFileBtn.value) {
            customTxt.innerHTML = realFileBtn.value.match(/[\/\\]([\w\d\s\.\-\(\)]+)$/)[1];
        } else {
            customTxt.innerHTML = "No File Chosen";
        }
    });
    </script>
</body>

</html>