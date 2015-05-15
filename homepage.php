<?php /* Template Name: Home */ ?>
<?php get_header() ?>
<?php while (have_posts()) : the_post(); ?>
	<div id="container" class="clearfix">
		<section class="container" id="main-home-content">
			<div class="row">
				<div class="col-sm-8">
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
				<?php get_sidebar('home') ?>
			</div>
		</section>
	</div>
<?php endwhile; ?>
<?php get_footer() ?>
