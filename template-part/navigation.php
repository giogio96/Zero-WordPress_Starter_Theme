<?php

$num_post = wp_count_posts( $loop );
$num_page = ceil($num_post->publish / 9);

if($num_page > 1) : ?>


<nav class="navigation block m30-0 h_align">
    <?php if(isset($_GET['n']) && $_GET['n'] > 1) { ?>
        <a href="?n=1">
            <button class="button page-num skip-page"><?php echo "<<"; ?></button></a>
    <?php } ?>
    
    <?php for($i = 1;$i <= $num_page ;$i++) { ?>
    	<a href="?n=<?php echo $i; ?>"><button class="button page-num <?php if($n == $i) { echo "current-page"; } ?>"><?php echo $i; ?></button></a>
    <?php } ?>
    
    <?php if(!isset($_GET['n']) || $_GET['n'] < $num_page) { ?>
        <a href="?n=<?php echo $num_page ?>">
            <button class="button page-num skip-page"><?php echo ">>"; ?></button></a>
    <?php } ?>
</nav>

<?php endif; ?>