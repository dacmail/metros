<?php 
	$limit = get_post_meta(get_the_ID(), '_ungrynerd_block_3_count', true);
	if ($limit>0) {
		# code...
		$term = get_term(get_post_meta(get_the_ID(), '_ungrynerd_block_3_tax', true), get_tax_by_term_id(get_post_meta(get_the_ID(), '_ungrynerd_block_2_tax', true)));
		$block_posts = new WP_Query(array(
					'tax_query' => array(
						array(
							'taxonomy' => $term->taxonomy,
							'field'    => 'term_id',
							'terms'    => array($term->term_id),
						)
					),
					'posts_per_page' => $limit,
					'post__not_in' => $posts_excluded
					)); ?>
		<h2 class="block-title"><?php echo $term->name ?></h2>
		<div class="block-wrap">
			<?php include(locate_template('templates/secondary-block.php')); ?>
			<p class="more"><?php echo ungrynerd_tax_anchor($term, '', 'Ir a ' . $term->name); ?></p>
		</div>

		<?php wp_reset_query(); ?>
	<?php } ?>