<?php 
/**
 * Ungrynerd_List_Tags Class
 */
class Ungrynerd_List_Tags extends WP_Widget {
    /** constructor */
    function Ungrynerd_List_Tags() {
        parent::WP_Widget(false, '(Metroscopia) Listado etiquetas', array(
                                'description' => 'Listado de etiquetas por orden de importancia'
                                ));  
    }
    public function widget( $args, $instance ) {
        $current_taxonomy = $this->_get_current_taxonomy($instance);
        if ( !empty($instance['title']) ) {
            $title = $instance['title'];
        } else {
            if ( 'post_tag' == $current_taxonomy ) {
                $title = __('Tags');
            } else {
                $tax = get_taxonomy($current_taxonomy);
                $title = $tax->labels->name;
            }
        }
        $limit = empty($instance['limit']) ? 10 : $instance['limit'];

        $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

        echo $args['before_widget'];
        if ( $title ) {
            echo $args['before_title'] . $title . $args['after_title'];
        }
        echo '<ul class="trends">';

        wp_list_categories(array(
            'taxonomy' => $current_taxonomy,
            'orderby' => 'count',
            'order' => 'DESC',
            'hierarchical' => false,
            'title_li' => '',
            'number' => $limit
        ));

        echo "</ul>\n";
        echo $args['after_widget'];
    }

    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = strip_tags(stripslashes($new_instance['title']));
        $instance['limit'] = strip_tags(stripslashes($new_instance['limit']));
        $instance['taxonomy'] = stripslashes($new_instance['taxonomy']);
        return $instance;
    }

    public function form( $instance ) {
        $current_taxonomy = $this->_get_current_taxonomy($instance);
        ?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:') ?></label>
        <input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php if (isset ( $instance['title'])) {echo esc_attr( $instance['title'] );} ?>" /></p>
        <p><label for="<?php echo $this->get_field_id('limit'); ?>"><?php _e('Limite (por defecto: 10):') ?></label>
        <input type="text" class="widefat" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" value="<?php if (isset ( $instance['limit'])) {echo esc_attr( $instance['limit'] );} ?>" /></p>
        <p><label for="<?php echo $this->get_field_id('taxonomy'); ?>"><?php _e('Taxonomy:') ?></label>
        <select class="widefat" id="<?php echo $this->get_field_id('taxonomy'); ?>" name="<?php echo $this->get_field_name('taxonomy'); ?>">
            <?php foreach ( get_taxonomies() as $taxonomy ) :
                    $tax = get_taxonomy($taxonomy);
                    if ( !$tax->show_tagcloud || empty($tax->labels->name) )
                        continue;
            ?>
            <option value="<?php echo esc_attr($taxonomy) ?>" <?php selected($taxonomy, $current_taxonomy) ?>><?php echo $tax->labels->name; ?></option>
        <?php endforeach; ?>
        </select></p><?php
    }

    public function _get_current_taxonomy($instance) {
        if ( !empty($instance['taxonomy']) && taxonomy_exists($instance['taxonomy']) )
            return $instance['taxonomy'];

        return 'post_tag';
    }

} // clase Ungrynerd_List_Tags

add_action('widgets_init', create_function('', 'return register_widget("Ungrynerd_List_Tags");'));



/**
 * Ungrynerd_Analistas Class
 */
class Ungrynerd_Analistas extends WP_Widget {
    /** constructor */
    function Ungrynerd_Analistas() {
        parent::WP_Widget(false, '(Metroscopia) Analistas', array(
                                'description' => 'Muestra los ultimos analisis destacando al analista'
                                ));  
    }
    public function widget( $args, $instance ) {

        if ( !empty($instance['title']) ) {
            $title = $instance['title'];
        } 

        $limit = empty($instance['limit']) ? 3 : $instance['limit'];

        $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

        echo $args['before_widget'];
        if ( $title ) {
            echo $args['before_title'] . $title . $args['after_title'];
        }
        $posts_excluded = get_option('ungrynerd_excludes');
        //Código para mostrar en el frontend
        global $post;
        wp_reset_postdata();
        $query = new WP_Query(array(
                    'posts_per_page'         => $limit*6,
                    'post__not_in' => $posts_excluded,
                    'tax_query' => array(
                        array(
                            'taxonomy'         => 'tipo',
                            'field'            => 'slug',
                            'terms'            => array('analisis'),
                        )
                    )
                ));
        ?>
        <?php $authors = array(); ?>
        <?php while ($query->have_posts()) : $query->the_post(); ?>
            <?php if (!in_array($post->post_author, $authors)): ?>
                <?php 
                    setup_postdata($post);
                    $posts_excluded[] = get_the_ID();
                    $authors[] = $post->post_author;
                    $coauthors = get_coauthors();
                ?>
                <?php if (count($authors)>$limit) :  break; endif ?>
                <article <?php post_class('analista') ?>>
                    <div class="wrap-info clearfix">
                        <?php echo get_avatar( $post->post_author, 80 ); ?>
                        <a class="<?php echo (count($coauthors)>1) ? 'co' : ''; ?>" href="<?php echo get_author_posts_url($post->post_author); ?>"><?php echo get_the_author_meta('display_name',$post->post_author); ?>
                            <?php if (count($coauthors)>1): ?>
                            <span class="points-wrap">, <span class="points">...</span></span>
                            <?php endif ?>
                        </a>

                    </div>
                    <h2 class="post-title <?php echo ungrynerd_cat_slug(get_the_ID()) ?>">
                        <a href="<?php the_permalink() ?>" title="Enlace a <?php the_title_attribute(); ?>">
                            <?php the_title(); ?>
                        </a>
                    </h2>
                </article>
            <?php endif ?>
        <?php endwhile; ?>
        <?php
        update_option('ungrynerd_excludes', $posts_excluded, '', 'yes');
        wp_reset_query();


        echo $args['after_widget'];
    }

    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = strip_tags(stripslashes($new_instance['title']));
        $instance['limit'] = strip_tags(stripslashes($new_instance['limit']));
        return $instance;
    }

    public function form( $instance ) {
        ?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:') ?></label>
        <input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php if (isset ( $instance['title'])) {echo esc_attr( $instance['title'] );} ?>" /></p>
        <p><label for="<?php echo $this->get_field_id('limit'); ?>"><?php _e('Limite (por defecto: 3):') ?></label>
        <input type="text" class="widefat" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" value="<?php if (isset ( $instance['limit'])) {echo esc_attr( $instance['limit'] );} ?>" /></p>
        <?php
    }

} // clase Ungrynerd_Analistas

add_action('widgets_init', create_function('', 'return register_widget("Ungrynerd_Analistas");'));




/**
 * Ungrynerd_El_Dato Class
 */
class Ungrynerd_El_Dato extends WP_Widget {
    /** constructor */
    function Ungrynerd_El_Dato() {
        parent::WP_Widget(false, '(Metroscopia) El dato', array(
                                'description' => 'Muestra el último dato'
                                ));  
    }
    public function widget( $args, $instance ) {

        if ( !empty($instance['title']) ) {
            $title = $instance['title'];
        } 


        $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

        echo $args['before_widget'];
        if ( $title ) {
            echo $args['before_title'] . '<a href="' . get_permalink(2773) . '">' . $title  . '</a>' . $args['after_title'];
        }

        //Código para mostrar en el frontend
        $query = new WP_Query(array(
                    'posts_per_page' => 1,
                    'post_type' => array('dato')
                ));
        ?>
        <?php while ($query->have_posts()) : $query->the_post(); ?>
            <a href="<?php echo get_post_meta(get_the_ID(), '_ungrynerd_dato_link', true); ?>" class="dato">
                <?php echo wp_get_attachment_image(get_post_meta(get_the_ID(), '_ungrynerd_dato_image', true), 'dato'); ?>
                <span class="number"><?php echo get_post_meta(get_the_ID(), '_ungrynerd_dato_number', true); ?></span>
                <span class="text"><?php echo get_post_meta(get_the_ID(), '_ungrynerd_dato_text', true); ?></span>
            </a>
        <?php endwhile; ?>
        <?php
        wp_reset_query();


        echo $args['after_widget'];
    }

    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = strip_tags(stripslashes($new_instance['title']));
        return $instance;
    }

    public function form( $instance ) {
        ?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:') ?></label>
        <input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php if (isset ( $instance['title'])) {echo esc_attr( $instance['title'] );} ?>" /></p>
        <?php
    }

} // clase Ungrynerd_El_Dato

add_action('widgets_init', create_function('', 'return register_widget("Ungrynerd_El_Dato");'));
?>