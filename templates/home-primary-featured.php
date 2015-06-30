<?php while ($primary->have_posts()) : $primary->the_post(); ?>
	<?php $posts_excluded[] = get_the_ID();  ?>
	<?php $video = get_post_meta(get_the_ID(), '_ungrynerd_recurso_video', true); ?>
	<div <?php post_class('image-wrap ' . (!empty($video) ? 'video' : 'chart')); ?>>
		<div class="container">
			<?php the_post_thumbnail('featured-big'); ?>
			<?php if (!empty($video)): ?>
				<a href="#" class="play"></a>
				<div class="video-wrap">
					<?php echo wp_oembed_get($video); ?>
				</div>
			<?php endif ?>
			<div class="title-wrap">
				<h2 class="post-title">
					<a href="<?php the_permalink() ?>" title="Enlace a <?php the_title_attribute(); ?>">
						<?php the_title(); ?>
					</a>
				</h2>
			</div>
		</div>
	</div>
<?php endwhile; ?>