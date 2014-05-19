<?php
	if ( '' != get_field('sub_title') ) :
		?>
		<h2><?php the_field('sub_title');?></h2>
		<?php
	endif;
?>
<?php get_template_part('templates/content', 'single'); ?>
