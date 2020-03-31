<?php
include "../../../path.php";
include ROOT_PATH . "/application/database/db.php";
$numStudents = selectAll('users', ['admin' => 1100]);
?>
<?php if (count($numStudents) > 0): ?>
<div><?php echo count($numStudents); ?></div>
<?php else: ?>
<div>0</div>
<?php endif;?>