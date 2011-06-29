<?php
/**
 * Dataset list
 * Lists all datasets that are accessible to the user
 * Public and user-created datasets are listed seperately
 * 
 */
?>
<?php include('header.php'); ?>

<nav id="content-nav">
    <ul class="hlist">
        <li><a href="<?php echo BASE_URL ?>">Dashboard</a></li>
        <li><a id="selected" href="<?php echo BASE_URL . 'dataset' ?>">Datasets</a></li>
        <li><a href="<?php echo BASE_URL . 'visualisation' ?>">Visualisations</a></li>
    </ul>
</nav><!-- #content-nav -->

<div class="content">
    <section>
        <h1>My Data Sets</h1>
        <p><a href="#" onclick="popup('<?php echo BASE_URL . 'auth/oauth2/' ?>'); return false;">Import From Google</a></p>
        <ul class="datasets">
        <?php foreach($user_list as $ds): ?>
            <li id="ds_<?php echo $ds->pk_dataset_id; ?>">
                <dl>
                    <dt>Name</dt><dd><?php echo $ds->name; ?></dd>
                    <dt>Description</dt><dd><?php echo $ds->description; ?></dd>
                    <dt>Owner</dt><dd><?php echo $ds->goog_owner_name; ?> 
                                  <a href="mailto:<?php echo $ds->goog_owner_email; ?>">
                                  <?php echo $ds->goog_owner_email; ?></a></dd>
                    <dt>Imported</dt><dd><?php echo $ds->date_uploaded; ?></dd>
                </dl>
            </li>
        <?php endforeach; ?>
        </ul>
    </section>

    <section>
        <h1>Public Data Sets</h1>
        <ul class="datasets">
        <?php foreach($public_list as $ds): ?>
            <li id="ds_<?php echo $ds->pk_dataset_id; ?>">
                <dl>
                    <dt>Name</dt><dd><?php echo $ds->name; ?></dd>
                    <dt>Description</dt><dd><?php echo $ds->description; ?></dd>
                    <dt>Owner</dt><dd><?php echo $ds->goog_owner_name; ?> 
                                  <a href="mailto:<?php echo $ds->goog_owner_email; ?>">
                                  <?php echo $ds->goog_owner_email; ?></a></dd>
                    <dt>Imported</dt><dd><?php echo $ds->date_uploaded; ?></dd>
                </dl>
            </li>
        <?php endforeach; ?>
        </ul>
    </section>
</div><!-- .content -->


<?php include('footer.php'); ?>
