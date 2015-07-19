<?php
 /* 
  *
  *  The front page
  *
  *
  */

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
	global $paged;
    global $query_args; 
    $args = array(
        'category_name' => 'homepage-feature-list', 
        'paged'         => $paged
    );
 
    genesis_custom_loop( wp_parse_args($query_args, $args) );
 
}

 genesis();