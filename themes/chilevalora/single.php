<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package chilevalora
 */


	
	$get_post_type =  get_post_type();

	if(isset($get_post_type) && $get_post_type!=''){
		switch ($get_post_type) {
			case 'detalle_sector'	: detalle_sector(); 	;break;
			case 'regiones_detalle'	: regiones_detalle(); 	;break;
			case 'detalle_ocupacion': detalle_ocupacion(); 	;break;
			
		}
	}


function detalle_sector(){
	get_header();

	get_footer();
}

function regiones_detalle(){
	get_header();

	get_footer();
}

function detalle_ocupacion(){
	global $wpdb;
	global $id_occupation;
	

	$get_the_ID =  get_the_ID();

	//var_dump($get_the_ID); 

	$args_ocupacion        = array(
		'post_type'     => 'detalle_ocupacion',
		'post_status'   => 'publish',
		'showposts'     => 1,
		'order'         => 'ASC',
		'post__in'		=> array($get_the_ID)
	);
	
	$wp_ocupacion = new WP_Query( $args_ocupacion );

	if ( $wp_ocupacion->have_posts() ) :
    	while ( $wp_ocupacion->have_posts() ) : $wp_ocupacion->the_post();
    		$title_ocupacion 	= get_the_title();
    		$content_ocupacion = get_the_content();
    		$id_occupation = get_field('id');

    	endwhile;
		wp_reset_postdata();
	endif;
		//var_dump($id_occupation);
	get_header();
		include 'single-ocupacion-detalle.php';
	get_footer();
}


