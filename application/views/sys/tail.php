<?php
/**
 * Footer View 
 *
 * This should be included at the end of all other views
 *
 * @author Gilbert Pellegrom
 * @package PIP
 */
?>
<?php include('debug.php'); /* Debug data on every page */ ?>  

    <script src="<?php echo BASE_URL; ?>static/js/libs/jquery-1.5.1.min.js"></script>
    <script src="<?php echo BASE_URL; ?>static/js/script.js"></script>

    <!--[if lt IE 7 ]>
    <script src="<?php echo BASE_URL; ?>static/js/libs/dd_belatedpng.js"></script>
    <script>DD_belatedPNG.fix("img, .png_bg");</script>
    <![endif]-->
    
    <script>
        var _gaq=[["_setAccount","UA-XXXXX-X"],["_trackPageview"]];
        (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];g.async=1;
        g.src=("https:"==location.protocol?"//ssl":"//www")+".google-analytics.com/ga.js";
        s.parentNode.insertBefore(g,s)}(document,"script"));
    </script>
    
</body>
</html>
