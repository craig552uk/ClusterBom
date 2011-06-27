<?php
/**
 * Main View 
 *
 * This is the default view for unauthenticated users
 *
 */
?>

<div id="content">
    <h1>Welcome to ClusterBom</h1>
    <?php if(isset($error)): /* Display error if set */ ?>
        <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>
    <p><a href="#" onclick="popup('<?php echo BASE_URL . 'auth/login/' ?>'); return false;">login</a></p>
</div>
