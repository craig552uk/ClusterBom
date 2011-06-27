<?php
/**
 * Header displayed when logged in to the application
 *
 */
?>
<header class="clearfix">
    <h1>ClusterBom</h1>
    <nav id="account">
        <ul>
            <li><span><?php echo $session->email; ?></span></li>
            <li><a href="<?php echo BASE_URL . 'auth/logout' ?>">Logout</a></li>
            <li><a href="<?php echo BASE_URL . 'account'?>">My Account</a></li>
            <li><a href="<?php echo BASE_URL . 'account/help'?>">Help</a></li>
        </ul>
    </nav>
    <nav id="main">
        <ul>
            <li><a href="<?php echo BASE_URL ?>">Dashboard</a></li>
            <li><a href="<?php echo BASE_URL . 'dataset' ?>">Data Sets</a></li>
            <li><a href="<?php echo BASE_URL . 'visualisation' ?>">Cluster Visualisations</a></li>
        </ul>
    </nav>
</header>
