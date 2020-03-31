<?php
include "../../../path.php";
include ROOT_PATH . "/application/database/db.php";
$numEvents = selectAll('events');
?>
<?php if (count($numEvents) > 0): ?>
<div><?php echo count($numEvents); ?></div>
<?php else: ?>
<div>0</div>
<?php endif;?>