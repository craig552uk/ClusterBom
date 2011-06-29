<?php
/**
 * Dummy View 
 *
 */
?>
<?php include('header.php'); ?>

<nav id="content-nav">
    <ul class="hlist">
        <li><a href="<?php echo BASE_URL ?>">Dashboard</a></li>
        <li><a href="<?php echo BASE_URL . 'dataset' ?>">Datasets</a></li>
        <li><a href="<?php echo BASE_URL . 'visualisation' ?>">Visualisations</a></li>
    </ul>
</nav><!-- #content-nav -->
<div id="content">
    <section>
        <p><?php echo ( isset($message)) ? $message : ''; ?></p>
    </section>
</div><!-- #content -->

<?php include('footer.php'); ?>
