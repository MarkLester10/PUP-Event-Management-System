<?php
include "../../../path.php";
include ROOT_PATH . "/application/database/db.php";
$numAdmin = selectAll('users', ['admin' => 2000]);
?>
<?php if (count($numAdmin) > 0): ?>
<div><?php echo count($numAdmin); ?></div>
<?php else: ?>
<div>0</div>
<?php endif;?>