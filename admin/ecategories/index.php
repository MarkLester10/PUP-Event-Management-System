<?php include "../../path.php";?>
<?php include ROOT_PATH . "/application/controllers/category.php";
adminOnly();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Admin - Manage Event Category</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="../../assets/fontawesome/css/all.css" />
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="../../assets/css/index.css" />
    <link rel="stylesheet" href="../../assets/css/admin.css" />
    <link rel="stylesheet" href="<?php echo BASE_URL . '/assets/css/modal.css' ?>" />
    <link rel="stylesheet" href="<?php echo BASE_URL . '/assets/js/aos-master/dist/aos.css' ?>" />
    <link rel="icon" href="<?php echo BASE_URL . '/assets/imgs/logofinal.png' ?>">
</head>

<body>
    <?php include ROOT_PATH . "/application/includes/headeradmin.php";?>

    <div class="admin-wrapper">
        <!-- sidebar -->
        <div class="left-sidebar">
            <ul>
                <li data-aos="fade-right"><a href="<?php echo BASE_URL . '/admin/dashboard.php'; ?> " class="s-list"><i
                            class="fa fa-home"></i>
                        Home <span style="color: gray;"> | <?php echo $_SESSION['username']; ?></span></a></li>
                <li data-aos="fade-right"><a href="<?php echo BASE_URL . '/admin/elists/index.php'; ?> "
                        class="s-list"><i class="fa fa-tasks"></i> Manage
                        Events</a></li>
                        <?php if($_SESSION['admin']==1964):?>
                <li data-aos="fade-right"><a href="<?php echo BASE_URL . '/admin/adminusers/index.php'; ?>"><i
                            class="fa fa-users"></i>
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
                <a href="catcreate.php" class="btn add"><i class="fa fa-check-circle"> Add Categories</i></a>
                <a href="index.php" class="btn manage act-manage"><i class="fa fa-clipboard-check"> Manage Event
                        Categories</i></a>
            </div>

            <div class="content">
                <h2 class="page-title">Manage Categories</h2>
                <?php include ROOT_PATH . "/application/includes/messages.php";?>
                <table>
                    <thead>
                        <th>CNo.</th>
                        <th>Name</th>
                        <th colspan="2">Actions</th>
                    </thead>
                    <tbody>

                    <?php if(count($categories)>0):?>
                        <?php foreach ($categories as $key => $category): ?>
                        <tr>
                            <td><?php echo $key + 1; ?></td>
                            <td><?php echo $category['name']; ?></td>
                            <td><a href="edit.php?id=<?php echo $category['id']; ?>" class="edit">Edit</a></td>
                            <td><a href="<?php echo BASE_URL . '/application/controllers/confirmation.php?del-category=' . $category['id']; ?>"
                                    class="delete">Delete</a></td>
                        </tr>
                        <?php endforeach;?>
                <?php else :?>
                        <tr>
                            <td colspan="3">
                                <h2 class="page-title" style="color:gray ;">No Categories Added Yet</h2>
                            </td>
                        </tr>
                <?php endif ;?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <script src="<?php echo BASE_URL . '/assets/bootstrap/js/jquery.min.js'; ?>"></script>
    <script src="<?php echo BASE_URL . '/assets/js/main.js'; ?>"></script>

    <script src="<?php echo BASE_URL . '/assets/js/aos-master/dist/aos.js' ?>"></script>
    <script src="<?php echo BASE_URL . '/assets/js/modal.js' ?>"></script>
    <script>
    jQuery(document).ready(function() {

        AOS.init({
            duration: 1000
        });

        $('.icon').on('click', function() {
            $('.nav').toggleClass('show');
            $('.nav ul').toggleClass('show');
        });
    });
    </script>
</body>

</html>