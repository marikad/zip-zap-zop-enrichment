  
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


<iframe width="560" height="315" src="https://www.youtube.com/embed/89XLwzzcNMA" frameborder="0" allowfullscreen></iframe>
<iframe width="520" height="315" src="https://www.youtube.com/embed/tS94kQwrPLs" frameborder="0" allowfullscreen></iframe>
   <?php get_footer(); ?>