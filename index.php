<?php 

if(!isset($_GET['n']) || empty($_GET['n']))
    $n = 1;
else 
    $n = $_GET['n'];

$loop = 'post';

get_header(); 

page_header(get_the_title(), 'http://trendycounty.com/media/wysiwyg/internal-about-us.jpg'); ?>

<div class="wrapper_2 p100-10">
    <?php
    $loop = new WP_Query( array(
        'post_type' => $loop,
        'posts_per_page' => 9,
        'paged' => $n,
    ) );
    while($loop->have_posts()) : $loop->the_post(); ?>
        
        
    
    <?php endwhile; ?>
    
    <div class="clear"></div>
</div>

<?php get_footer(); ?>
