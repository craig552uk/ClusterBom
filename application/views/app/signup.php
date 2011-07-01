<?php
/**
 * Sign up form
 *
 */
?>
<?php include(APP_DIR.'views/sys/header.php'); ?>

<div class="app">
    <section>
        <h1>Sign Up</h1>
        <form method="post" action="<?php echo BASE_URL ?>auth/signup/">
            <?php if(isset($signup_error)): ?><p class="error"><?php echo $signup_error; ?></p><?php endif; ?>
            <p><input type="text" name="name" id="name" placeholder="Full Name"/></p>
            <p><input type="email" name="email" id="email" placeholder="Email Address"/></p>
            <p><input type="password" name="password" id="password" placeholder="Password"/></p>
            <p><input type="submit" name="submit" id="submit" value="Sign Up"/></p>
        </form> 
    </section>
</div><!-- .app -->

<?php include(APP_DIR.'views/sys/footer.php'); ?>
