<?php
/**
 * Header displayed when logged in to the application
 *
 */
?>
<header>
    <h1>ClusterBom</h1>
    <p><strong><?php echo $session->email; ?></strong> -
       <a href="<?php echo BASE_URL . 'auth/logout' ?>">Logout</a> - 
       <a href="<?php echo BASE_URL . 'account'?>">My Account</a> - 
       <a href="<?php echo BASE_URL . 'account/help'?>">Help</a></p>
    <ul>
        <li><a href="<?php echo BASE_URL ?>">Dashboard</a></li>
        <li><a href="<?php echo BASE_URL . 'dataset' ?>">Data Sets</a></li>
        <li><a href="<?php echo BASE_URL . 'visualisation' ?>">Cluster Visualisations</a></li>
    </ul>
</header>
