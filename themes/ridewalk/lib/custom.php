<?php
/**
 * Custom functions
 */

function ride_walk_scripts() {
	wp_enqueue_style( 'font-awesome', '//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css', array(), '4.0.3' );
	wp_enqueue_style( 'google-font-neo2', '//fonts.googleapis.com/css?family=Exo+2:400,300,200,100', array(), '1.0' );
}
add_action( 'wp_enqueue_scripts', 'ride_walk_scripts' );