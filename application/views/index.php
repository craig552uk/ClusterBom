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
    <a href="#" onclick="popup('<?php echo BASE_URL . 'auth/' ?>'); return false;">login</a>
</div>
