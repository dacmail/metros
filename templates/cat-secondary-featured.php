<?php $featured = new WP_Query(array('tax_query' => array(
											array(
												'taxonomy' => $term->taxonomy,
												'field'    => 'term_id',
												'terms'    => array($term->term_id),
											)
										),
										'meta_key' => '_ungrynerd_cat_featured2', 
										'meta_value' => 1, 
										'posts_per_page' => 1,
										'post__not_in' => $posts_excluded
										)); ?>
<?php if ($featured->have_posts()) : ?>
	<div class="secondary-cat-featured">
		<div class="clearfix">
			<?php while ($featured->have_posts()) : $featured->the_post(); ?>
				<?php $posts_excluded[] = get_the_ID();  ?>
				<article <?php post_class(); ?>>
					<div class="image"><?php the_post_thumbnail('cat-secondary', array('class' => 'img-responsive')); ?></div>
					<div class="title-wrap">
						<h2 class="post-title">
							<a href="<?php the_permalink() ?>" title="Enlace a <?php the_title_attribute(); ?>">
								<?php the_title(); ?>
							</a>
						</h2>
					</div>
				</article>
			<?php endwhile; ?>
			<?php wp_reset_query(); ?>
		</div>
	</div>
<?php endif; ?>