<?php

add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
 
  $parent_style = 'parent-style'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.

  wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
  wp_enqueue_style( 'child-style',
    get_stylesheet_directory_uri() . '/style.css',
    array( $parent_style ),
    wp_get_theme()->get('Version')
  );
}





if ( ! function_exists( 'pv_headerImage' ) ) :
/**
 * PRINTS TEST BY PV
 */
function pv_get_random_image(){
	$arrImages = array();
	
	$twitterHeader = array(
			"image" => "/images/headers/twitter.png", 
			"width" => "250px", "height" => "185px",
			"extra_style" => "margin-top: -15px;");
	$zebrasHeader = array(
			"image" => "/images/headers/zebras.jpg", 
			"width" => "241px", "height" => "150px");
	$london2012 = array(
			"link" => "/category/london2012/", 
			"image" => "/images/headers/london_2012.png", 
			"width" => "196px", "height" => "221px",
			"extra_style" => "margin-top: -20px;");
	$longReads = array(
			"link" => "/category/long-reads/", 
			"image" => "/images/headers/long-reads.png", 
			"width" => "220px", "height" => "200px",
			"extra_style" => "margin-top: -10px; padding-top: 5px;" );
	
	switch(pv_getSchema()){
		case "twitter":
			return $twitterHeader;
			break;
		case "london2012":
			return $london2012;
			break;
		case "long-reads":
			return $longReads;
			break;
	}
	
	array_push($arrImages, $twitterHeader);
	array_push($arrImages, $zebrasHeader);
	array_push($arrImages, 
		array(
			"link" => "/category/divago/", 
			"image" => "/images/headers/divago.png", 
			"width" => "250px", "height" => "200px",
			"extra_style" => "margin-top: -20px;")
		);
	array_push($arrImages, 
		array(
			"link" => "/category/rabiscos/", 
			"image" => "/images/headers/kiwi.png", 
			"width" => "250px", "height" => "150px")
		);
/*
	array_push($arrImages, 
		array(
			"link" => "/dia-do-corno/", 
			"image" => "/images/headers/viking.png", 
			"width" => "200px", "height" => "152px",
			"extra_style" => "margin-top: -12px;")
		);
*/
	array_push($arrImages, 
		array(
			"link" => "/adeus-lula/", 
			"image" => "/images/headers/lula.png", 
			"width" => "200px", "height" => "170px",
			"extra_style" => "margin-top: -10px;")
		);
	array_push($arrImages,
                array(
                        "link" => "http://www.bolaopenacova.com/",
                        "image" => "/images/headers/penacova.png",
                        "width" => "195px", "height" => "150px",
                        "extra_style" => "margin-top: 10px;")
                );

		
	$rand = array_rand($arrImages);
	return $arrImages[$rand];
}
function pv_headerImage() {
	$image = pv_get_random_image();
	if( !empty($image["link"]) ){
		print('<a href="'.$image["link"].'">');
	}
	print('<img id="site-image-title" class="pv-header"  src="'.$image["image"].'" alt="Blog do Paulo Velho" style="'.(!empty($image["width"])?"width: ".$image["width"]."; ":"").' '.(!empty($image["height"])?"height: ".$image["height"]."; ":"").' '.(!empty($image["extra_style"])? $image["extra_style"] : "").'" />');
	if( !empty($image["link"]) ){
		print('</a>');
	}
}
endif;


if ( ! function_exists( 'pv_getSchema' ) ) :
/**
 * THEME SCHEMA
 */
global $theme_schema;
function pv_getSchema() {
	if( isset($GLOBALS["theme_schema"]) ){
		return $GLOBALS["theme_schema"];
	}
	if(is_category('london2012') || (is_single() && in_category('london2012'))){
		$GLOBALS["theme_schema"] = "london2012";
		return $GLOBALS["theme_schema"];
	}
	if(is_category('pessoal') || (is_single() && in_category('pessoal')) || is_category('europa') || (is_single() && in_category('europa'))){
		$GLOBALS["theme_schema"] = "pessoal";
		return $GLOBALS["theme_schema"];
	}
	if(is_category('divago') || (is_single() && in_category('divago'))){
		$GLOBALS["theme_schema"] = "divago";
		return $GLOBALS["theme_schema"];
	}
	if(is_tag('twitter') || (is_single() && has_tag('twitter'))){
		$GLOBALS["theme_schema"] = "twitter";
		return $GLOBALS["theme_schema"];
	}
	if(is_category('rabiscos') || (is_single() && in_category('rabiscos')) || is_category('rabiscos-de-reuniao') || (is_single() && in_category('rabiscos-de-reuniao'))){
		$GLOBALS["theme_schema"] = "rabiscos";
		return $GLOBALS["theme_schema"];
	}
	if(is_category('long-reads') || (is_single() && in_category('long-reads'))){
		$GLOBALS["theme_schema"] = "long-reads";
		return $GLOBALS["theme_schema"];
	}
	$GLOBALS["theme_schema"] = "default";
	return $GLOBALS["theme_schema"];
}
endif;


if ( ! function_exists( 'pv_print_time' ) ) :
/**
 * PRINTS TIME BY PV
 */
function pv_print_time() {
	printf( __( '<a href="%1$s" title="%2$s" rel="bookmark">
		<div class="pv_date date_'.pv_getSchema().'">
			<div class="pv_date_transparency"></div>
			<div class="pv_date-month">%3$s</div>
			<div class="pv_date-day">%4$s</div>
			<div class="pv_date-year">%5$s</div>
		</div></a>', 'paulovelho' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date('M') ),
		esc_html( get_the_date('d') ),
		esc_html( get_the_date('Y') )
	);
}
endif;






if ( ! function_exists( 'pv_test' ) ) :
/**
 * PRINTS TEST BY PV
 */
function pv_test() {
	print("PV is OK!");
}
endif;




?>
