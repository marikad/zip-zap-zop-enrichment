  
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
	<link rel="stylesheet" type="text/css" href="/wp-content/themes/creativeforces/css/about.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700' rel='stylesheet' type='text/css'>
</head>


<header>
    	<?php while ( have_posts() ) : the_post() ?>
			<?php the_content(); ?>
		<?php endwhile; ?>
		 <?php get_sidebar(); ?>
</header>

   <?php get_header(); ?>

<div class="container">
   <h3 class="text-center text-style">Who Is Zip Zap Zop Enrichment</h3>
   <hr>
   <p> Sisters Maja Miletich and April Rasmussen grew up with a brother, Zack, who is on the autism spectrum. Though very high functioning, for a time he was totally nonverbal. April and Maja became experts on Zack’s needs in order to help support him as he learned to interact with the world around him; a world that was very difficult to access. However, as Zach grew up, he found his voice through writing and has maintained a blog (Clashing with Life) for more than eight years!</p> <p>It was this ability to communicate that gave Zach greater confidence, gave him a way to interact with a world he had been previously cut off from, and gave him access to information so he could grow and learn. Zach was later able to attend college, study information technology, and has a steady job that he takes great pride in. </p>
   <p>Both women were inspired by their brother and both decided to pursue careers in education: Maja studied early childhood development with a focus on special needs, and April pursued secondary language arts with a focus on English language learners. Zip Zap Zop originally began in 2011 after Maja, a graduate of The Second City Improv program, was working in a special needs classroom. She found that many of her improv techniques engaged students who were otherwise unreachable. April became a credentialed English teacher in 2008 and has seen the consequences of high school level students who are not comfortable communicating, whether that be students with special needs or students learning English as a second language.</p>
  </div>



   <?php get_footer(); ?>