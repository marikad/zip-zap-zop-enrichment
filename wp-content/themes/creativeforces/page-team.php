  
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
</header>

  
  <div class="content-wrapper">
       <div class="container">
          <div class="content">
          <div class="line">
                    <h2 class="text-center exec-header">Executive Directors</h2>
                </div>
             <article class="ninecol" role="main">
                <div class="content-item first cf" id="maja">
                   <figure>
                      <img alt="" class="bio-pics" src=
                            "/wp-content/themes/creativeforces/images/majapic.jpg"
                            width="250px">
                   </figure>
                   <h3 class="name">Maja Miletich</h3>
                   <h5 class="job-title">CEO</h5>
                   <div class="description">
                           <p>Maja has worked with children on many levels. Having a brother on the Autism Spectrum has given Maja an understanding of how powerful communication is for ALL children. Maja's education includes a B.A. in Child Development and she is also a graduate of The Second City where she stuided improv and sketch comedy.  Maja has worked for years as a teacher and behaviorist where she practiced emergent curriculum. Maja’s focus is on inclusive classrooms where curriculum is designed to allow children and young adults to feel comfortable expressing themselves in whichever way they feel most comfortable.</p>
                   </div>
                </div>
                      <hr>
                    <div class="content-item cf" id="april">
                        <figure>
                            <img alt="" class="bio-pics" src=
                            "/wp-content/themes/creativeforces/images/april2.jpg"
                            width="250px" height="250px;">
                        </figure>
                        <h3 class="name">April Miletich-Rasmussen, PhD</h3>
                        <h5 class="job-title">COO</h5>
                        <div class="description">
<p>April Rasmussen, PhD has been a credentialed English teacher since 2008 and has taught everything from advanced placement English language and composition to literature through film, and English as a second language support classes. Her passion is for the art of story and also storytelling as a tool for student growth. She  holds advanced degrees in education, mythology and depth-psychology.</p>
                        </div>
                    </div>
                     <div class="line">
                
          </div>
       </div>
    </div> 


   <?php get_footer(); ?>
