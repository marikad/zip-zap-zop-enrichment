  
<?php

   /**
 * Template Name: Advisory
 *
 * @package WordPress
 * @subpackage Creativeforces
 * @since  Creativeforces Group 1.0
 */
 ?>
<head>
	<meta charset="utf-8">
	<title>Zip Zap Zop Enrichment | Advisory Board</title>
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
             <article class="ninecol" role="main">
                
                     <div class="line">
                <h3 class="text-center exec-header">Advisory Board</h3>
            </div>

              <div class="content-item first cf" id="oscar">
                <figure>
                    <img alt="" class="bio-pics" src=
                    "/wp-content/themes/creativeforces/images/ari.jpg" width=
                    "250px">
                </figure>
                <h3 class="name">Oscar Madrigal</h3>
                <h5 class="job-title">President</h5>
                <div class="description">
<p>A one-time student of the Watts Towers Arts Center, Oscar has spent a career working in the nonprofit sector, being driven by a desire to help people and serve his community. A graduate of UCLA with a degree in English, Oscar has put his writing talents to use in technical writing, grant reports, and proposals. Oscar is a single father of two boys with Autism, growing and learning about the disorder and how to be a parent to children with autism, discovering how to advocate for them and acquiring the knowledge to navigate the many hurdles and bureaucracies that that befall parents of children with Autism. Oscar is now currently working in special education, where he can use his experience as a parent to help more students with compassion, understanding and dedication. Oscar’s writing has been published in literary journals, college newspapers, and technical reports. For the past few years Oscar has served on the board of various non-profits and been an active participant and parent advocate in the autism community. Oscar lives and works in South Los Angeles.</p>
                </div>
            </div>
            <hr>

            <div class="content-item first cf" id="ari">
                <figure>
                    <img alt="" class="bio-pics" src=
                    "/wp-content/themes/creativeforces/images/ari.jpg" width=
                    "250px">
                </figure>
                <h3 class="name">Ari Schenider</h3>
                <h5 class="job-title">Vice President</h5>
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
