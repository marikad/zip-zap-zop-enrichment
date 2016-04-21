  
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
		 <?php get_sidebar(); ?>
</header>

<?php
include_once(ABSPATH . WPINC . '/rss.php');
$feed = 'http://miletich2.blogspot.co.uk/feed/';
$rss = fetch_feed($feed);
if (!is_wp_error( $rss ) ) :
        $maxitems = $rss->get_item_quantity(3);
    $rss_items = $rss->get_items(0, $maxitems);
    if ($rss_items):
        echo "<ul>\n";
        foreach ( $rss_items as $item ) : 
            //instead of a bunch of string concatenation or echoes, I prefer the terseness of printf 
            //(http://php.net/manual/en/function.printf.php)
        	printf('<li><a href="%s">%s</a><p>%s</p><p>%s</p></li>',$item->get_permalink(),$item->get_title(),$item->get_date(get_option('date_format')),$item->get_description() );
        endforeach;
        echo "</ul>\n";
    endif;
endif;
?>


<!-- 
<iframe width="560" height="315" src="https://www.youtube.com/embed/89XLwzzcNMA" frameborder="0" allowfullscreen></iframe>
<iframe width="520" height="315" src="https://www.youtube.com/embed/tS94kQwrPLs" frameborder="0" allowfullscreen></iframe> -->
   <?php get_footer(); ?>