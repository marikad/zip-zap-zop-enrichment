  
<?php

   /**
 * Template Name: Our Team
 *
 * @package WordPress
 * @subpackage Creativeforces
 * @since  Creativeforces Group 1.0
 */
 ?>
<head>
	<meta charset="utf-8">
	<title>Zip Zap Zop Enrichment | Our Team</title>
	<link rel="stylesheet" type="text/css" href="/wp-content/themes/creativeforces/css/team.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700' rel='stylesheet' type='text/css'>
</head>

	
   <?php get_header(); ?>


   

<header>
        <?php while ( have_posts() ) : the_post() ?>
            <?php the_content(); ?>
        <?php endwhile; ?>
         <?php get_sidebar(); ?>
</header>         



   <?php get_footer(); ?>
