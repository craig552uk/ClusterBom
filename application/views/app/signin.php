<?php
/**
 * Sign in form
 *
 */
?>
<?php include(APP_DIR.'views/sys/header.php'); ?>

<div class="app">
    <section>
        <h1>Sign In</h1>
        <form method="post" action="<?php echo BASE_URL ?>auth/signin/">
            <?php if(isset($login_error)): ?><p class="error"><?php echo $login_error; ?></p><?php endif; ?>
            <p><input type="email" name="email" id="email" placeholder="Email Address"/></p>
            <p><input type="password" name="password" id="password" placeholder="Password"/></p>
            <p><input type="submit" name="submit" id="submit" value="Sign In"/> <a class="smalltext" href="">Forgotten Password?</a></p>
        </form> 
    </section>
</div><!-- .app -->

<?php include(APP_DIR.'views/sys/footer.php'); ?>
