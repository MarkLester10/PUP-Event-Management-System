<?php include "../../path.php";?>
<?php include ROOT_PATH . "/application/controllers/category.php";
adminOnly();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Admin - Edit Event Category</title>
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

                        <?php if($_SESSION['admin']==1964):?>
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
                <a href="index.php" class="btn manage"><i class="fa fa-clipboard-check"> Manage Event Categories</i></a>
            </div>

            <div class="content">
                <h2 class="page-title">Edit Categories</h2>
                <?php include ROOT_PATH . "/application/includes/messages.php";?>
                <?php include ROOT_PATH . "/application/helpers/formErrors.php";?>
                <form action="edit.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <div>
                        <h4>Category</h4>
                        <input type="text" name="name" value="<?php echo $name; ?>"
                            placeholder="Please input in uppercase">
                    </div>

                    <div>
                        <h4>Description</h4>
                        <textarea name="description" id="body"><?php echo $description; ?></textarea>
                    </div>
                    <div>
                        <button type=" submit" name="update-category" class="btn a"><i class="fa fa-check-circle">
                                Update Category</i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script src="<?php echo BASE_URL . '/assets/bootstrap/js/jquery.min.js'; ?>"></script>
    <script src="<?php echo BASE_URL . '/assets/js/main.js'; ?>"></script>
    <script src="<?php echo BASE_URL . '/assets/js/modal.js' ?>"></script>
    <script src="<?php echo BASE_URL . '/assets/ckeditor/ckeditor.js'; ?>"></script>


    <script>
    jQuery(document).ready(function() {

        ClassicEditor
            .create(document.querySelector('#body'), {
                toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList',
                    'blockQuote'
                ],
                heading: {
                    options: [{
                            model: 'paragraph',
                            title: 'Paragraph',
                            class: 'ck-heading_paragraph'
                        },
                        {
                            model: 'heading1',
                            view: 'h1',
                            title: 'Heading 1',
                            class: 'ck-heading_heading1'
                        },
                        {
                            model: 'heading2',
                            view: 'h2',
                            title: 'Heading 2',
                            class: 'ck-heading_heading2'
                        }
                    ]
                }
            })
            .catch(error => {
                console.log(error);
            });
    });
    </script>
</body>

</html>