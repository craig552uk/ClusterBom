<?php
/**
 * Main View 
 *
 * This is the default view for unauthenticated users
 *
 */
?>

<?php include(APP_DIR.'views/sys/header.php'); ?>
        
    <div class="app">
        <section>
            <h1>Welcome to ClusterBom</h1>
            <?php if(isset($error)): /* Display error if set */ ?>
                <p class="error"><?php echo $error; ?></p>
            <?php endif; ?>
            <p><a href="#" onclick="popup('<?php echo BASE_URL . 'auth/login/' ?>'); return false;">login</a></p>
        </section>
    </div><!-- .content -->
    
<?php include(APP_DIR.'views/sys/footer.php'); ?>
