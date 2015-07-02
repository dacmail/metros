<?php
    $orig_post = $post;
    global $post;
    $tags = wp_get_post_tags($post->ID);
if ($tags) {
    $tag_ids = array();
    foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;

    $my_query = new wp_query(array(
        'tag__in' => $tag_ids,
        'post__not_in' => array($post->ID),
        'posts_per_page'=>4, 
        'meta_query' => array(array('key' => '_thumbnail_id')) 
    ));
    ?>
    <h3 class="block-title">Relacionados</h3>
    <div class="row">
    <?php while( $my_query->have_posts() ) : $my_query->the_post(); ?>
        <article <?php post_class('col-sm-3'); ?> id="featured-<?php the_ID(); ?>">
            <?php the_post_thumbnail('cat-med'); ?>
            <?php echo ungrynerd_cat_links(get_the_ID()); ?>
            <h2 class="post-title">
                <a href="<?php the_permalink() ?>" title="Enlace a <?php the_title_attribute(); ?>">
                    <?php the_title(); ?>
                </a>
            </h2>
            <p class="author-meta"><?php the_author_posts_link(); ?></p>
        </article>
    <?php endwhile; ?>
    </div>
    <?php
}
    $post = $orig_post;
    wp_reset_query();
?>