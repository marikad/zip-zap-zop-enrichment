  
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
include_once(ABSPATH . WPINC . '/rss.php');
$feed = 'http://miletich2.blogspot.co.uk/feed/';
$rss = fetch_feed($feed);
?>
<div class="container">
<div class="right">
<?php
$title = "Clashing With Life";
$description = 'This is a blog written by an autistic person for other autistic people about <br>some of the biggest issues in life, whether deplorable or marvelous.';
echo '<h3 class="text-right">' . $title . '</h3>'; 
echo '<p class="text-right">' . $description . '</p>'; 
if (!is_wp_error( $rss ) ) :
        $maxitems = $rss->get_item_quantity(3);
    $rss_items = $rss->get_items(0, $maxitems);
    if ($rss_items):
        echo "<ul>\n";
        foreach ( $rss_items as $item ) : 
            //instead of a bunch of string concatenation or echoes, I prefer the terseness of printf 
            //(http://php.net/manual/en/function.printf.php)

        	printf('<div class="text-right"><li><a href="%s">%s</a><p>%s</p><p>%s</p></li></div>',$item->get_permalink(),$item->get_title(),$item->get_date(get_option('date_format')),$item->get_description() );
        endforeach;
        echo "</ul>\n";
    endif;
endif;
?>
</div>
</div>

<div class="container">
<div class="row">
<iframe width="560" class="col-md-4" height="315" src="https://www.youtube.com/embed/MT2pevN9-qo" frameborder="0" allowfullscreen></iframe>
<iframe width="560"  class="col-md-4" height="315" src="https://www.youtube.com/embed/89XLwzzcNMA" frameborder="0" allowfullscreen></iframe>
<iframe width="560" class="col-md-4" height="315" src="https://www.youtube.com/embed/tS94kQwrPLs" frameborder="0" allowfullscreen></iframe>
 </div> 
 </div> 


   <?php get_footer(); ?>