<?php
/**
 * Footer displayed when logged in to the application
 *
 */
?>
<footer>
    <ul class="hlist">
        <li>ClusterBom <a href="#">&copy; Craig Russell 2011</a></li>
        <li><a href="#">Contact</a></li>
        <li><a href="#">Privacy &amp; Terms</a></li>
        <?php if(DEBUG): ?><li><a id="debuglink" href="#">Debug</a></li><?php endif; ?>
    </ul>
</footer>

<?php if(DEBUG) include(APP_DIR.'views/sys/debug.php'); /* Debug data on every page */ ?>  

</div><!-- #wrapper -->
