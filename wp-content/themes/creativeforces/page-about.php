  
<?php

   /**
 * Template Name: About Us
 *
 * @package WordPress
 * @subpackage Creativeforces
 * @since  Creativeforces Group 1.0
 */
 ?>
<head>
	<meta charset="utf-8">
	<title>Zip Zap Zop Enrichment | About Us</title>
	<link rel="stylesheet" type="text/css" href="/wp-content/themes/creativeforces/css/team.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700' rel='stylesheet' type='text/css'>
</head>


<header>
    	<?php while ( have_posts() ) : the_post() ?>
			<?php the_content(); ?>
		<?php endwhile; ?>
		 <?php get_sidebar(); ?>
</header>

   <?php get_header(); ?>

   <h1>Who Is Zip Zap Zop Enrichment</h1>



   <?php get_footer(); ?>