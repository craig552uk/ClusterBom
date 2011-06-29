<?php
/**
 * Dashboard View 
 *
 * This is the default view for a logged in user
 *
 */
?>

<?php include('header.php'); ?>
	
<nav id="content-nav">
    <ul class="hlist">
        <li><a id="selected" href="<?php echo BASE_URL ?>">Dashboard</a></li>
        <li><a href="<?php echo BASE_URL . 'dataset' ?>">Datasets</a></li>
        <li><a href="<?php echo BASE_URL . 'visualisation' ?>">Visualisations</a></li>
    </ul>
</nav><!-- #content-nav -->

<div class="content">
    <section>
        <h1>Welcome to ClusterBom</h1>
    </section>
</div><!-- .content -->

<?php include('footer.php'); ?>
