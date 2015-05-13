<?php // Do not delete these lines
	if (isset($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ( __('Por favor, no cargue esta p&aacute;gina directamente.', 'ungrynerd'));

	if ( post_password_required() ) { ?>
		<p class="nocomments"><?php _e('Esta noticia est&aacute; protegida por contrase&ntilde;a. Introd&uacute;zcala para ver los comentarios', 'ungrynerd'); ?></p>
	<?php
		return;
	}
	?>

<?php if ( have_comments() ) : ?>
	<h3 id="comments"><?php comments_number( __('Sin comentarios', 'ungrynerd'), __('1 comentario', 'ungrynerd'), __('% comentarios', 'ungrynerd'));?> </h3>

	<nav class="navigation_comment clearfix">
		<?php previous_comments_link() ?>
		<?php next_comments_link() ?>
	</nav>

	<ol class="commentlist">
		<?php wp_list_comments("callback=comentarios");?>
	</ol>

	<nav class="navigation_comment clearfix">
		<?php previous_comments_link() ?>
		<?php next_comments_link() ?>
	</nav>

 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ('open' == $post->comment_status) : ?>
		<!-- If comments are open, but there are no comments. -->

	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<p class="nocomments"><?php _e('Los comentarios est&aacute;n cerrados', 'ungrynerd'); ?></p>

	<?php endif; ?>
<?php endif; ?>


<?php if ('open' == $post->comment_status) : ?>
	<?php comment_form(); ?>
<?php endif; // if you delete this the sky will fall on your head ?>