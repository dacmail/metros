<?php
  if (post_password_required()) {
    return;
  }
?>

<?php if (comments_open()) : ?>
  <section id="respond-wrap">
    <?php if (have_comments()) : ?>
        <h3 class="comments-title"><?php printf(_n('<span>%1$s</span> comentario', '<span>%1$s</span> comentarios', get_comments_number(), 'wsl'), number_format_i18n(get_comments_number())); ?></h3>
    <?php else : ?>
        <h3 class="comments-title"><?php _e('No hay comentarios', 'wsl') ?></h3>
    <?php endif; ?>
    <?php if (get_option('comment_registration') && !is_user_logged_in()) : ?>
      <p><?php printf(__('Debes <a href="%s">iniciar sesión</a> para dejar un comentario.', 'wsl'), wp_login_url(get_permalink())); ?></p>
    <?php else : ?>
      <?php $aria_req = get_option( 'require_name_email' ); ?>
      <?php $comment_args = array( 'title_reply'=>'',
          'fields' => apply_filters( 'comment_form_default_fields', array(
              'author' => '<div class="row"><div class="form-group col-sm-12"><label for="author">' .  __('Nombre', 'wsl') . ($aria_req ? __(' (obligatorio)', 'wsl') : '')  . '</label>
                  <input type="text" class="form-control" name="author" id="author" value="' . esc_attr($comment_author) . '" placeholder="' .  __('Nombre', 'wsl') . ($aria_req ? __(' (obligatorio)', 'wsl') : '') . '" size="22" ' .  ($aria_req ? 'aria-required="true"' : '') . '></div>',
              'email'  => '<div class="form-group col-sm-12">
                  <label for="email">' . __('Email (no será publicado)', 'wsl') . ($aria_req ? __(' (obligatorio)', 'wsl') : '') . '</label>
                  <input type="email" class="form-control" placeholder="' . __('Email (no será publicado)', 'wsl') . ($aria_req ? __(' (obligatorio)', 'wsl') : '') . '"  name="email" id="email" value="' . esc_attr($comment_author_email) . '" size="22" ' . ($aria_req ? 'aria-required="true"' : '') . '></div></div>',
              'url'    => '<div class="form-group">
                            <label for="url">' . __('Web', 'wsl') . '</label>
                            <input type="url" class="form-control" name="url" id="url" value="' .  esc_attr($comment_author_url) . '" placeholder="' . __('Web', 'wsl') . '"  size="22">
                          </div>' ) ),
              'comment_field' => '<div class="form-group">
                                    <label for="comment">' . __('Comentario', 'wsl'). '</label>
                                    <textarea name="comment" id="comment" class="form-control" placeholder="' . __('Déjanos tu comentario', 'wsl'). '"  rows="5" aria-required="true"></textarea>
                                  </div>',
              'comment_notes_after' => '',
              'class_submit' => 'btn btn-primary'

      );

      comment_form($comment_args); ?>
    <?php endif; ?>
  </section><!-- /#respond -->
<?php endif; ?>

<?php 
  if (have_comments()) : ?>
  <section id="comments">
    <ol class="media-list">
      <?php wp_list_comments(array('callback' => 'ungrynerd_comentarios')); ?>
    </ol>

    <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
    <nav>
      <ul class="pager">
        <?php if (get_previous_comments_link()) : ?>
          <li class="previous"><?php previous_comments_link(__('&larr; Anteriores', 'wsl')); ?></li>
        <?php endif; ?>
        <?php if (get_next_comments_link()) : ?>
          <li class="next"><?php next_comments_link(__('Siguientes &rarr;', 'wsl')); ?></li>
        <?php endif; ?>
      </ul>
    </nav>
    <?php endif; ?>

    <?php if (!comments_open() && !is_page() && post_type_supports(get_post_type(), 'comments')) : ?>
    <div class="alert alert-warning">
      <?php _e('Los comentarios están cerrados.', 'wsl'); ?>
    </div>
    <?php endif; ?>
  </section><!-- /#comments -->
<?php endif; ?>

<?php if (!have_comments() && !comments_open() && !is_page() && post_type_supports(get_post_type(), 'comments')) : ?>
  <section id="comments">
    <div class="alert alert-warning">
      <?php _e('Los comentarios están cerrados.', 'wsl'); ?>
    </div>
  </section><!-- /#comments -->
<?php endif; ?>