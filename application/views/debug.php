<?php if(DEBUG): ?>
<section id="debug">
    <fieldset>
    <legend>Session Data</legend>
    <pre><?php print_r($_SESSION); ?></pre>
    </fieldset>
    
    <fieldset>
    <legend>GET Data</legend>
    <pre><?php print_r($_GET); ?></pre>
    </fieldset>
    
    <fieldset>
    <legend>POST Data</legend>
    <pre><?php print_r($_POST); ?></pre>
    </fieldset>
    
    <fieldset>
    <legend>Cookie Data</legend>
    <pre><?php print_r($_COOKIE); ?></pre>
    </fieldset>
    
    <fieldset>
    <legend>Server Data</legend>
    <pre><?php print_r($_SERVER); ?></pre>
    </fieldset>
</section>
<?php endif; ?>
