<?php
/**
 * Header displayed at top of application
 *
 */
?>

<div id="wrapper">

<?php if(isset($_SESSION['auth']) && $_SESSION['auth']['state']==='AUTHENTICATED'): /* Logged in Top Bar */ ?>

    <nav id="top-nav">
        <a id="logo" href="<?php echo BASE_URL; ?>"></a>
        <ul class="hlist">
            <li><span><?php echo $session->email; ?></span></li>
            <li><a href="<?php echo BASE_URL . 'account/help'?>">Help</a></li>
            <li><a href="<?php echo BASE_URL . 'account'?>">My Account</a></li>
            <li><a href="<?php echo BASE_URL . 'auth/logout' ?>">Sign Out</a></li>
        </ul>
    </nav><!-- #top-nav -->

    <?php $tab = (!isset($tab)) ? '' : $tab; /* Default $tab if not set */ ?>

    <nav id="app-nav">
        <ul class="hlist">
            <li><a <?php if($tab=='DASH') echo 'id="selected"'; ?> href="<?php echo BASE_URL ?>">Dashboard</a></li>
            <li><a <?php if($tab=='DATA') echo 'id="selected"'; ?> href="<?php echo BASE_URL . 'dataset' ?>">Datasets</a></li>
            <li><a <?php if($tab=='VIZ')  echo 'id="selected"'; ?> href="<?php echo BASE_URL . 'visualization' ?>">Visualizations</a></li>
        </ul>
    </nav><!-- #content-nav -->

<?php else: /* Not Logged in Top Bar */ ?>

    <nav id="top-nav">
        <a id="logo" href="<?php echo BASE_URL; ?>"></a>
        <ul class="hlist">
            <li><a href="#">Pricing</a></li>
            <li><a href="#">More Info</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
    </nav><!-- #top-nav -->

    <nav id="app-nav"><?php /* Empty */ ?></nav><!-- #content-nav -->

<?php endif; ?>
