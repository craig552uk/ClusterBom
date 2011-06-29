<?php
/**
 * User Profile View 
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
        <h1>My Account</h1>
        <dl>
            <dt>Name</dt><dd><?php echo $account->fname . ' ' . $account->sname; ?></dd>
            <dt>Email</dt><dd><?php echo $account->email; ?></dd>
        </dl>
    </section>
</div><!-- #content -->
<?php include('footer.php'); ?>
