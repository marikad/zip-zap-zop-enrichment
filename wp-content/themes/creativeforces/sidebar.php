<?php
/**
 * The sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage Creativeforces
 * @since Creativeforces 1.0
 */

?>
<head>
	<link rel="stylesheet" type="text/css" href="/wp-content/themes/creativeforces/css/sidebar.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700' rel='stylesheet' type='text/css'>
</head>



<?php get_header(); ?>

<div class="page-content-title-wrapper">
    
    <div class="wrap_1280">
       
        <h2 class="page-content-title"><?php the_title(); ?></h2>
    
    <div class="clearfix"></div>
    
    </div><!-- END WRAP_1280 -->
    
</div><!-- END PAGE-CONTENT-TITLE-WRAPPER -->

<div class="wrap_1280">
    
    <div class="main-content">
    
        <div class="left-page-content col-lg-8 col-md-8 col-sm-8 col-xs-8">
         
            <div class="page-content">
                
                
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                
                    <?php the_content(); ?> 

                <?php endwhile; ?>
                
                <?php else: ?>
                
                    <p>No content has been posted to this page.</p>
                    
                <?php endif; ?>
                             
            </div><!-- END PAGE-CONTENT -->
           
        </div><!-- END LEFT-PAGE-CONTENT -->
        
        <?php get_sidebar('page'); ?>

    </div><!-- END MAIN-CONTENT -->
    
</div><!-- END WRAP_1280 -->

<div class="clearfix"></div>

<?php get_footer(); ?>





