<?php 
	// Listado de comentarios
	function comentarios($comment, $args, $depth) {
	   $GLOBALS['comment'] = $comment; ?>
	   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
	     <article id="comment-<?php comment_ID(); ?>" class="clearfix">
		  <?php echo get_avatar($comment,$size='75' ); ?>
	    	<div class="comment-content">
	    		<h5 class="author">
					<?php comment_author_link(); ?>
					<?php if ($comment->comment_approved == '0') : ?>
			         	<em><?php _e('Your comment is awaiting moderation.', 'ungrynerd') ?></em>
			      	<?php endif; ?>
			      	<?php edit_comment_link(__('(Edit)', 'ungrynerd'),'  ','') ?>
				</h5>
	    		<?php comment_text() ?>
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
?>