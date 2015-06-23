<?php while ($block_posts->have_posts()) : $block_posts->the_post(); ?>
	<?php $posts_excluded[] = get_the_ID();  ?>
	<?php $video = get_post_meta(get_the_ID(), '_ungrynerd_recurso_video', true); ?>
	<div class="image-wrap <?php echo !empty($video) ? 'video' : 'chart' ?>">
		<div class="container">
			<?php the_post_thumbnail('featured-big'); ?>
			<?php if (!empty($video)): ?>
				<a href="#" class="play"></a>
				<div class="video-wrap">
					<?php echo wp_oembed_get($video); ?>
				</div>
			<?php endif ?>
		</div>
	</div>
	<div class="container">
		<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
			<div class="meta row">
				<div class="col-md-6 date">
					<?php the_time('l j \d\e F \d\e Y \- H:i:s'); ?>
				</div>
				<div class="col-md-6 share">
					<div data-url="<?php the_permalink(); ?>" class="addthis_sharing_toolbox"></div>
				</div>
			</div>
			<h2 class="post-title">
				<a href="<?php the_permalink() ?>" title="Enlace a <?php the_title_attribute(); ?>">
					<?php the_title(); ?>
				</a>
			</h2>
			<div class="post-content">
				<?php the_content( __('Leer m&aacute;s &raquo;', 'ungrynerd')); ?>
				<?php wp_link_pages(); ?>
			</div>
			<?php $linktext = get_post_meta(get_the_ID(), '_ungrynerd_recurso_link_text', true); ?>
			<?php if (!empty($linktext)): ?>
				<div class="meta-related">Relacionado: <a href="<?php echo get_post_meta(get_the_ID(), '_ungrynerd_recurso_link', true); ?>"><?php echo $linktext; ?></a></div>
			<?php endif ?>
		</article>
	</div>
<?php endwhile; ?>