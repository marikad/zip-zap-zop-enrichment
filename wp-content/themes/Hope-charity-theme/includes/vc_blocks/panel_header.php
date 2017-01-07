<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_panel_header extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			"message" => '',
			"icon" => '',
			"link" => '#',
			"target" => '_self',
			"tip" => '',
			"bgcolor" => '#00B7C2',
			"margin_top" => 10,
			"margin_bottom" => 10
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();

        ?>
        
        <?php 
			//$img = wp_get_attachment_image_src($el_image, "large"); 
			//$imgSrc = $img[0];
		?>

        <!-- Element Code start -->
        
        <?php 
		
        if($icon !== ''){
            echo '<div class="pm_span_header" style="margin-bottom:'. esc_attr($margin_bottom) .'px !important; margin-top:'. esc_attr($margin_top) .'px !important; overflow:hidden;"><h4 '. ($bgcolor !== '' ? 'style="background-color:'. esc_attr($bgcolor) .';"' : '') .'><span>'.$message .'</span><a '. ($link !== '' ? 'href="'. esc_url($link) .'"' : '') .' class="'. esc_attr($icon) .' '. ($tip !== '' ? 'pm_tip' : '') .'" title="'.($tip !== '' ? esc_attr($tip) : '').'" target="'. esc_attr($target) .'"></a></h4></div>'; 
            
        } else {
            echo '<div class="pm_span_header" style="margin-bottom:'. esc_attr($margin_bottom) .'px !important; margin-top:'. esc_attr($margin_top) .'px !important; overflow:hidden;"><h4 style="'. ($bgcolor !== '' ? 'background-color:'. esc_attr($bgcolor) .';' : '') .' "><span>'.$message .'</span></h4></div>'; 	
        }
		
		?>
        
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_panel_header",
    "name"      => __("Panel Header", TEXT_DOMAIN),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Hope Shortcodes", TEXT_DOMAIN),
    "params"    => array(
	
		array(
            "type" => "textfield",
            "heading" => __("Message", TEXT_DOMAIN),
            "param_name" => "message",
            //"description" => __("Choose the divider style you desire.", TEXT_DOMAIN),
			"value" => '', //Add default value in $atts
        ),	
	
		array(
            "type" => "textfield",
            "heading" => __("Tooltip Message", TEXT_DOMAIN),
            "param_name" => "tip",
            //"description" => __("Choose the divider style you desire.", TEXT_DOMAIN),
			"value" => '', //Add default value in $atts
        ),	
	
		array(
            "type" => "textfield",
            "heading" => __("Icon", TEXT_DOMAIN),
            "param_name" => "icon",
            "description" => __("Accepts a FontAwesome 4 icon value. (Ex. fa fa-globe)", TEXT_DOMAIN),
			"value" => 'fa fa-globe'
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Link", TEXT_DOMAIN),
            "param_name" => "link",
            //"description" => __("Choose the divider style you desire.", TEXT_DOMAIN),
			"value" => '#', //Add default value in $atts
        ),	
		
		array(
            "type" => "dropdown",
            "heading" => __("Target", TEXT_DOMAIN),
            "param_name" => "target",
            "description" => __("Choose the divider style you desire.", TEXT_DOMAIN),
			"value"      => array( '_self' => '_self', '_blank' => '_blank' ), //Add default value in $atts
        ),
				
		array(
            "type" => "colorpicker",
            "heading" => __("Background Color", TEXT_DOMAIN),
            "param_name" => "bgcolor",
            //"description" => __("Choose the divider style you desire.", TEXT_DOMAIN),
			"value" => '#00B7C2', //Add default value in $atts
        ),	
		
		array(
            "type" => "textfield",
            "heading" => __("Top Margin", TEXT_DOMAIN),
            "param_name" => "margin_top",
            "description" => __("Accepts a positive integer value.", TEXT_DOMAIN),
			"value" => 10, //Add default value in $atts
        ),		
		
		array(
            "type" => "textfield",
            "heading" => __("Bottom Margin", TEXT_DOMAIN),
            "param_name" => "margin_bottom",
            "description" => __("Accepts a positive integer value.", TEXT_DOMAIN),
			"value" => 10, //Add default value in $atts
        ),

    )

));