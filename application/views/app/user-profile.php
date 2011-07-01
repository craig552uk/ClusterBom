<?php
/**
 * User Profile View 
 *
 */
?>
<?php include(APP_DIR.'views/sys/header.php'); ?>

<div class="app settings">
    <section>
        <h1>My Account</h1>
        <form method="post" action="">
            <?php if(isset($details_success)): ?>
                <p class="success"><?php echo $details_success; ?></p>
            <?php endif; ?>
            <?php if(isset($password_success)): ?>
                <p class="success"><?php echo $password_success; ?></p>
            <?php endif; ?>
            <fieldset>
                <legend>Account Details</legend>
                <?php if(isset($details_error)): ?>
                    <p class="error"><?php echo $details_error; ?></p>
                <?php endif; ?>
                <p><label for="name">Name</label>
                   <input type="text" name="name" id="name" value="<?php echo $account->name; ?>" /></p>
                <p><label for="email">Email</label>
                   <input type="text" name="email" id="email" value="<?php echo $account->email; ?>" /></p>
            </fieldset>
            
            <fieldset>
                <legend>Change Password</legend>
                <?php if(isset($password_error)): ?>
                    <p class="error"><?php echo $password_error; ?></p>
                <?php endif; ?>
                <p><label for="old_pass">Old Password</label>
                   <input type="password" name="old_pass" id="old_pass" /></p>
                <p><label for="new_pass">New Password</label>
                   <input type="password" name="new_pass" id="new_pass" /></p>
            </fieldset>
            
            <div><input type="submit" name="submit" id="submit" value="Save" />
               <a class="cancel" href="<?php echo BASE_URL; ?>">Cancel</a></div>
        </form> 
    </section>
</div><!-- .content -->

<?php include(APP_DIR.'views/sys/footer.php'); ?>
