<?php 
include("../../../path.php");
 include(ROOT_PATH . "/application/database/db.php");
 $numCategories = selectAll('categories');
 ?>
<?php if (count($numCategories) > 0) : ?>
                        <div><?php echo count($numCategories); ?></div>
                        <?php else : ?>
                        <div>0</div>
                        <?php endif; ?>