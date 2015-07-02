<?php get_header() ?>
	<?php $term = get_queried_object(); ?>
	<div id="container" class="clearfix">
		<section class="container" id="main-home-content">
			<div class="row">
				<div class="col-sm-9 sidebar-separator">
					<div class="tag-desc">
						<h1 class="tag-title"><?php echo ungrynerd_title(); ?></h1>
					</div>
					<div class="primary-home no-home">
						<?php $block_posts = $wp_query; ?>
						<?php include(locate_template('templates/list.php')); ?>
					</div>
				</div>
				<?php get_sidebar('home') ?>
				<div class="col-sm-9">
					<div class="pagination-wrap">
						<?php ungrynerd_pagination(); ?>
					</div>
				</div>
			</div>
		</section>
	</div>
<?php get_footer() ?>