<?php if (is_paged()): ?>
	<?php get_template_part('archive'); exit; ?>
<?php endif ?>
<?php get_header() ?>
	<?php $term = get_queried_object(); ?>
	<div id="container" class="clearfix">
		<section class="container" id="main-home-content">
			<div class="row">
				<?php $featured = new WP_Query(array('tax_query' => array(
										array(
											'taxonomy' => $term->taxonomy,
											'field'    => 'term_id',
											'terms'    => array($term->term_id),
										)
									),
									'meta_key' => '_ungrynerd_cat_featured', 
									'meta_value' => 1,
									'meta_key' => '_ungrynerd_cat_featured_cat', 
									'meta_value' => $term->term_id,
									'posts_per_page' => 3)); ?>
				<?php if ($featured->have_posts() && $featured->post_count==3): ?>
					<div class="col-sm-12">
						<h1 class="block-title main"><?php single_term_title(); ?></h1>
					</div>
					<div class="col-sm-12 slideshow-wrap">
						<?php $posts_excluded = array(); ?>

						<?php include(locate_template('templates/cat-featured.php')); ?>
					</div>
				<?php endif ?>
				
				<div class="col-sm-9 sidebar-separator">
					<?php if (!$featured->have_posts() || $featured->post_count<3): ?>
						<h1 class="block-title main"><?php single_term_title(); ?></h1>
					<?php endif; ?>
					<div class="two-columns-block">
						<div class="row">
							<?php 
								$block_posts = new WP_Query(array(
									'tax_query' => array(
										array(
											'taxonomy' => $term->taxonomy,
											'field'    => 'term_id',
											'terms'    => array($term->term_id),
										)
									),
									'posts_per_page' => 2,
									'post__not_in' => $posts_excluded
									)); ?>
								<?php include(locate_template('templates/2-columns-block.php')); ?>
						</div>
					</div>
					<?php include(locate_template('templates/cat-secondary-featured.php')); ?>
					<div class="row">
						<div class="col-sm-7 primary-home" id="block_1_home">
							<?php 
							$block_posts = new WP_Query(array(
								'tax_query' => array(
									array(
										'taxonomy' => $term->taxonomy,
										'field'    => 'term_id',
										'terms'    => array($term->term_id),
									)
								),
								'posts_per_page' => 6,
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
								'posts_per_page' => 9,
								'post__not_in' => $posts_excluded
								)); ?>
							<div class="block-wrap">
								<?php include(locate_template('templates/secondary-block.php')); ?>
							</div>
						</div>
					</div>
					<div class="col-sm-9">
						<div class="pagination-wrap">
							<?php ungrynerd_pagination(); ?>
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