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
        <li><a href="<?php echo BASE_URL . 'visualization' ?>">Visualizations</a></li>
    </ul>
</nav><!-- #content-nav -->
<div class="content">
    <section>
        <h1><?php echo ( isset($title)) ? $title : ''; ?></h1>
        <p><?php echo ( isset($message)) ? $message : ''; ?></p>
    </section>
</div><!-- .content -->

<?php include('footer.php'); ?>
