<?php 
	// Listado de comentarios
	function ungrynerd_comentarios($comment, $args, $depth) {
	   $GLOBALS['comment'] = $comment; ?>
	   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
	     <article id="comment-<?php comment_ID(); ?>" class="clearfix">
		  	<div class="avatar-wrap"><?php echo get_avatar($comment,$size='75' ); ?></div>
	    	<div class="comment-content">
	    		<h5 class="author">
					<?php comment_author_link(); ?> 
					<time datetime="<?php echo comment_date('c'); ?>"><a href="<?php echo htmlspecialchars(get_comment_link($comment->comment_ID)); ?>"><?php printf(__('%1$s', 'wsl'), get_comment_date(),  get_comment_time()); ?></a></time>
					<?php if ($comment->comment_approved == '0') : ?>
			         	<em><?php _e('Tu comentario está pendiente de moderación.', 'wsl') ?></em>
			      	<?php endif; ?>
			      	<?php edit_comment_link(__('(Editar)', 'wsl'),'  ','') ?>
				</h5>
	    		<?php comment_text() ?>
	    		<div class="reply text-right">
                    <?php comment_reply_link(array_merge($args, array('reply_text' => '<i class="fa fa-reply"></i> Responder', 'add_below' => "comment", 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
                </div>
	    	</div>
	     </article>
	<?php
	}

	//Muestra Tipo de artículo + Primera categoría
	function ungrynerd_cat_links($post_id, $show_all = false) {
		$return = '<div class="category-metas">';

		$post_type = get_post_type($post_id);
		if ($post_type == 'post') {
			$types = get_the_terms($post_id,'tipo');
			if ($types) {
				$type = array_pop($types);
				if (!is_wp_error($type)) {
					$return .= '<a class="type" href="' . get_term_link($type->slug, 'tipo') . '"><i class="' . get_option('ungrynerd_' . $type->slug . '_icon') . '"></i>' . ($show_all ? $type->name : '') . '</a>';
				}
			}
		} elseif ($post_type == 'recurso') {
			$return .= '<a class="type" href="#"><i class="' . get_option('ungrynerd_recursos_icon') . '"></i></a>';
		}

		$cats = get_the_terms( $post_id,'category');
		if ($cats) {
			if ($show_all) {
				foreach ($cats as $cat) {
					if (!is_wp_error($cat)) {
						$return .= '<a class="cat ' . $cat->slug . '" href="' . get_term_link($cat->slug, 'category') . '">' . $cat->name . '</a>';
					}
				}
			} else {
				$cat = array_pop($cats);
				if (!is_wp_error($cat)) {
					$return .= '<a class="cat ' . $cat->slug . '" href="' . get_term_link($cat->slug, 'category') . '">' . $cat->name . '</a>';
				}
			}
		}
		$return .= '</div>';
		return $return;
	}

	//Muestra el slug de la primera categoría asignada
	function ungrynerd_cat_slug($post_id) {
		$cats = get_the_terms( $post_id,'category');
		if ($cats) {
			$cat = array_pop($cats);
			if (!is_wp_error($cat))
				return $cat->slug;
		}
		return '';
	}

	//Devuelve el nombre de la taxonomía dado un ID de un término
	function &get_tax_by_term_id($term) {
	    global $wpdb;
	    $null = null;

	    if ( empty($term) ) {
	        $error = new WP_Error('invalid_term', __('Empty Term'));
	        return $error;
	    }

        $term = (int) $term;
        if ( ! $_term = wp_cache_get($term, 'my_custom_queries') ) {
            $_term = $wpdb->get_row( $wpdb->prepare( "SELECT t.taxonomy FROM $wpdb->term_taxonomy AS t WHERE t.term_id = %s LIMIT 1", $term) );
            if ( ! $_term )
                return $null;
            wp_cache_add($term, $_term, 'my_custom_queries');
        }

	    return $_term->taxonomy;
	}

	//Get term anchor with custom text
	function ungrynerd_tax_anchor($term, $tax, $anchor_text='') {
		if (is_object($term)) {
			$_term = $term;
			$tax = $term->taxonomy;
		} else {
			$_term = get_term($term, $tax);
		}
		if (!is_wp_error($_term)) {
			$anchor_text = empty($anchor_text) ? $_term->name : $anchor_text;
			return '<a href="'. get_term_link($_term->slug, $tax).'">'. $anchor_text .'</a>';
		}
	}

	//Get or echo the post slug 
	function the_slug($echo=true){
		$slug = basename(get_permalink());
		do_action('before_slug', $slug);
		$slug = apply_filters('slug_filter', $slug);
		if( $echo ) echo $slug;
		do_action('after_slug', $slug);
		return $slug;
	}

	//Títulos de páginas
	function ungrynerd_title() {
		if (is_home()) {
			if (get_option('page_for_posts', true)) {
				return get_the_title(get_option('page_for_posts', true));
			} else {
			return __('Últimos artículos', 'wsl');
			}
		} elseif (is_archive()) {
			$term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
			if ($term) {
				return apply_filters('single_term_title', $term->name);
			} elseif (is_post_type_archive()) {
				return apply_filters('the_title', get_queried_object()->labels->name);
			} elseif (is_day()) {
				return sprintf(__('Archivo diario: %s', 'wsl'), get_the_date());
			} elseif (is_month()) {
				return sprintf(__('Archivo mensual: %s', 'wsl'), get_the_date('F Y'));
			} elseif (is_year()) {
				return sprintf(__('Archivo anual: %s', 'wsl'), get_the_date('Y'));
			} elseif (is_author()) {
				$author = get_queried_object();
				return sprintf(__('Artículos del autor: %s', 'wsl'), $author->display_name);
			} else {
				return single_cat_title('', false);
			}
		} elseif (is_search()) {
			return sprintf(__('Resultados de búsqueda para: %s', 'wsl'), get_search_query());
		} elseif (is_404()) {
			return __('No encontrado', 'wsl');
		} else {
			return get_the_title();
		}
	}

	function ungrynerd_pagination($query=null) {
		global $wp_query;
		$query = $query ? $query : $wp_query;
		$big = 999999999;

		$paginate = paginate_links( array(
			'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'type' => 'array',
			'total' => $query->max_num_pages,
			'format' => '?paged=%#%',
			'mid_size' => 4,
			'current' => max( 1, get_query_var('paged') ),
			'prev_text' => __('<i class="fa fa-chevron-left"></i>'),
			'next_text' => __('<i class="fa fa-chevron-right"></i>'),
			)
		);

		if ($query->max_num_pages > 1) : ?>
			<ul class="pagination">
			<?php foreach ( $paginate as $page ) {
				echo '<li>' . $page . '</li>';
			} ?>
		</ul>
		<?php endif;
	}

?>