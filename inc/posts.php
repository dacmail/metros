<?php 
    function ungrynerd_type() {
    register_taxonomy("tipo",
                    array("post"),
                    array(
                        "hierarchical" => true,
                        "label" => __( "Tipos de artículo", 'framework'),
                        "singular_label" => __( "Tipo de artículo", 'framework'),
                        "rewrite" => array( 'slug' => 'articulos', 'hierarchical' => true),
                        'show_in_nav_menus' => true,
                        )
                    );
    }

    add_action( 'init', 'ungrynerd_type', 0);
?>