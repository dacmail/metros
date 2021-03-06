<?php /* Template Name: Home */ ?>
<?php get_header() ?>
<?php while (have_posts()) : the_post(); ?>
	<?php $posts_excluded = array(); ?>
	<div id="container" class="clearfix">
		<?php $primary = new WP_Query(array('meta_key' => '_ungrynerd_featured', 'meta_value' => 1, 'post_type'=> array('post','recurso'), 'posts_per_page' => 1)); ?>
		<?php if ($primary->have_posts()): ?>
			<?php $posts_excluded[] = get_the_ID();  ?>
			<section class="big-featured home">
				<?php include(locate_template('templates/home-primary-featured.php')); ?>
			</section>
		<?php endif ?>

		<section class="container" id="main-home-content">
			<div class="row">
				<div class="col-sm-9 sidebar-separator">
					<?php include(locate_template('templates/home-secondary-featured.php')); ?>
					<div class="row">
						<div class="col-sm-7 primary-home" id="block_1_home">
							<?php include(locate_template('templates/home-primary-block.php')); ?>
						</div>
						<div class="col-sm-5 secondary-home" id="block_1_home">
							<?php include(locate_template('templates/home-secondary-block.php')); ?>
							<?php include(locate_template('templates/home-secondary-block-extra.php')); ?>
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
				<?php include(locate_template('templates/home-multimedia.php')); ?>
			</div>
		</section>
		<section id="latest" class="container">
			<?php include(locate_template('templates/home-latest.php')); ?>
		</section>
	</div>
<?php endwhile; ?>
<?php get_footer() ?>