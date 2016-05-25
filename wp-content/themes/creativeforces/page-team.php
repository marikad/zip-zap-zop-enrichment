  
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
                      <hr>
                    <div class="content-item cf" id="april">
                        <figure>
                            <img alt="" class="bio-pics" src=
                            "/wp-content/themes/creativeforces/images/curric.jpg"
                            width="250px" height="250px;">
                        </figure>
                        <div class="line">
                    <h2 class="text-center exec-header">Our Team</h2>
                </div>
                        <h3 class="name"> Will Todisco</h3>
                        <h5 class="job-title">Curriculum Specialist</h5>
                        <div class="description">
<p>After receiving his B.A. in Theatre, Will toured nationally with a children's theatre company, performing literary classics, which led him to work with students at an Improv-based summer camp for children on the Autism Spectrum.  The Spotlight Program, based out of the NorthEast ARC in Danvers, MA, made the connection between improvisational performance and the social-emotional and social pragmatic growth and development for children on the Spectrum and beyond.   After assisting the SPED department at Edward Devotion, a public school in Brookline, Will moved out to LA to begin work for the LCS SPED program where he was able to develop his Improv(e) Social Skills class that has been offered at each of the LCS campuses over the 2014-2016 school years. </p>
                        </div>
                    </div>
                     <div class="line">
                
          </div>
       </div>
    </div> 


   <?php get_footer(); ?>
