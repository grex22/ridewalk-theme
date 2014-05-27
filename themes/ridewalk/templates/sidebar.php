
<div class="cta-widget ride">
	<a href="#" class="icon bike"></a>
	<h3><a href="#">Planning a Ride?</a></h3>
	<p>View our Ride Guide!</p>
</div>

<div class="cta-widget trails">
	<a href="<?php echo get_permalink(92); ?>" class="icon bike"></a>
	<h3><a href="<?php echo get_permalink(92); ?>">Trouble on the Trails?</a></h3>
	<p><a href="<?php echo get_permalink(92); ?>">Report a Problem!</a></p>
</div>

<?php dynamic_sidebar('sidebar-primary'); ?>

<div class="upcoming-events-widget">
	<h1>Upcoming Events <i class="fa fa-calendar"></i></h1>
	<?php
		$upcommin_events_args = array(
		'posts_per_page'	=> 3,
		'post_type'			=> 'post',
		'post_status'		=> 'publish',
		'cat'				=> 3
	);

	$upcommin_events = new WP_Query( $upcommin_events_args );

	while ( $upcommin_events->have_posts() ) : $upcommin_events->the_post();

		?>
		<div class="event-row">
			<time datetime="<?php the_time( 'Y-m-d' ); ?>"><?php the_time( 'F j, Y' ); ?></time>
			<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		</div>
		<?php

	endwhile;

	wp_reset_postdata();
	?>
	<a href="#" role="button" class="btn btn-default">Full Calendar</a>
</div>