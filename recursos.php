<?php /* Template Name: Recursos */ ?>
<?php get_header() ?>
	<div id="container" class="clearfix">
		<section class="container" id="main-home-content">
			<div class="row">
				<div class="col-sm-12">
					<h1 class="block-title main">Recursos</h1>
				</div>
				<div class="col-sm-12">
					<div class="row">
						<?php 
							$size = 'med';
							$block_posts = new WP_Query(array(
								'post_type' => array('recurso'),
								'posts_per_page' => 2,
								'post__not_in' => $posts_excluded
								)); ?>
							<?php include(locate_template('templates/recursos-block.php')); ?>
					</div>
				</div>
				<div class="col-sm-9 sidebar-separator">
					<div class="two-columns-block">
						<div class="row">
							<?php 
								$size = 'thumb';
								$block_posts = new WP_Query(array(
									'post_type' => array('recurso'),
									'posts_per_page' => 8,
									'post__not_in' => $posts_excluded
									)); ?>
								<?php include(locate_template('templates/recursos-block.php')); ?>
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