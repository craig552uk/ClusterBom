<?php
/**
 * Header displayed when logged in to the application
 *
 */
?>

<h1>ClusterBom - logged in as <?php echo $userdata->email; ?></h1>
<a href="<?php echo BASE_URL . 'auth/logout' ?>">Logout</a>

