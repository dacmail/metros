<?php get_header() ?>
	<div id="container" class="clearfix">
		<section class="container" id="main-home-content">
			<div class="row">
				<div class="col-sm-9 sidebar-separator">
					<?php $posts_excluded = array(); ?>
					<?php include(locate_template('templates/cat-featured.php')); ?>
					<div class="row">
						<div class="col-sm-7 primary-home" id="block_1_home">
							<?php 
							$term = get_queried_object();
							$block_posts = new WP_Query(array(
								'tax_query' => array(
									array(
										'taxonomy' => $term->taxonomy,
										'field'    => 'term_id',
										'terms'    => array($term->term_id),
									)
								),
								'posts_per_page' => 3,
								'post__not_in' => $posts_excluded
								)); ?>
							<div class="block-wrap">
								<?php include(locate_template('templates/primary-block.php')); ?>
							</div>
						</div>
						<div class="col-sm-5 secondary-home" id="block_1_home">
							<?php 
							$block_posts = new WP_Query(array(
								'tax_query' => array(
									array(
										'taxonomy' => $term->taxonomy,
										'field'    => 'term_id',
										'terms'    => array($term->term_id),
									)
								),
								'posts_per_page' => 5,
								'post__not_in' => $posts_excluded
								)); ?>
							<div class="block-wrap">
								<?php include(locate_template('templates/secondary-block.php')); ?>
							</div>
						</div>
					</div>
				</div>
				<?php update_option('ungrynerd_excludes', $posts_excluded, '', 'yes'); ?>
				<?php get_sidebar('home') ?>
				<?php $posts_excluded = get_option('ungrynerd_excludes'); ?>
			</div>
		</section>
	</div>
<?php get_footer() ?>