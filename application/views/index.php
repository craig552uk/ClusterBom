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
    <p><a href="#" onclick="popup('<?php echo BASE_URL . 'auth/login/' ?>'); return false;">login</a></p>
</div>
