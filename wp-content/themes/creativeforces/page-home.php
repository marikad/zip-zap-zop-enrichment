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
	<title>Creative Forces | Home</title>
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
		 <?php get_sidebar(); ?>
</header>

<div id="carousel1" class="carousel slide" style="width: 100%;" data-ride="carousel">
<ol class="carousel-indicators">
	<li data-target="#carousel1" data-slide-to="0" class="active"></li>
	<li data-target="#carousel1" data-slide-to="1"></li>
</ol>
<div class="carousel-inner">
<div class="item active"><img class="img-responsive" style="width: 100%;" src="/wp-content/themes/creativeforces/images/preschool.jpg" alt="" />
<div class="carousel-caption">
<div class="inner-caption">
<h3 class="carousel-head">Advocates For Play</h3>
<p class="carousel-body">Studies show that play is a
crucial part of a childs development</p>
<button class="btn btn-primary btn-shadow" type="">Learn More</button>

</div>
</div>
</div>
<div class="item"><img class="img-responsive" style="width: 100%;" src="/wp-content/themes/creativeforces/images/kid.jpg" alt="" />
<div class="carousel-caption">
<div class="inner-caption">
<h3 class="carousel-head">Advocates For Play</h3>
<p class="carousel-body">Studies show that play is a
crucial part of a childs development</p>
<button class="btn btn-primary btn-shadow" type="">Learn More</button>

</div>
</div>
</div>
</div>
 <a class="left carousel-control"  href="#carousel1" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="##carousel1" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

<div class="container">
<div class="line">
<p class="text-center who-we-are">Who We Are</p>

</div>
<div class="row">
<div class="space">
<p class="mission col-md-6"><strong>Creative Forces Enrichment (CFE)</strong> provides creative expression and communication education programs for under-served students populations in California public schools focusing on Los Angeles County and Contra Costa County. CFE’s goal is to empower students to effectively communicate with an ever-diversified world by providing innovative, verbal and nonverbal, individualized curriculum.
<button class="btn btn-primary" type="">Learn More</button></p>
<iframe src="https://www.youtube.com/embed/1s02I78mCxg" width="560" height="315" frameborder="0" allowfullscreen="allowfullscreen"></iframe>

</div>
</div>
</div>
<section class="part2">


<div class="container">
<p class="text-center program-head">Programs</p>
	<div class="col-md-6 program-item text-center">
		<img id="image1" class="resize-image img-resonsive col-xs-12" src="/wp-content/themes/creativeforces/images/april2.jpg" alt="" />
		<p class="program-text">Creative Writing</p>
		<p class="program-info">this innovative writing program focuses on free thinking and connecting with others thru the written word</p>
		<button class="btn btn-primary">Learn More</button>
	</div>
		<div class="col-md-6 program-item text-center">
		<img id="image1" class="resize-image img-resonsive col-xs-12" src="/wp-content/themes/creativeforces/images/kidsimprov.jpg" alt="" />
		<p class="program-text">Improv &amp; Comedy</p>
		<p class="program-info">This improv class is a fun and non-stressful way to encourage children and young adults to communicate and build confidence! Students will learn how to think on their feet when expanding on an idea, story, or debate. These classes are inspired by <a href="http://www.zipzapzopimprov.com/">Zip Zap Zop</a></p>
		<button class="btn btn-primary">Learn More</button>
	</div>
</div> 

</section>
<h3 class="text-center">We have partnered with Zip Zap Zop: Improv for Kids! Click <a href=" http://www.zipzapzopimprov.com/" target="_blank" class="click-here">here</a> to learn more</h3>
<a href=" http://www.zipzapzopimprov.com/" target="_blank"><img class="center-block" src="/wp-content/themes/creativeforces/images/zip.jpeg" alt="" /></a>

    
    

<?php get_footer(); ?>

</html>