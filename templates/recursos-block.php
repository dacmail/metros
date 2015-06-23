<?php while ($block_posts->have_posts()) : $block_posts->the_post(); ?>
	<?php $posts_excluded[] = get_the_ID();  ?>
	<article <?php post_class('col-sm-6'); ?> id="featured-<?php the_ID(); ?>">
		<?php if (has_post_thumbnail()) : ?>
			<?php $video = get_post_meta(get_the_ID(), '_ungrynerd_recurso_video', true); ?>
			<a href="<?php the_permalink(); ?>" class="image">
				<?php the_post_thumbnail('cat-' . $size); ?>
				<?php if (!empty($video)): ?>
					<span class="play-btn"></span>
				<?php endif; ?>
			</a>
		<?php endif; ?>
		<h2 class="post-title">
			<a href="<?php the_permalink() ?>" title="Enlace a <?php the_title_attribute(); ?>">
				<?php the_title(); ?>
			</a>
		</h2>
	</article>
<?php endwhile; ?>