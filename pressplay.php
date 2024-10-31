<?php
/*
Plugin Name: PressPlay Lite
Plugin URI: http://pressplay.lanexa.net
Description: Simply turns all MP3 links into a play button for all browsers & devices. Powered by SoundManager2.
Version: 1.2.2
Author: Doug Walker
Author URI: http://lanexa.ent
License: GPL2
*/
/*  Copyright YEAR  PLUGIN_AUTHOR_NAME  (email : PLUGIN AUTHOR EMAIL)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// Add CSS
function prefix_add_my_stylesheet() {
	// Respects SSL, Style.css is relative to the current file
    wp_register_style( 'prefix-style', plugins_url('/css/pressplay.css', __FILE__) );
    wp_enqueue_style( 'prefix-style' );
}  
add_action( 'wp_enqueue_scripts', 'prefix_add_my_stylesheet' );

// Add Scripts
function pp_scripts_method() {
	wp_enqueue_script(
		'sm2jsmin',
		plugins_url('/soundmanager/script/soundmanager2-jsmin.js', __FILE__),
		array( 'jquery' )
	);
	wp_enqueue_script(
		'mp3btn',
		plugins_url('/script/pressplay-button.js', __FILE__),
		array( 'jquery', 'sm2jsmin' )
	);
	wp_enqueue_script(
		'pressplay',
		plugins_url('/script/pressplay.js', __FILE__),
		array( 'jquery', 'sm2jsmin', 'mp3btn' )
	);
}

add_action( 'wp_enqueue_scripts', 'pp_scripts_method' );


// Add Script with Global PHP var
function pp_load_php_js() {
	wp_enqueue_script(
		'pp_php_js', 
		plugins_url('/script/pp-php.js', __FILE__), 
		array( 'jquery', 'mp3btn' ));
 
	wp_localize_script(
		'pp_php_js', 
		'pp_php_var', 
		array(
			'pp_sm_swf' => plugins_url('pressplay-lite/soundmanager/swf/')
		)
	);
}

add_action( 'wp_enqueue_scripts', 'pp_load_php_js' );


?>