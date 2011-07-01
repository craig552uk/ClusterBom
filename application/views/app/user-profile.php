<?php
/**
 * User Profile View 
 *
 */
?>
<?php include(APP_DIR.'views/sys/header.php'); ?>

<div class="app">
    <section>
        <h1>My Account</h1>
        <dl>
            <dt>Name</dt><dd><?php echo $account->fname . ' ' . $account->sname; ?></dd>
            <dt>Email</dt><dd><?php echo $account->email; ?></dd>
        </dl>
    </section>
</div><!-- .content -->

<?php include(APP_DIR.'views/sys/footer.php'); ?>
