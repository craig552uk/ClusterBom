<?php
/**
 * Main View 
 *
 * This is the default view for unauthenticated users
 *
 */
?>

<?php /* Don't include header.php - Using custom header for login */ ?>

    <nav id="topbar">
        <a id="logo" href="#">ClusterBom</a>
        <ul class="hlist">
            <li><a href="#">Pricing</a></li>
            <li><a href="#">More Info</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
    </nav><!-- #topbar -->
        
    <nav id="content-nav">
        <ul class="hlist">
            <li><a id="selected" href="<?php echo BASE_URL ?>">Log In</a></li>
        </ul>
    </nav><!-- #content-nav -->
    <div id="content">
        <section>
            <h1>Welcome to ClusterBom</h1>
            <?php if(isset($error)): /* Display error if set */ ?>
                <p class="error"><?php echo $error; ?></p>
            <?php endif; ?>
            <p><a href="#" onclick="popup('<?php echo BASE_URL . 'auth/login/' ?>'); return false;">login</a></p>
        </section>
    </div><!-- #content -->
    
<?php include('footer.php'); ?>
