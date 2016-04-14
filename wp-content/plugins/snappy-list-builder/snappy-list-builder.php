<?php
/*
Plugin Name: Snappy List Builder
Plugin URI: http://wordpressplugincourse.com/plugins/snappy-list-builder
Description: The ultimate email list building plugin for WordPress. Capture new subscribers. Reward subscribers with a custom download upon opt-in. Build unlimited lists. Import and export subscribers easily with .csv
Version: 1.0.1.2
Author: Marika Devan
Author URI: http://joelfunk.codecollege.ca
License: GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: snappy-list-builder
*/


/* Hooks */

//register all our custom shortcodes on init
add_action('init', 'slb_register_shortcode');

/* Shortcodes */

//requires all our custom shortcodes
function slb_register_shortcode(){
	//sl;b form is the name of our shortcode 
	//slb_form_shortcode is the funtion we want to run when our shortcode is called
add_shortcode('slb_form', 'slb_form_shortcode');
}

//return html string for form
function slb_form_shortcode($args, $content=""){
//setup output variable - form html

	$output = '
	<div class="slb">
		<form id="slb_form" name="slb_form" class="slb-form" method="post">
			<p class="slb-input-]]container">
				<label>Your Name</label><br />
				<input type="text" name="slb_fname" placeholder="First Name">
			</p>
			<p class="slb-input-container">
				<label>Your Email;</label><br />
				<input type="email" name="slb_email" placeholder="First Name">
			</p>';
//if content is included in the form this if statement will run
			if(strlen($content)):
			$output .= '<div class="slb-content">' .  wpautop($content) . '</div>';

			endif;

			//completing out form html
			$output .= '<p class="slb-input-container">
				<input type="submit" name="slb_submit" value="Sign Me Up!">
			</p>
		</form>
	</div>
	
	';
//return our form
	return $output;

}

?>