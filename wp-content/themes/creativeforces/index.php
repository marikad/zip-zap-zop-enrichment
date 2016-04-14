



<html>
<head>
</head>
 
<body>
    <?php get_header(); ?>
  
 
 
        <div id="container">
 
        <div id="content">
            <?php if (!is_page(array('Home','Our Programs','blah3'))) { ?>
           <h4><?php the_title(); ?></h4>       
            <?php } ?>
            <?php while ( have_posts() ) : the_post() ?>
			<?php the_content(); ?>
			<?php endwhile; ?>
		</div>
 
 
        <div id="footer">
            <?php get_footer(); ?>
        </div><!-- #footer -->
	</div>
</body>
</html>




