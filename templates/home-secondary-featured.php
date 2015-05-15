<?php $featured = new WP_Query(array('meta_key' => '_ungrynerd_featured2', 'meta_value' => 1, 'post_type'=> array('post'), 'posts_per_page' => -1)); ?>
<?php while ($featured->have_posts()) : $featured->the_post(); ?>
	<?php $posts_excluded[] = get_the_ID();  ?>
	<article <?php post_class('featured-secondary'); ?> id="featured-<?php the_ID(); ?>">
		<div class="image"><?php the_post_thumbnail('featured-secondary'); ?></div>
		<?php echo ungrynerd_cat_links(get_the_ID()); ?>
		<h1 class="post-title">
			<a href="<?php the_permalink() ?>" title="Enlace a <?php the_title_attribute(); ?>">
				<?php the_title(); ?>
			</a>
		</h1>
		<p class="author-meta"><?php the_author_posts_link(); ?></p>
		<div class="post-content">
			<?php echo wp_trim_words(get_the_excerpt());  ?>
		</div>
	</article>
<?php endwhile; ?>
<?php wp_reset_query(); ?>