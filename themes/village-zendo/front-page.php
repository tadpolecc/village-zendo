<?php
 /* 
  *
  *  The front page
  *
  *
  */

// Call to Action sidebar
add_action( 'genesis_before_loop', 'tc_main_cta' );
function tc_main_cta() {
	if ( is_active_sidebar( 'main-cta' ) ) { ?>
		<aside class="main-cta">
			<?php dynamic_sidebar( 'main-cta' ); ?>
		</aside>
	<?php }
}

// Remove main loop and replace with a loop targeting Homepage Feature List category
remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'tc_home_loop' );
function tc_home_loop() {
    global $query_args; 
    $args = array(
        'category_name' => 'homepage-feature-list', 
        'posts_per_page' => 3
    ); 
    remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
    remove_action( 'genesis_entry_content', 'genesis_do_post_content' );
    remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
    remove_action( 'genesis_after_endwhile', 'genesis_posts_nav' );
?>
 	
 	<h2>Features:</h2>
    <?php genesis_custom_loop( wp_parse_args($query_args, $args) );
 
}

 genesis();