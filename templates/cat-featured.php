<div class="row">
	<div class="col-sm-9">
		<div class="slideshow">
		<?php while ($featured->have_posts()) : $featured->the_post(); ?>
			<?php $posts_excluded[] = get_the_ID();  ?>
			<article <?php post_class('slide-item'); ?> data-hash="<?php the_slug(); ?>">
				<div class="image"><?php the_post_thumbnail('carousel', array('class' => 'img-responsive')); ?></div>
				<div class="title-wrap">
					<h2 class="post-title">
						<a href="<?php the_permalink() ?>" title="Enlace a <?php the_title_attribute(); ?>">
							<?php the_title(); ?>
						</a>
					</h2>
				</div>
			</article>
		<?php endwhile; ?>
		</div>
	</div>
	<div class="col-sm-3">
		<ul class="slideshow-nav">
		<?php while ($featured->have_posts()) : $featured->the_post(); ?>
			<?php $posts_excluded[] = get_the_ID();  ?>
			<li>
				<a href="#<?php the_slug(); ?>">
					<?php the_title(); ?>
				</a>
			</li>
		<?php endwhile; ?>
		</ul>
	</div>
	<?php wp_reset_query(); ?>
</div>