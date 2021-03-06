<?php while ($block_posts->have_posts()) : $block_posts->the_post(); ?>
	<?php $posts_excluded[] = get_the_ID();  ?>
	<article <?php post_class($block_posts->current_post==($limit-1) ? 'last clearfix' : 'clearfix'); ?> id="featured-<?php the_ID(); ?>">
		<?php if ($block_posts->current_post==0): ?>
			<?php if (has_post_thumbnail()) : ?><div class="image"><?php the_post_thumbnail('cat-thumb'); ?></div><?php endif; ?>
		<?php else : ?>
			<?php if (has_post_thumbnail()) : ?><div class="image"><?php the_post_thumbnail('square'); ?></div><?php endif; ?>
		<?php endif ?>
		<?php echo ungrynerd_cat_links(get_the_ID()); ?>
		<h2 class="post-title">
			<a href="<?php the_permalink() ?>" title="Enlace a <?php the_title_attribute(); ?>">
				<?php the_title(); ?>
			</a>
		</h2>
		<p class="author-meta"><?php the_author_posts_link(); ?></p>
	</article>
<?php endwhile; ?>