<?php get_header() ?>
<div id="container" class="clearfix">
	<div class="container">
		<div class="row">
			<?php while (have_posts()) : the_post(); ?>
			<div class="col-sm-9 sidebar-separator">
				<article <?php post_class(); ?>>
					<h1 class="block-title"><?php the_title(); ?></h1>
					<?php if (has_post_thumbnail()): ?>
						<div class="featured-img">
							<?php the_post_thumbnail('featured-big', array('class' => 'img-responsive')); ?>
						</div>
					<?php endif ?>
					<div class="post-content">
						<?php the_content(); ?>
					</div>
				</article>
			</div>
			<?php endwhile; ?>
			<?php get_sidebar('home') ?>
		</div>
	</div>
</div>
<?php get_footer() ?>