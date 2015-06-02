<?php get_header() ?>
<div id="container" class="clearfix">
	<div class="container">
		<div class="row">
			<?php while (have_posts()) : the_post(); ?>
			<article id="content" <?php post_class('col-md-12'); ?>>
				<?php if (has_post_thumbnail()): ?>
					<div class="featured-img">
						<?php the_post_thumbnail('featured-big', array('class' => 'img-responsive')); ?>
					</div>
				<?php endif ?>
				<h1 class="post-title"><?php the_title(); ?></h1>
				<div class="meta row">
					<div class="col-md-6 date">
						<?php the_time(); ?>
					</div>
					<div class="col-md-6 share">
						SHARE
					</div>
				</div>
				<div class="post-content">
					<div class=" row">
						<div class="col-sm-3 sidebar">
							AUTOR INFO
						</div>
						<div class="col-sm-9 article">
							<?php the_content(); ?>
						</div>
					</div>
				</div>
			</article>
			<?php endwhile; ?>
		</div>
	</div>
</div>
<?php get_footer() ?>