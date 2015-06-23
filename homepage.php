<?php /* Template Name: Home */ ?>
<?php get_header() ?>
<?php while (have_posts()) : the_post(); ?>
	<div id="container" class="clearfix">
		<?php $primary = new WP_Query(array('meta_key' => '_ungrynerd_featured', 'meta_value' => 1, 'post_type'=> array('post','recurso'), 'posts_per_page' => 1)); ?>
		<?php if ($primary->have_posts()): ?>
			<section class="big-featured home">
				<?php include(locate_template('templates/home-primary-featured.php')); ?>
			</section>
		<?php endif ?>

		<section class="container" id="main-home-content">
			<div class="row">
				<div class="col-sm-9 sidebar-separator">
					<?php $posts_excluded = array(); ?>
					<?php include(locate_template('templates/home-secondary-featured.php')); ?>
					<div class="row">
						<div class="col-sm-7 primary-home" id="block_1_home">
							<?php include(locate_template('templates/home-primary-block.php')); ?>
						</div>
						<div class="col-sm-5 secondary-home" id="block_1_home">
							<?php include(locate_template('templates/home-secondary-block.php')); ?>
						</div>
					</div>
				</div>
				<?php update_option('ungrynerd_excludes', $posts_excluded, '', 'yes'); ?>
				<?php get_sidebar('home') ?>
				<?php $posts_excluded = get_option('ungrynerd_excludes'); ?>
			</div>
		</section>

		<section id="multimedia" class="dark multimedia-home">
			<div class="container">
				<div class="row">
					<?php include(locate_template('templates/home-multimedia.php')); ?>
				</div>
			</div>
		</section>
		<section id="latest" class="container">
			<div class="row">
				<?php include(locate_template('templates/home-latest.php')); ?>
			</div>
		</section>
	</div>
<?php endwhile; ?>
<?php get_footer() ?>