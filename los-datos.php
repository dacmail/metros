<?php /* Template Name: Los datos */ ?>
<?php get_header() ?>
<div id="container" class="clearfix">
	<div class="container">
		<div class="row">
			<?php while (have_posts()) : the_post(); ?>
			<div class="col-sm-9 sidebar-separator">
				<article <?php post_class(); ?>>
					<h1 class="block-title"><?php the_title(); ?></h1>
					<div class="post-content">
						<?php the_content(); ?>
					</div>
					<div class="row">
						<?php $query = new WP_Query(array(
					                    'posts_per_page' => -1,
					                    'post_type' => array('dato')
					                )); ?>
				        <?php while ($query->have_posts()) : $query->the_post(); ?>
					        <div class="col-sm-4">
					            <a href="<?php echo get_post_meta(get_the_ID(), '_ungrynerd_dato_link', true); ?>" class="dato">
					                <?php echo wp_get_attachment_image(get_post_meta(get_the_ID(), '_ungrynerd_dato_image', true), 'dato'); ?>
					                <span class="number"><?php echo get_post_meta(get_the_ID(), '_ungrynerd_dato_number', true); ?></span>
					                <span class="text"><?php echo get_post_meta(get_the_ID(), '_ungrynerd_dato_text', true); ?></span>
					            </a>
							</div>
				        <?php endwhile; ?>
        				<?php wp_reset_query(); ?>
					</div>
				</article>
			</div>
			<?php endwhile; ?>
			<?php get_sidebar('home') ?>
		</div>
	</div>
</div>
<?php get_footer() ?>