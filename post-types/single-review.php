<?php

/** 
 * Custom post type template
 *
 */

get_header();
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<?php 
		while(have_posts()) : the_post();
			get_template_part('content', 'reviews');
			post_nav();
			if (comments_open() || '0' != get_comments_number()) : comments_template();
			endif;
		endwhile;
		?>
	</main>
</div>

<?php
get_sidebar();
get_footer();
?>