<?php
/**
 * Dispalyed at the top of all views
 * Unless render is called like $template->render(false);
 *
 */
?>
<!DOCTYPE html>
<!--[if lt IE 7 ]> <html class="no-js ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]>    <html class="no-js ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]>    <html class="no-js ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
    <meta charset="utf-8" />
    
    <title><?php echo ( isset($title)) ? $title : ''; ?></title>
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="author" href="<?php echo BASE_URL; ?>humans.txt" />
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo BASE_URL; ?>static/images/icons/favicon.ico">
    <link rel="apple-touch-icon" href="<?php echo BASE_URL; ?>static/images/icons/apple-touch-icon.png">
    
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>static/css/boilerplate.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>static/css/style.css" type="text/css" />
    
    <script src="<?php echo BASE_URL; ?>static/js/libs/modernizr-1.7.min.js"></script>
    <script src="<?php echo BASE_URL; ?>static/js/libs/jquery-1.5.1.min.js"></script>
    <script src="<?php echo BASE_URL; ?>static/js/script.js"></script>
</head>
<body>
