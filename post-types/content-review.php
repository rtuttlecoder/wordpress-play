<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
	if (has_post_thumbnail()) {
		echo '<div class="single-post-thumbnail clear">';
		echo '<div class="image-shifter">';
		echo the_post_thumbnail('large-thumb');
		echo '</div></div>';
	}
	?>

	<header class="entry-header">

		<?php
		$category_list = get_the_category_list(__(', ', 'my-simone'));
		if (my_simone_categorized_blog()) {
			// blah blah
		}
		?>
	</header>
</article>