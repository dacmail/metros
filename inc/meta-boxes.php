<?php
/*
 * For more information, please visit:
 * @link http://www.deluxeblogtips.com/meta-box/
 */


$prefix = '_ungrynerd_';

global $meta_boxes;

$meta_boxes = array();

$meta_boxes[] = array(
        'id'         => 'home_options',
        'title'      =>  __('Portada'),
        'pages'      => array('post', 'recurso'), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
        'fields'     => array(
            array(
	                'name' =>  __('Destacar en portada (principal)'),
	                'desc' =>  __('¿Mostrar en el bloque destacado principal?'),
	                'id' => $prefix . 'featured',
	                'type' => 'checkbox',
	            ),
            array(
	                'name' =>  __('Destacar en portada (secundario)'),
	                'desc' =>  __('¿Mostrar en el bloque destacado secundario?'),
	                'id' => $prefix . 'featured2',
	                'type' => 'checkbox',
	            )
        ),
    );

$meta_boxes[] = array(
        'id'         => 'cat_options',
        'title'      =>  __('Portada de sección'),
        'pages'      => array('post' ), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
        'fields'     => array(
            array(
	                'name' =>  __('Destacar en portada de sección (principal)'),
	                'desc' =>  __('¿Mostrar en el bloque destacado principal?'),
	                'id' => $prefix . 'cat_featured',
	                'type' => 'checkbox',
	            ),
            array(
	                'name' =>  __('Destacar en portada de sección (secundario)'),
	                'desc' =>  __('¿Mostrar en el bloque destacado secundario?'),
	                'id' => $prefix . 'cat_featured2',
	                'type' => 'checkbox',
	            )
        ),
    );

$meta_boxes[] = array(
        'id'         => 'cat_options',
        'title'      =>  __('Imagen destacada'),
        'pages'      => array('post' ), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
        'fields'     => array(
            array(
	                'name' =>  __('Mostrar imagen destacada en grande encima del titular'),
	                'id' => $prefix . 'image_featured',
	                'type' => 'checkbox',
	                'std' => 1,
	            ),
        ),
    );

$meta_boxes[] = array(
        'id'         => 'dato_options',
        'title'      =>  __('El dato'),
        'pages'      => array('dato' ), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
        'fields'     => array(
            array(
	                'name' =>  __('Cifra'),
	                'id' => $prefix . 'dato_number',
	                'type' => 'text',
	            ),
            array(
	                'name' =>  __('Texto'),
	                'id' => $prefix . 'dato_text',
	                'type' => 'text',
	            ),
            array(
	                'name' =>  __('Enlace'),
	                'id' => $prefix . 'dato_link',
	                'type' => 'text',
	            ),
            array(
	                'name' =>  __('Image'),
	                'id' => $prefix . 'dato_image',
	                'type' => 'image_advanced',
	                'max_file_uploads' => 1,
	            ),
        ),
    );

$meta_boxes[] = array(
        'id'         => 'recurso_options',
        'title'      =>  __('Recurso'),
        'pages'      => array('recurso' ), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
        'fields'     => array(
            array(
	                'name' =>  __('Enlace relacionado'),
	                'id' => $prefix . 'recurso_link',
	                'type' => 'text',
	            ),
            array(
	                'name' =>  __('Título enlace relacionado'),
	                'id' => $prefix . 'recurso_link_text',
	                'type' => 'text',
	            ),
            array(
	                'name' =>  __('URL Video'),
	                'id' => $prefix . 'recurso_video',
	                'type' => 'oembed',
	            )
        ),
    );

function ungrynerd_custom_terms_list() {
	$select_terms = get_terms(array('tipo','category'));
	$taxonomies = array();
	foreach ($select_terms as $term) {
		$taxonomies[$term->term_id] = $term->name;
	}
	return $taxonomies;
}


$meta_boxes[] = array(
        'id'         => 'home_options',
        'title'      =>  __('Opciones de portada: Bloque 1'),
        'pages'      => array('page'), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
        'fields'     => array(
			array(
				'name'    => __( 'Categoría', 'ungrynerd' ),
				'id'      => $prefix . 'block_1_tax',
				'type'    => 'taxonomy_advanced',
				'options' => array(
					'taxonomy' => 'category',
					'taxonomies' => array('category','tipo'),
					'type'     => 'select_advanced',
				),
			),
			array(
				'name'    => __( 'Número artículos', 'ungrynerd' ),
				'id'      => $prefix . 'block_1_count',
				'type'    => 'number',
				'min'	  => 3,
			)
        ),
    );
$meta_boxes[] = array(
        'id'         => 'home_options2',
        'title'      =>  __('Opciones de portada: Bloque 2'),
        'pages'      => array('page'), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
        'fields'     => array(
			array(
				'name'    => __( 'Categoría', 'ungrynerd' ),
				'id'      => $prefix . 'block_2_tax',
				'type'    => 'taxonomy_advanced',
				'options' => array(
					'taxonomy' => 'category',
					'taxonomies' => array('category','tipo'),
					'type'     => 'select_advanced',
				),
			),
			array(
				'name'    => __( 'Número artículos', 'ungrynerd' ),
				'id'      => $prefix . 'block_2_count',
				'type'    => 'number',
				'min'	  => 3,
			)
        ),
    );

$meta_boxes[] = array(
        'id'         => 'home_options3',
        'title'      =>  __('Opciones de portada: Bloque 3'),
        'pages'      => array('page'), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
        'fields'     => array(
			array(
				'name'    => __( 'Categoría', 'ungrynerd' ),
				'id'      => $prefix . 'block_3_tax',
				'type'    => 'taxonomy_advanced',
				'options' => array(
					'taxonomy' => 'category',
					'taxonomies' => array('category','tipo'),
					'type'     => 'select_advanced',
				),
			),
			array(
				'name'    => __( 'Número artículos', 'ungrynerd' ),
				'id'      => $prefix . 'block_3_count',
				'type'    => 'number',
				'min'	  => 3,
			)
        ),
    );

function ungrynerd_register_meta_boxes()
{
	if ( !class_exists( 'RW_Meta_Box' ) )
		return;

	global $meta_boxes;
	foreach ( $meta_boxes as $meta_box )
	{
		new RW_Meta_Box( $meta_box );
	}
}
add_action( 'admin_init', 'ungrynerd_register_meta_boxes' );
