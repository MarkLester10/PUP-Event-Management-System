<?php if (count($errors) > 0): ?>
<div class="modal">
    <div id="result" class="modal-content error-box">
        <img src="<?php echo BASE_URL . '/assets/imgs/invalid.png'; ?>" alt="message">
        <?php foreach ($errors as $error): ?>
        <h1><?php echo $error; ?></h1>
        <?php endforeach;?>
    </div>
</div>
<?php endif;?>