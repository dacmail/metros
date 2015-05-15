<?php
/*
 * For more information, please visit:
 * @link http://www.deluxeblogtips.com/meta-box/
 */


$prefix = '_ungrynerd_';

global $meta_boxes;

$meta_boxes = array();

$meta_boxes[] = array(
        'id'         => 'general_options',
        'title'      =>  __('Options'),
        'pages'      => array( 'page', 'post' ), // Post type
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
	                'name' =>  __('Destacar en portada (secundario'),
	                'desc' =>  __('¿Mostrar en el bloque destacado secundario?'),
	                'id' => $prefix . 'featured2',
	                'type' => 'checkbox',
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
