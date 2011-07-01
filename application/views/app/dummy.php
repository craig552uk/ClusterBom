<?php
/**
 * Dummy View 
 *
 */
?>
<?php include(APP_DIR.'views/sys/header.php'); ?>

<div class="app">
    <section>
        <h1><?php echo ( isset($title)) ? $title : ''; ?></h1>
        <p><?php echo ( isset($message)) ? $message : ''; ?></p>
    </section>
</div><!-- .content -->

<?php include(APP_DIR.'views/sys/footer.php'); ?>
