<?php
/**
 * Template Name: Home Page
 *
 * @package WordPress
 * @subpackage Creativeforces
 * @since  Creativeforces Group 1.0
 */
 ?>
<head>
	<meta charset="utf-8">
	<title>Zip Zap Zop Enrichment | Home</title>
	<link rel="stylesheet" type="text/css" href="/wp-content/themes/creativeforces/css/home.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700' rel='stylesheet' type='text/css'>
</head>
<html>
<?php get_header(); ?>
<body>
<header>
    	<?php while ( have_posts() ) : the_post() ?>
			<?php the_content(); ?>
		<?php endwhile; ?>
</header>


<!-- <div class="carousel-inner">
<div class="item active">

<img class="img-responsive" style="width: 100%;" src="/wp-content/themes/creativeforces/images/preschool.jpg" alt="" />
<div class="carousel-caption">
<div class="inner-caption">
<h3 class="carousel-head">Zip Zap Zop Enrichment<br> a Non-Profit:</h3>
	<p class="carousel-body"><em>empowering children of ALL abilities!!</em></p>


</div>
</div>
</div>
<div class="item">

<img class="img-responsive" style="width: 100%;" src="/wp-content/themes/creativeforces/images/kid.jpg" alt="" />
<div class="carousel-caption">
<div class="inner-caption">
<h3 class="carousel-head">Advocates For Play</h3>
<p class="carousel-body">Studies show that play is a
crucial part of a childs development</p>
<button class="btn btn-primary btn-shadow" type="">Learn More</button>

</div>
</div>
</div>
</div> -->
<div class="text-center">
<iframe  src="https://www.youtube.com/embed/Wmqd_Wq5NRY" width="560" height="315" frameborder="0" allowfullscreen="allowfullscreen"></iframe>
</div>
<div class="container">
<div class="line">
<p class="text-center who-we-are">Who We Are</p>

</div>
<div class="text-center">
<div class="space">
<p class="mission"><strong>Mission</strong><br> Our mission is to empower students with and without special needs by creating inclusive learning opportunities.<br><br>

<strong>Vision </strong><br>
	<strong>Zip Zap Zop Enrichment</strong> provides creative writing and improvisation classes to students in California. <br><br>


<strong>Zip Zap Zop Enrichment</strong>  aims to develop verbal and nonverbal communication skills through improv and creative writing.<br><br>

<strong>Zip Zap Zop Enrichment</strong>  wishes to unlock the creative potential of students of all abilities.
</p>

<!-- <iframe class="col-md-6" src="https://www.youtube.com/embed/YzGoBK7X208" width="560" height="315" frameborder="0" allowfullscreen="allowfullscreen"></iframe> -->

</div>
</div>
</div>
<section class="part2">
<div class="container">
<p class="text-center program-head">What is Improv?</p>

<div class="row">
<div class="col-md-6 program-item text-center"><img id="image1" class="resize-image" src="/wp-content/themes/creativeforces/images/kidsimprov.jpg" alt="" /></div>
<div class="col-md-6">
<p class="program-info">Improv is an incredibly powerful tool in that it can seamlessly incorporate non-verbal students and allow students to enhance their sense of community. One way to define improv as an educational tool is that improv allows you to create new ideas and concepts spur of the moment.</p>
<p class="program-info">These thoughts can be written out, verbally communicated, and non-verbally communicated in many ways. Improv is a term to represent games and activities that aid in socialization including creative writing, performance type games, and team building exercises.</p>

</div>
</div>
</div>
</section>
	<h3 class="text-center">Zip Zap Zop is a project of Social and Environmental Entrepreneurs (SEE), a registered 501(c)3.</h3>
<a href=" http://www.zipzapzopimprov.com/" target="_blank"><img class="center-block" src="/wp-content/themes/creativeforces/images/partner.jpg" alt="" /></a>

    
    

<?php get_footer(); ?>

</html>