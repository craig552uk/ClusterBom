<?php
/**
 * Load spreadsheets asynchronously
 *
 */
?>

<ul>
<?php foreach($spreadsheets as $s): ?>
    <li>
        <div class="spreadsheet clearfix" onclick="$(this).nextAll().slideToggle();">
            <span class="title"><?php echo $s->title; ?></span> 
            <span class="author"><?php echo $s->author->name; ?></span>
            <span class="date"><?php echo date(DATETIME_FORMAT, $s->updated); ?></span>
        </div>
        <ul class="worksheets">
            <li class="worksheet">Worksheet1</li>
            <li class="worksheet">Worksheet2</li>
            <li class="worksheet">Worksheet3</li>
        </ul>
    </li>
    <!--<p><?php echo $s->uri; ?></p>
    <p><?php echo $s->updated; ?></p>
    <p><?php echo $s->author->name; ?></p>
    <p><?php echo $s->author->email; ?></p>-->
<?php endforeach; ?>
</ul>
