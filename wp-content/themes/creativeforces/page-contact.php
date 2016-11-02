  

<?php

   /**
 * Template Name: Contact Us
 *
 * @package WordPress
 * @subpackage Creativeforces
 * @since  Creativeforces Group 1.0
 */

 ?>
<head>
	<meta charset="utf-8">
	<title>Zip Zap Zop Enrichment | Contact Us</title>
	<link rel="stylesheet" type="text/css" href="/wp-content/themes/creativeforces/css/contact.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700' rel='stylesheet' type='text/css'>
</head>


<header>
    	<?php while ( have_posts() ) : the_post() ?>
			<?php the_content(); ?>
		<?php endwhile; ?>
</header> 

   <?php get_header(); ?>
<div class="form-container">
<div class="contact-heading text-center">
   <h1>Contact Us!</h1>
</div>
<div class="form-content">
<?php echo do_shortcode( '[contact-form-7 id="30" title="contact-form"]'); ?>
</div>
</div>

<!-- <div class="form-container">
   <div class="contact-heading text-center">
      <h1>Contact</h1>
   </div>
   <div class="form-content">
      <form method="post" action="/wp-content/themes/creativeforces/page-contact.php ">
      <div class="content-inner">
         <fieldset class="personal-detail">
            <div class="row">
               <div class="form-group">
                   <input type="text" name="name" class="form-control" id="name" onclick="if(this.defaultValue == this.value) this.value = ''" onblur="if(this.value=='') this.value = this.defaultValue" value="Name">
               </div>
            </div>
               <div class="row">
               <div class="form-group">
                   <input type="text" name="subject" class="form-control" id="subject" onclick="if(this.defaultValue == this.value) this.value = ''" onblur="if(this.value=='') this.value = this.defaultValue" value="Subject">
               </div>
            </div>
             <div class="row">
               <div class="form-group">
                   <input type="text" name="email" class="form-control" id="email" onclick="if(this.defaultValue == this.value) this.value = ''" onblur="if(this.value=='') this.value = this.defaultValue" value="Email">
               </div>
            </div>
               <div class="row">
      <div class="form-group">
      
        <textarea name="message" id="message"cols="30" rows="10" class="form-control" placeholder="Message"></textarea>
      </div>
    </div>
     <div class="row">
      <div class="form-group button">
      <div class="text-center">
      <button id="contact-btn" value="Send" class="btn btn-default">Send</button>
        </div>
      </div>
    </div>
         </fieldset>
         </div>
      </form>
      </div>
   </div> -->





   <?php get_footer(); ?>

      <script src="/wp-content/themes/creativeforces/js/contact.js"></script>