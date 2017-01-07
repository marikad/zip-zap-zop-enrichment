<?php get_header(); ?>

<div class="container pm_paddingVertical60">
    <div class="row">
		
        <div class="span12">            
            <h5><?php esc_attr_e('The page you we\'re looking for could not be found.',TEXT_DOMAIN); ?></h5>
            <p><?php esc_attr_e('Head back to the',TEXT_DOMAIN); ?> <a href="<?php echo home_url(); ?>"><?php esc_attr_e('home page',TEXT_DOMAIN) ?></a></p>
		</div>
        
	</div>
</div>

<?php get_footer(); ?>