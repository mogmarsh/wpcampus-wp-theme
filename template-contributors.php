<?php

/**
 * Template Name: WPCampus Contributors
 */

$users = new WP_User_Query( array(
	'number'                => -1,
	'orderby'               => 'name',
	'order'                 => 'ASC',
	'has_published_posts'   => array( 'post', 'podcast', 'video' ),
));

get_header();

if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();

		wpcampus_print_article();

	endwhile;
endif;

// Print user registration promo.
wpcampus_print_user_reg_promo();

if ( empty( $users->results ) ) :

	?>
	<p><?php _e( 'There are no contributors.', 'wpcampus' ); ?></p>
	<?php
else :

	do_action( 'wpcampus_before_contributors' );

	?>
	<div class="wpcampus-contributors">
		<?php

		foreach ( $users->results as $user ) :
			wpcampus_print_contributor( $user->ID );
		endforeach;

		?>
	</div><!--.wpcampus-contributors-->
	<?php

	do_action( 'wpcampus_after_contributors' );

endif;

get_footer();
