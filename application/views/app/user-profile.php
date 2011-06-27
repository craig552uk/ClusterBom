<?php
/**
 * User Profile View 
 *
 */
?>
<?php include('header.php'); ?>

<section id="content">
    <h1>My Account</h1>
    <dl>
        <dt>Name</dt><dd><?php echo $account->fname . ' ' . $account->sname; ?></dd>
        <dt>Email</dt><dd><?php echo $account->email; ?></dd>
    </dl>
</section>

<?php include('footer.php'); ?>
