<?php
/**
 * Load spreadsheets asynchronously
 *
 */
?>

<ul>
<?php foreach($spreadsheets as $s): ?>
    <li class="clearfix">
        <div class="title"><?php echo $s->title; ?></div> 
        <div class="author"><?php echo $s->author->name; ?></div>
        <div class="date"><?php echo date(DATETIME_FORMAT, $s->updated); ?></div>
    </li>
    <!--<p><?php echo $s->uri; ?></p>
    <p><?php echo $s->updated; ?></p>
    <p><?php echo $s->author->name; ?></p>
    <p><?php echo $s->author->email; ?></p>-->
<?php endforeach; ?>
</ul>
