<?php
/**
 * Header displayed when logged in to the application
 *
 */
?>


<nav id="topbar">
    <a id="logo" href="<?php echo BASE_URL; ?>">ClusterBom</a>
    <ul class="hlist">
        <li><span><?php echo $session->email; ?></span></li>
        <li><a href="<?php echo BASE_URL . 'account/help'?>">Help</a></li>
        <li><a href="<?php echo BASE_URL . 'account'?>">My Account</a></li>
        <li><a href="<?php echo BASE_URL . 'auth/logout' ?>">Sign Out</a></li>
    </ul>
</nav><!-- #topbar -->
