<?php
include "../../../path.php";
include ROOT_PATH . "/application/database/db.php";

$numAdmin = selectAll('users', ['admin' => 2000]);
?>


<?php foreach ($numAdmin as $admin): ?>
<tr>
    <td><?php echo $admin['username']; ?></td>
    <td><?php echo $admin['email']; ?></td>
    <?php $numPosts = selectAll('events', ['category_id' => $admin['assignment']]);
if (count($numPosts) > 0) {
    echo '<td>' . count($numPosts) . '</td>';
} else {
    echo '<td>0</td>';
}

?>
</tr>
<?php endforeach;?>