<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "site-content" div and all content after.
 *
 * @package WordPress
 * @subpackage Creativeforces
 * @since Creativeforces1.0
 */
?>
<!-- .site-content -->
<div class="container">
	<footer>
		<div>
			<?php
				/**
				 * Fires before the  Creatievforces footer text for footer customization.
				 *
				 * @since Creatievforces
				 */
				do_action( 'Creativeforces_credits' );
			?>
		</div><!-- .site-info -->
	</footer><!-- .site-footer -->


<!-- .site -->


<div class="row">
        <div class="text-center spacing">
            <a href=""><img src="/wp-content/themes/creativeforces/images/facebook.png" alt="" class="spacing"></a>
            <a href=""><img src="/wp-content/themes/creativeforces/images/twitter.png" alt="" class="spacing"></a>
            <a href=""><img src="/wp-content/themes/creativeforces/images/pinterest.png" alt="" class="spacing"></a>

	<div class="text-center copy">&copy; Zip Zap Zop Enrichment <?php echo date("Y") ?></div>
		 
 </div>
   </div>
    </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

</body>
</html>