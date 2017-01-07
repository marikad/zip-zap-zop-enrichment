<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_standard_button extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(	
			"btn_text" => '',
			"color" => '#ACDB05',
			"textcolor" => '#ffffff',
			"type" => 'small',
			"url" => '#',
			"target" => '_self',
			"margin" => 10,
			"icon" => 'fa fa-chevron-right'
			), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();

        ?>
        
        <?php 
			//$img = wp_get_attachment_image_src($el_image, "large"); 
			//$imgSrc = $img[0];
		?>

        <!-- Element Code start -->
        
        <a class="button-<?php esc_attr_e($type); ?>" style="background-color:<?php esc_attr_e($color); ?>; margin:<?php esc_attr_e($margin); ?>px 0;" href="<?php echo esc_url($url); ?>" target="<?php esc_attr_e($target); ?>"><span style="color:<?php esc_attr_e($textcolor); ?> !important;"><?php esc_attr_e($btn_text); ?></span><i class="<?php esc_attr_e($icon); ?>" style="color:<?php esc_attr_e($textcolor); ?> !important;"></i></a>
        
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_standard_button",
    "name"      => __("Button", TEXT_DOMAIN),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Hope Shortcodes", TEXT_DOMAIN),
    "params"    => array(

		array(
            "type" => "textfield",
            "heading" => __("Button Text", TEXT_DOMAIN),
            "param_name" => "btn_text",
            //"description" => __("Enter a CSS class if required.", TEXT_DOMAIN),
			"value" => ''
        ),
	
		array(
            "type" => "textfield",
            "heading" => __("Link", TEXT_DOMAIN),
            "param_name" => "url",
            //"description" => __("Enter a CSS class if required.", TEXT_DOMAIN),
			"value" => '#'
        ),

		
		array(
            "type" => "dropdown",
            "heading" => __("Target Window", TEXT_DOMAIN),
            "param_name" => "target",
            "description" => __("Set the target window for the button.", TEXT_DOMAIN),
			"value"      => array( '_self' => '_self', '_blank' => '_blank' ), //Add default value in $atts
        ),
		
		
		array(
            "type" => "textfield",
            "heading" => __("Margin Spacing", TEXT_DOMAIN),
            "param_name" => "margin",
            "description" => __("Accepts a positive integer value.", TEXT_DOMAIN),
			"value" => 10
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Icon", TEXT_DOMAIN),
            "param_name" => "icon",
            "description" => __("Accepts a FontAwesome 4 icon value. (Ex. fa fa-angle-right)", TEXT_DOMAIN),
			"value" => 'fa fa-chevron-right'
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Color", TEXT_DOMAIN),
            "param_name" => "color",
            //"description" => __("Enter an icon value.", TEXT_DOMAIN),
			"value" => '#ACDB05'
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Text Color", TEXT_DOMAIN),
            "param_name" => "textcolor",
            //"description" => __("Enter an icon value.", TEXT_DOMAIN),
			"value" => '#ffffff'
        ),	
		
		array(
            "type" => "dropdown",
            "heading" => __("Button Type", TEXT_DOMAIN),
            "param_name" => "type",
            "description" => __("Set the size of your button.", TEXT_DOMAIN),
			"value"      => array( 'small' => 'small', 'medium' => 'medium', 'large' => 'large' ), //Add default value in $atts
        ),
		
		/*array(
            "type" => "dropdown",
            "heading" => __("Button Type", TEXT_DOMAIN),
            "param_name" => "button_type",
            //"description" => __("Adds a rollover animation effect to the icon.", TEXT_DOMAIN),
			"value"      => array( 'opaque' => 'opaque', 'transparent' => 'transparent' ), //Add default value in $atts
        ),
				
		array(
            "type" => "textfield",
            "heading" => __("Class", TEXT_DOMAIN),
            "param_name" => "class",
            "description" => __("Apply a custom CSS class if required.", TEXT_DOMAIN),
			"value" => ''
        ),*/


    )

));