  
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
                            "/wp-content/themes/creativeforces/images/aprilnew.jpg"
                            width="175px">
                        </figure>
                        <h3 class="name">April Miletich-Rasmussen, PhD</h3>
                        <h5 class="job-title">COO</h5>
                        <div class="description">
<p>April Rasmussen, PhD has been a credentialed English teacher since 2008 and has taught everything from advanced placement English language and composition to literature through film, and English as a second language support classes. Her passion is for the art of story and also storytelling as a tool for student growth. She  holds advanced degrees in education, mythology and depth-psychology.</p>
                        </div>
                    </div>
                     <div class="line">
                <h3 class="text-center exec-header">Advisory Board</h3>
            </div>

            <div class="content-item first cf" id="ari">
                <figure>
                    <img alt="" class="bio-pics" src=
                    "/wp-content/themes/creativeforces/images/ari.jpg" width=
                    "250px">
                </figure>
                <h3 class="name">Ari Schenider</h3>
                <h5 class="job-title">President</h5>
                <div class="description">
<p>Ari Schneider is a graduate of The Second City Conservatory and has a (BA) Hons from The Guildford School of Acting in England. He has been a cast member of the all-ages improv review The Really Awesome Improv Show (Voted Best Kid’s Comedy Show) at The Second City in Hollywood for the past 3 years. He also is affiliated with the mentorship program, YSF (The Young Screenwriters Foundation) at New Rhodes as well as teaching afer-school improv with Zip Zap Zop Enrichment: Non-Profit.</p>
                </div>
            </div>
            <hr>
            <div class="content-item first cf" id="debra">
                <figure>
                    <img alt="" class="bio-pics" src=
                    "/wp-content/themes/creativeforces/images/debra.jpg" width=
                    "250px">
                </figure>
                <h3 class="name">Debra Gliozzi</h3>
                <h5 class="job-title">Treasurer</h5>
                <div class="description">
<p>Debra Kratochvil Gliozzi is a first generation American and first in her family to attend college. Her career spans 35 years and two distinct industries. Debra is currently an administrator and educator in Danville, California. She brought her MBA and business experience to San Ramon Valley High School and integrated Business Computers (an ROP course), Personal Finance and Introduction to Business and Entrepreneurship into the curriculum. Debra says that her goal is to equip students with skills that prepare them for the real world. It is the most important thing I can do.</p>
                </div>
            </div>
            <hr>
               <div class="content-item first cf" id="melina">
                <figure>
                    <img alt="" class="bio-pics" src=
                    "/wp-content/themes/creativeforces/images/melina.jpg"
                    width="250px">
                </figure>
                <h3 class="name">Melina Johnson</h3>
                <h5 class="job-title">Secretary</h5>
                <div class="description">
<p>Melina Johnson is a self-employed entrepreneur who created her own home organizing business. Melina is the mother of two children, her son having Autism. She has spent countless hours dedicated to researching and providing her son with the best therapies and services to help him with his growth and development. Every therapist and teacher, over the years, has told Melina that her natural sense of humor has been the best therapy she could provide to her son - Humor and laughter open up doors to cognitive and social development. And it’s fun!</p>
                </div>
            </div>
             </article>
          </div>
       </div>
    </div> 


   <?php get_footer(); ?>
