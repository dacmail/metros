<?php get_header() ?>
<div id="container" class="clearfix">
	<div class="container">
		<div class="row">
			<?php while (have_posts()) : the_post(); ?>
			<article id="content" <?php post_class('col-md-12'); ?>>
				<?php $featured_image = get_post_meta(get_the_ID(), '_ungrynerd_image_featured', true); ?>
				<?php if (has_post_thumbnail() && $featured_image): ?>
					<div class="featured-img">
						<?php the_post_thumbnail('featured-big', array('class' => 'img-responsive')); ?>
						<p class="caption"><?php echo get_post(get_post_thumbnail_id())->post_excerpt; ?></p>
					</div>
				<?php endif ?>
				<h1 class="post-title"><?php the_title(); ?></h1>
				<div class="meta row">
					<div class="col-sm-6 date">
						<?php the_time('l j \d\e F \d\e Y \- H:i:s'); ?>
					</div>
					<div class="col-sm-6 share">
						<div class="addthis_sharing_toolbox"></div>
					</div>
				</div>
				<div class="post-content">
					<div class=" row">
						<div class="col-sm-9 pull-right">
							<div class="article">
								<?php the_content(); ?>
								<div class="tags">
									<?php the_tags(''); ?>
								</div>
							</div>
							<div class="text-right share bottom"><div class="addthis_sharing_toolbox"></div></div>
						</div>

						<div class="col-sm-3 sidebar pull-left">
							<?php $authors = get_coauthors();?>
							<?php if (count($authors)<2): ?>
								<?php echo get_avatar( get_the_author_meta( 'ID' ), 80 ); ?>
							<?php endif ?>
							<h3 class="by">
								<span>Escrito por </span>
								<?php 
								if ( function_exists( 'coauthors_posts_links' ) ) {
								    coauthors_posts_links(' ', ' ');
								} else {
								    the_author_posts_link();
								}
								?>
							</h3>
							<?php echo ungrynerd_cat_links(get_the_ID(), true); ?>
						</div>
					</div>
				</div>
			</article>
			<?php endwhile; ?>
		</div>
	</div>
	<div class="related-posts">
		<div class="container">
			<?php include(locate_template('templates/related-posts.php')); ?>
		</div>
	</div>
</div>
<?php get_footer() ?>