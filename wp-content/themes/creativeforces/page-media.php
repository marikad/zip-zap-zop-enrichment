  
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






  


<div class="container">
   <h3 class="text-center article-head">Zip Zap Zop in Action</h3>
   <div class="row col-md-12">
   <iframe class="col-md-4" width="560" height="315" src="https://www.youtube.com/embed/8ZGa7X11LI0" frameborder="0" allowfullscreen></iframe>
   <iframe class="col-md-4" width="560" height="315" src="https://www.youtube.com/embed/MT2pevN9-qo" frameborder="0" allowfullscreen></iframe>
   <iframe class="col-md-4"width="560" height="315" src="https://www.youtube.com/embed/89XLwzzcNMA" frameborder="0" allowfullscreen></iframe>
   </div>
   <div class="row col-md-12">
   <iframe class="col-md-4" width="560" height="315" src="https://www.youtube.com/embed/8ZGa7X11LI0" frameborder="0" allowfullscreen></iframe>
   <iframe class="col-md-4" width="560" height="315" src="https://www.youtube.com/embed/MT2pevN9-qo" frameborder="0" allowfullscreen></iframe>
   <iframe class="col-md-4"width="560" height="315" src="https://www.youtube.com/embed/89XLwzzcNMA" frameborder="0" allowfullscreen></iframe>
   </div>
</div>


   <?php get_footer(); ?>