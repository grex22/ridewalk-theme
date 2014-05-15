<?php
/**
 * =======================================
 * WP Nav Plus Widget
 * =======================================
 *
 * 
 * @author Matt Keys <matt@mattkeys.me>
 */

class WP_Nav_Plus_Widget extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'description' => __('Add a custom WP Nav Plus menu to your sidebar.') );
		parent::__construct( 'nav_plus_widget', __('WP Nav Plus Menu'), $widget_ops );
	}

	function widget($args, $instance) {

		static $menu_id_slugs = array();

		$nav_menu = ! empty( $instance['nav_menu'] ) ? wp_get_nav_menu_object( $instance['nav_menu'] ) : false;

		if ( ! $nav_menu ) {
			return;
		}

		$wp_nav_menu = wp_nav_menu(
			array(
				'menu'				=> $nav_menu,
				'items_wrap'		=> '%3$s',
				'echo'				=> false,
				'container'			=> false,
				'depth'				=> $instance['depth'],
				'start_depth'		=> ( 0 != $instance['start_depth'] ) ? $instance['start_depth'] : false,
				'divider_html'		=> ( '' != $instance['divider_html'] ) ? $instance['divider_html'] : false,
				'divider_offset'	=> ( 0 != $instance['divider_offset'] ) ? $instance['divider_offset'] : false,
				'limit'				=> ( 0 != $instance['limit'] ) ? $instance['limit'] : false,
				'offset'			=> ( 0 != $instance['offset'] ) ? $instance['offset'] : false
			)
		);

		if ( ! $wp_nav_menu ) {
			return;
		}

		// Attributes
		$wrap_id = 'menu-' . $nav_menu->slug;
		while ( in_array( $wrap_id, $menu_id_slugs ) ) {
			if ( preg_match( '#-(\d+)$#', $wrap_id, $matches ) ) {
				$wrap_id = preg_replace('#-(\d+)$#', '-' . ++$matches[1], $wrap_id );
			} else {
				$wrap_id = $wrap_id . '-1';
			}
		}
		$menu_id_slugs[] = $wrap_id;

		$instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		echo $args['before_widget'];

		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . $instance['title'] . $args['after_title'];
		}

		?>
		<div class="menu-<?php echo $nav_menu->slug; ?>-container">
			<ul id="<?php echo $wrap_id; ?>" class="menu">
				<?php echo $wp_nav_menu; ?>
			</ul>
		</div>
		<?php

		echo $args['after_widget'];
	}

	function update( $new_instance, $old_instance ) {
		$instance['title'] 			= strip_tags( stripslashes($new_instance['title']) );
		$instance['nav_menu'] 		= (int) $new_instance['nav_menu'];
		$instance['depth'] 			= (int) $new_instance['depth'];
		$instance['start_depth'] 	= (int) $new_instance['start_depth'];
		$instance['divider_html'] 	= (string) $new_instance['divider_html'];
		$instance['divider_offset'] = (int) $new_instance['divider_offset'];
		$instance['limit'] 			= (int) $new_instance['limit'];
		$instance['offset'] 		= (int) $new_instance['offset'];
		return $instance;
	}

	function form( $instance ) {
		$title 				= isset( $instance['title'] ) 			? $instance['title'] 			: '';
		$nav_menu 			= isset( $instance['nav_menu'] ) 		? $instance['nav_menu'] 		: '';
		$depth 				= isset( $instance['depth'] ) 			? $instance['depth'] 			: 0;
		$start_depth 		= isset( $instance['start_depth'] ) 	? $instance['start_depth'] 		: 0;
		$divider_html 		= isset( $instance['divider_html'] ) 	? $instance['divider_html'] 	: false;
		$divider_offset 	= isset( $instance['divider_offset'] ) 	? $instance['divider_offset'] 	: 0;
		$limit 				= isset( $instance['limit'] ) 			? $instance['limit'] 			: false;
		$offset 			= isset( $instance['offset'] ) 			? $instance['offset'] 			: false;

		// Get menus
		$menus = wp_get_nav_menus( array( 'orderby' => 'name' ) );

		// If no menus exists, direct the user to go and create some.
		if ( !$menus ) {
			echo '<p>'. sprintf( __('No menus have been created yet. <a href="%s">Create some</a>.'), admin_url('nav-menus.php') ) .'</p>';
			return;
		}
		?>

		<div class="wpnp_section_title"><p><a class="toggle_wpnp_option"><strong><?php _e( 'General Options' ); ?></strong></a></p></div>
		<div class="wpnp_section_wrap">
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:') ?></label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('nav_menu'); ?>"><?php _e('Menu Name:'); ?></label>
				<select id="<?php echo $this->get_field_id('nav_menu'); ?>" name="<?php echo $this->get_field_name('nav_menu'); ?>">
			<?php
				foreach ( $menus as $menu ) {
					echo '<option value="' . $menu->term_id . '"'
						. selected( $nav_menu, $menu->term_id, false )
						. '>'. $menu->name . '</option>';
				}
			?>
				</select>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('depth'); ?>"><?php _e('Depth:'); ?></label>
				<select id="<?php echo $this->get_field_id('depth'); ?>" name="<?php echo $this->get_field_name('depth'); ?>">
					<option value="0" <?php selected( $depth, 0 ); ?>>0 (all)</option>
					<?php for ( $x=1; $x<=10; $x++ ) {
						?>
						<option value="<?php echo $x; ?>" <?php selected( $depth, $x ); ?>><?php echo $x; ?></option>
					<?php } ?>
					<option value="-1" <?php selected( $depth, -1 ); ?>>-1 (flat)</option>
				</select>
			</p>
		</div>
		<div class="wpnp_section_title"><p><a class="toggle_wpnp_option"><strong><?php _e( 'Split Menu Options' ); ?></strong></a></p></div>
		<div class="wpnp_section_wrap">	
			<p>
				<label for="<?php echo $this->get_field_id('start_depth'); ?>"><?php _e('Start Depth:'); ?></label>
				<select id="<?php echo $this->get_field_id('start_depth'); ?>" name="<?php echo $this->get_field_name('start_depth'); ?>">
					<?php for ( $x=0; $x<=10; $x++ ) {
						?>
						<option value="<?php echo $x; ?>" <?php selected( $start_depth, $x ); ?>><?php echo $x; ?></option>
					<?php } ?>
				</select>
			</p>
		</div>
		<div class="wpnp_section_title"><p><a class="toggle_wpnp_option"><strong><?php _e( 'Divided Menu Options' ); ?></strong></a></p></div>
		<div class="wpnp_section_wrap">	
			<p>
				<label for="<?php echo $this->get_field_id('divider_html'); ?>"><?php _e('Divider HTML:'); ?></label>
				<textarea class="widefat" rows="5" cols="20" id="<?php echo $this->get_field_id('divider_html'); ?>" name="<?php echo $this->get_field_name('divider_html'); ?>"><?php echo $divider_html; ?></textarea>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('divider_offset'); ?>"><?php _e('Divider Offset:'); ?></label>
				<select id="<?php echo $this->get_field_id('divider_offset'); ?>" name="<?php echo $this->get_field_name('divider_offset'); ?>">
					<?php for ( $x=-10; $x<=10; $x++ ) {
						?>
						<option value="<?php echo $x; ?>" <?php selected( $divider_offset, $x ); ?>><?php echo $x; ?></option>
					<?php } ?>
				</select>
			</p>
		</div>
		<div class="wpnp_section_title"><p><a class="toggle_wpnp_option"><strong><?php _e( 'Limit / Offset Options' ); ?></strong></a></p></div>
		<div class="wpnp_section_wrap">	
			<p>
				<label for="<?php echo $this->get_field_id('limit'); ?>"><?php _e('Limit:'); ?></label>
				<select id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>">
					<option value="0" <?php selected( $depth, 0 ); ?>>0 (no limit)</option>
					<?php for ( $x=1; $x<=40; $x++ ) {
						?>
						<option value="<?php echo $x; ?>" <?php selected( $limit, $x ); ?>><?php echo $x; ?></option>
					<?php } ?>
				</select>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('offset'); ?>"><?php _e('Offset:'); ?></label>
				<select id="<?php echo $this->get_field_id('offset'); ?>" name="<?php echo $this->get_field_name('offset'); ?>">
					<?php for ( $x=0; $x<=40; $x++ ) {
						?>
						<option value="<?php echo $x; ?>" <?php selected( $offset, $x ); ?>><?php echo $x; ?></option>
					<?php } ?>
				</select>
			</p>
		</div>
		<?php
	}
}

function register_wp_nav_plus_widget() {
	register_widget( 'WP_Nav_Plus_Widget' );
}

add_action( 'widgets_init', 'register_wp_nav_plus_widget' );

function enqueue_wp_nav_plus_scripts( $hook ) {
 
	if ( 'widgets.php' != $hook ) {
		return;
	}
 
	wp_enqueue_script( 'wp-nav-plus-widget-js', WPNP_PUBLIC_PATH . 'includes/widget.js' );
	wp_enqueue_style( 'wp-nav-plus-widget-css', WPNP_PUBLIC_PATH . 'includes/widget.css' );



}
add_action('admin_enqueue_scripts', 'enqueue_wp_nav_plus_scripts');

