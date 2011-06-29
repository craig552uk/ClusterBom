<?php
/**
 * Dashboard View 
 *
 * This is the default view for a logged in user
 *
 */
?>

<?php include('header.php'); ?>
	
<nav id="content-nav">
    <ul class="hlist">
        <li><a id="selected" href="<?php echo BASE_URL ?>">Dashboard</a></li>
        <li><a href="<?php echo BASE_URL . 'dataset' ?>">Datasets</a></li>
        <li><a href="<?php echo BASE_URL . 'visualisation' ?>">Visualisations</a></li>
    </ul>
</nav><!-- #content-nav -->

<div class="content">

    <div class="clearfix">
        <section class="column left">
            <h1>Welcome to ClusterBom</h1>
            <div class="scroll">
                <p>Lorem ipsum dolor sit amet augue. Est aliquam metus. Ipsum 
                arcu odio. Sed consectetuer nec elementum lacinia a sapien dis 
                arcu in feugiat et. Ligula vulputate lacinia gravida eu elit.
                Consequat soluta luctus. Rutrum quis potenti. Et quam lobortis 
                orci sed id. Sociis quis faucibus mi sed eros dignissim dui mi. 
                Gravida sit vitae ridiculus sem ultricies leo ad cras. Nunc 
                velit bibendum. Facilisis congue ligula. Amet placerat lacus et 
                lacinia hendrerit mauris nam lacus magna at eleifend nam dapibus
                odio. Elit risus cras sit libero fringilla. Suspendisse ac in.</p>
            </div>
        </section>
        
        <section class="column right">
            <h1>Account Usage</h1>
            <div class="scroll">
                <dl>
                    <dt>Package<dt>
                        <dd>Free<dd>
                    <dt>Dataset Allowance<dt>
                        <dd>Unlimited</dd>
                    <dt>Visualisation Allowance<dt>
                        <dd>Unlimited</dd>
                <dl>
                <p><a href="#">Upgrade</a></p>
            </div>
        </section>
    </div>
    
    <div class="clearfix">    
        <section class="column left">
            <h1>Welcome to ClusterBom</h1>
            <div class="scroll">
            
            </div>
        </section>
        
        <section class="column right">
            <h1>Latest News</h1>
            <div class="scroll">
                <ul>
                    <li>
                        <h2>New Data Sets Available</h2>
                        <p>Lorem ipsum dolor sit amet augue. Est aliquam metus. 
                        Ipsum arcu odio. Sed consectetuer nec elementum lacinia 
                        a sapien dis arcu in feugiat et. Ligula vulputate 
                        lacinia gravida eu elit.</p>
                    </li>
                    <li>
                        <h2>New Features</h2>
                        <p>Lorem ipsum dolor sit amet augue. Est aliquam metus. 
                        Ipsum arcu odio. Sed consectetuer nec elementum lacinia 
                        a sapien dis arcu in feugiat et. Ligula vulputate 
                        lacinia gravida eu elit.</p>
                    </li>
                    <li>
                        <h2>Other Things</h2>
                        <p>Lorem ipsum dolor sit amet augue. Est aliquam metus. 
                        Ipsum arcu odio. Sed consectetuer nec elementum lacinia 
                        a sapien dis arcu in feugiat et. Ligula vulputate 
                        lacinia gravida eu elit.</p>
                    </li>
                <ul>
            </div>
        </section>    
    </div>
</div><!-- .content -->

<?php include('footer.php'); ?>
