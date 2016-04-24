  
<?php

   /**
 * Template Name: Media
 *
 * @package WordPress
 * @subpackage Creativeforces
 * @since  Creativeforces Group 1.0
 */
 ?>
<head>
	<meta charset="utf-8">
	<title>Zip Zap Zop Enrichment | Media</title>
	<link rel="stylesheet" type="text/css" href="/wp-content/themes/creativeforces/css/media.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700' rel='stylesheet' type='text/css'>
</head>

   <?php get_header(); ?>

<header>
    	<?php while ( have_posts() ) : the_post() ?>
			<?php the_content(); ?>
		<?php endwhile; ?>

</header>



<?php
$feed = 'http://miletich2.blogspot.co.uk/feed/';
$rss = fetch_feed($feed);
?>
<div class="container">
<div class="clear">
<div class="right">
<div class="rss-container">
<div class="rss-heading">
<?php
$title = "Clashing With Life";
$description = 'this blog is written by Zack Miletich, Maja Miletich (CEO) and April Miletich (COOs) brother.';
echo '<h3 class="text-center title">' . $title . '</h3>'; 
echo '<p class="text-center">' . $description . '</p>'; 
?>
</div>
<?php
if ( !is_wp_error($rss) ) :
    $maxitems  = $rss->get_item_quantity(3);
    $rss_items = $rss->get_items(0, $maxitems);
    if ($rss_items):
        foreach ($rss_items as $item) :
            $item_title     = esc_attr( $item->get_title() );
            $item_permalink = esc_url( $item->get_permalink() );
            $item_post_date = $item->get_date( get_option('date_format') );
            $item_excerpt   = wp_trim_words( wp_strip_all_tags( $item->get_description(), true ), 50 );
            echo sprintf('<div class="spacing"><a href="%s" target="_blank">%s</a><div class="pull-right">%s</div><p>%s</p><hr></div>', $item_permalink, $item_title, $item_post_date, $item_excerpt);
        endforeach;
    endif;
endif;
?>

</div>
</div>

<div class="text-center">
<div class="title-article"><h3 class="article-head">Check out the article that was written about us!</h3></div>
   <img src="/wp-content/themes/creativeforces/images/la-parent.jpg" alt="" />
   </div>
   <h3 class="text-center article-head"><a href="https://www.laparent.com/special-needs/zip-zap-zop-fun-ideas-for-kids" target="_blank">Theater Improv Games are Fun Ideas For Kids</a></h3>


   <!-- <iframe class="col-md-3"width="560" height="315" src="https://www.youtube.com/embed/89XLwzzcNMA" frameborder="0" allowfullscreen></iframe> -->
   </div>

</div>


  


<div class="container">
   <h3 class="text-center article-head">Zip Zap Zop in Action</h3>
   <div class="row col-md-12">
   <iframe class="col-md-4" width="560" height="315" src="https://www.youtube.com/embed/8ZGa7X11LI0" frameborder="0" allowfullscreen></iframe>
   <iframe class="col-md-4" width="560" height="315" src="https://www.youtube.com/embed/MT2pevN9-qo" frameborder="0" allowfullscreen></iframe>
   <iframe class="col-md-4"width="560" height="315" src="https://www.youtube.com/embed/89XLwzzcNMA" frameborder="0" allowfullscreen></iframe>
   </div>
   </div>




   <?php get_footer(); ?>