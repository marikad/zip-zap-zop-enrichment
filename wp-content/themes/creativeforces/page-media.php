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


<h2 class="article-head text-center">Press</h2>

<div class="text-center">
<h3 class="article-head">Check out this exclusive interview discussing Zip Zap Zop Enrichment and the power of inclusion!</h3>
<iframe width="560" height="315" src="https://www.youtube.com/embed/YMY0RDj3dzo" frameborder="0" allowfullscreen></iframe>

 </div>
<div class="text-center">
<div class="title-article"><h3 class="article-head">Check out the article that was written about us!</h3></div>
  </div>
  <div class="text-center">
   <img src="/wp-content/themes/creativeforces/images/la-parent.jpg" alt="" />
</div>

   <h3 class="text-center article-head"><a href="https://www.laparent.com/special-needs/zip-zap-zop-fun-ideas-for-kids" target="_blank">Click here to read the article</a></h3> 

  <hr>

<h2 class="text-center">Classroom Games</h2>
<div class="text-center">
<iframe width="560" height="315" src="https://www.youtube.com/embed/o20xZMcQOBU" frameborder="0" allowfullscreen></iframe>
</div>


<div class="container">
<hr>
   <h3 class="text-center article-head">Zip Zap Zop in Action</h3>
   <div class="row col-md-12">
   <iframe class="col-md-4" width="560" height="315" src="https://www.youtube.com/embed/8ZGa7X11LI0" frameborder="0" allowfullscreen></iframe>
   <iframe class="col-md-4" width="560" height="315" src="https://www.youtube.com/embed/MT2pevN9-qo" frameborder="0" allowfullscreen></iframe>
   <iframe class="col-md-4"width="560" height="315" src="https://www.youtube.com/embed/89XLwzzcNMA" frameborder="0" allowfullscreen></iframe>
   </div>
   <div class="row col-md-12">
   <iframe class="col-md-4" width="560" height="315" src="
https://www.youtube.com/embed/YzGoBK7X208" frameborder="0" allowfullscreen></iframe>
   <iframe class="col-md-4" width="560" height="315" src="https://www.youtube.com/embed/tS94kQwrPLs" frameborder="0" allowfullscreen></iframe>
   <iframe class="col-md-4"width="560" height="315" src="https://www.youtube.com/embed/4uqqxmbB8F8" frameborder="0" allowfullscreen></iframe>
   </div>
</div>


   <?php get_footer(); ?>