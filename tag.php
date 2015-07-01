<?php get_header() ?>
	<?php $term = get_queried_object(); ?>
	<div id="container" class="clearfix">
		<section class="container" id="main-home-content">
			<div class="row">
				<div class="col-sm-9 sidebar-separator">
					<div class="tag-desc">
						<h1 class="tag-title main"><?php single_term_title(); ?></h1>
						<?php echo term_description(); ?>
					</div>
					<div class="primary-home no-home">
						<?php $block_posts = $wp_query ?>
						<?php include(locate_template('templates/tag-block.php')); ?>
					</div>
					<div class="pagination-wrap">
						<?php ungrynerd_pagination(); ?>
					</div>
				</div>
				<?php update_option('ungrynerd_excludes', $posts_excluded, '', 'yes'); ?>
				<?php get_sidebar('home') ?>
				<?php $posts_excluded = get_option('ungrynerd_excludes'); ?>
			</div>
		</section>
	</div>
<?php get_footer() ?>