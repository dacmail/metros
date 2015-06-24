<?php while ($block_posts->have_posts()) : $block_posts->the_post(); ?>
	<?php $posts_excluded[] = get_the_ID();  ?>
	<article <?php post_class('clearfix list-posts'); ?> id="featured-<?php the_ID(); ?>">
		<?php if (has_post_thumbnail()) : ?><div class="image"><?php the_post_thumbnail('thumbnail'); ?></div><?php endif; ?>
		<?php echo ungrynerd_cat_links(get_the_ID()); ?>
		<h2 class="post-title">
			<a href="<?php the_permalink() ?>" title="Enlace a <?php the_title_attribute(); ?>">
				<?php the_title(); ?>
			</a>
		</h2>
		<p class="author-meta"><?php the_author_posts_link(); ?></p>
	</article>
<?php endwhile; ?>