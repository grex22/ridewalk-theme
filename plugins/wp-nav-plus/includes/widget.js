jQuery(document).on( 'click', '.toggle_wpnp_option', function() {
	jQuery(this).closest('.wpnp_section_title').next('.wpnp_section_wrap').toggle();
});