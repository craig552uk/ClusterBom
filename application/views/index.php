<?php
/**
 * Main View 
 *
 * This is the default view for unauthenticated users
 *
 */
?>

<section>
    <h1>Login</h1>
    <form method="post" action="<?php echo BASE_URL ?>auth/login/">
        <?php if(isset($login_error)): ?><p class="error"><?php echo $login_error; ?></p><?php endif; ?>
        <p><label for="email">Email</label><input type="email" name="email" id="email"/></p>
        <p><label for="password">Password</label><input type="password" name="password" id="password"/></p>
        <p><label for="remember">Remember Me?</label><input type="checkbox" name="remember" id="remember"/></p>
        <p><input type="submit" name="submit" id="submit" value="Login"/> <a href="">Forgotten Password?</a></p>
    </form> 
</section>

<section>
    <h1>Sign Up</h1>
    <form method="post" action="<?php echo BASE_URL ?>account/register/">
        <?php if(isset($signup_error)): ?><p class="error"><?php echo $signup_error; ?></p><?php endif; ?>
        <p><label for="name">Full Name</label><input type="text" name="name" id="name"/></p>
        <p><label for="email">Email</label><input type="text" name="email" id="email"/></p>
        <p><label for="password">Password</label><input type="password" name="password" id="password"/></p>
        <p><input type="submit" name="submit" id="submit" value="Sign Up"/></p>
    </form> 
</section>

<?php if(DEBUG): ?><li><a id="debuglink" href="#">Debug</a></li><?php endif; ?>
