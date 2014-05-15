<div class="hero_wrap">
	<ul class="hero_images">
	<?php
		if( have_rows('hero_images') ):
		 
		    while ( have_rows('hero_images') ) : the_row();
		        ?>
		        <li style="background-image:url('<?php the_sub_field('image'); ?>');"></li>
		        <?php
		    endwhile;
		 
		endif;
	?>
	</ul>
	<div class="hero_pager"></div>
	<div class="container">
		<div class="row">
			<div class="cta-bar col-lg-offset-2 col-lg-8"><span>Making a better place to live, work, and play.</span><button type="button" class="pull-right btn btn-xl btn-primary">Area Maps</button></div>
		</div>
	</div>
</div>

<div class="home_row miles">
	<div class="container">
		<div class="row">
	  		<div class="col-md-4 left">
	  			<div class="icon bike"><a href="#">View our area Ride Guide!</a></div>
	  			<h1>Our Community Enjoys:</h1>
	  		</div>
	  		<div class="col-md-8 right">
	  			<div class="miles_wrap">
	  				<div class="counts"><span><?php the_field('bikeway_miles'); ?> miles</span></div>
	  				<div class="desc"><span>of Kosciusko County Bikeways</span></div>
	  			</div>
	  			<div class="miles_wrap">
	  				<div class="counts"><span><?php the_field('greenway_miles'); ?> miles</span></div>
	  				<div class="desc"><span>of Greenways</span></div>
	  			</div>
	  			<div class="miles_wrap">
	  				<div class="counts"><span><?php the_field('bike_lane_miles'); ?> miles</span></div>
	  				<div class="desc"><span>of Bike Lanes</span></div>
	  			</div>
	  			<div class="miles_wrap">
	  				<div class="counts"><span><?php the_field('sidepath_miles'); ?> miles</span></div>
	  				<div class="desc"><span>of Sidepaths</span></div>
	  			</div>
	  			<div class="miles_wrap">
	  				<div class="counts"><span><?php the_field('signed_route_miles'); ?> miles</span></div>
		  			<div class="desc"><span>of Signed Routes</span></div>
		  		</div>
	  			<div class="miles_wrap">
	  				<div class="counts"><span><?php the_field('mountain_bike_miles'); ?> miles</span></div>
	  				<div class="desc"><span>of Mountain Bike Trails</span></div>
	  			</div>
	  			<div class="icon signs"></div>
	  			<div class="icon map"></div>
	  		</div>
	  	</div>
	</div>
</div>

<div class="home_row updates">
	<div class="container">
		<div class="row">
	  		<div class="col-lg-8 left">
	  			<h1>Latest Updates <i class="fa fa-comments-o"></i></h1>
	  			<?php
	  				$latest_updates_args = array(
						'posts_per_page'	=> 1,
						'post_type'			=> 'post',
						'post_status'		=> 'publish',
						'cat'				=> 1
					);
					
					$latest_updates = new WP_Query( $latest_updates_args );

					while ( $latest_updates->have_posts() ) : $latest_updates->the_post();

						if ( has_post_thumbnail() ) :
							the_post_thumbnail( 'medium', 'class=pull-left' );
						endif;

						?>
						<div class="news-row clearfix">
							<time datetime="<?php the_time( 'Y-m-d' ); ?>">Posted <?php the_time( 'F j, Y' ); ?></time>
							<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
							<p><?php the_excerpt(); ?></p>
						</div>

						<a href="#" role="button" class="btn btn-default">More News</a>
						<?php

					endwhile;

					wp_reset_postdata();
				?>

	  		</div>
	  		<div class="col-lg-4 right">
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
	  	</div>
	</div>
</div>