<?php
/**
 * Header displayed when logged in to the application
 *
 */
?>
<header>
    <h1>ClusterBom</h1>
    <p><strong><?php echo $userdata->email; ?></strong> - <a href="<?php echo BASE_URL . 'auth/logout' ?>">Logout</a></p>
</header>
