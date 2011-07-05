<?php
/**
 * Asynchronously load data cells in a table
 */
?>

<div class="headings scroll frame">
    <table width="100%">
        <thead>
            <tr>
                <th class="side-col">&nbsp;</th>
                <?php for($c=1; $c<=$max_col; $c++): ?>
                    <th id="head-<?php echo $c; ?>">
                        <input type="text" name="head-label-<?php echo $c; ?>" id="head-label-<?php echo $c; ?>" value="<?php echo 'Heading '.$c; ?>">
                        <select name="head-type-<?php echo $c; ?>" id="head-type-<?php echo $c; ?>">
                            <option value="ID">Identifier</option>
                            <option value="CAT">Categorical</option>
                            <option value="NUM">Numeric</option>
                        </select>
                    </th>
                <?php endfor;?>
            </tr>
        </thead>
        <tbody>
            <?php for($r=1; $r<=$max_row; $r++): ?>
                <tr id="row-<?php echo $r; ?>" class="dr">
                    <td class="side-col">&nbsp;</td>
                    <?php for($c=1; $c<=$max_col; $c++): ?>
                        <?php $v = (isset($cells[$c][$r])) ? $cells[$c][$r] : '&nbsp;'; ?>
                        <td id="cell-<?php echo $c.'-'.$r; ?>"><?php echo $v; ?></td>
                    <?php endfor;?>
                </tr>
            <?php endfor;?>
        </tbody>
    </table>
</div>
<script type="text/javascript">
    $('.dr').click(function(){
        $('td',this).each(function(){
            var c = $(this).attr('id').split('-')[1];
            var t = $(this).text();
            $('#head-label-'+c).attr('value',t);
            
        });
    });
</script>