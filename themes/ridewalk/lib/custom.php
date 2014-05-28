<?php
/**
 * Custom functions
 */

function ride_walk_scripts() {
	wp_enqueue_style( 'font-awesome', '//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css', array(), '4.0.3' );
	wp_enqueue_style( 'google-font-neo2', '//fonts.googleapis.com/css?family=Exo+2:400,300,200,100', array(), '1.0' );
}
add_action( 'wp_enqueue_scripts', 'ride_walk_scripts' );

function rw_add_image_class($class){
   $class .= ' img-thumbnail';
   return $class;
}
add_filter('get_image_tag_class','rw_add_image_class');

add_shortcode( 'iframe' , 'mycustom_shortcode_iframe' );
function mycustom_shortcode_iframe($args, $content) {
    $keys = array("src", "width", "height", "scrolling", "marginwidth", "marginheight", "frameborder");
    $arguments = mycustom_extract_shortcode_arguments($args, $keys);
    return '<iframe ' . $arguments . '></iframe>';
}

function mycustom_extract_shortcode_arguments($args, $keys) {
    $result = "";
    foreach ($keys as $key) {
        if (isset($args[$key])) {
            $result .= $key . '="' . $args[$key] . '" ';
        }
    }
    return $result;
}