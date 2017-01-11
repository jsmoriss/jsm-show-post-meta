<?php
/*
 * Plugin Name: JSM's Show Post Meta
 * Text Domain: jsm-show-post-meta
 * Domain Path: /languages
 * Plugin URI: https://surniaulula.com/extend/plugins/jsm-show-post-meta/
 * Assets URI: https://jsmoriss.github.io/jsm-show-post-meta/assets/
 * Author: JS Morisset
 * Author URI: https://surniaulula.com/
 * License: GPLv3
 * License URI: http://www.gnu.org/licenses/gpl.txt
 * Description: Show all post meta (aka custom fields) keys and their unserialized values in a metabox on post editing pages.
 * Requires At Least: 3.7
 * Tested Up To: 4.7.1
 * Version: 1.0.6-1
 *
 * Version Components: {major}.{minor}.{bugfix}-{stage}{level}
 *
 *	{major}		Major code changes / re-writes or significant feature changes.
 *	{minor}		New features / options were added or improved.
 *	{bugfix}	Bugfixes or minor improvements.
 *	{stage}{level}	dev < a (alpha) < b (beta) < rc (release candidate) < # (production).
 *
 * See PHP's version_compare() documentation at http://php.net/manual/en/function.version-compare.php.
 * 
 * The original code comes from the Post Meta Inspector plugin
 * (https://wordpress.org/plugins/post-meta-inspector/) by Daniel Bachhuber
 * and Automattic. Improvements include better CSS for display boundaries,
 * unserializing array values, arrays shown as preformatted wrapped text,
 * additional filters, etc.
 *
 * This script is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 3 of the License, or (at your option) any later
 * version.
 * 
 * This script is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A
 * PARTICULAR PURPOSE. See the GNU General Public License for more details at
 * http://www.gnu.org/licenses/.
 * 
 * Copyright 2016-2017 Jean-Sebastien Morisset (https://surniaulula.com/)
 */

if ( ! defined( 'ABSPATH' ) ) 
	die( 'These aren\'t the droids you\'re looking for...' );

if ( ! class_exists( 'JSM_Show_Post_Meta' ) ) {

	class JSM_Show_Post_Meta {

		private static $instance;
		private static $wp_min_version = 3.7;
	
		public $view_cap;
	
		private function __construct() {
			if ( is_admin() ) {
				add_action( 'plugins_loaded', array( __CLASS__, 'load_textdomain' ) );
				add_action( 'admin_init', array( __CLASS__, 'check_wp_version' ) );
				add_action( 'add_meta_boxes', array( &$this, 'add_meta_boxes' ), 1000, 2 );
			}
		}
	
		public static function &get_instance() {
			if ( ! isset( self::$instance ) )
				self::$instance = new self;
			return self::$instance;
		}
	
		public static function load_textdomain() {
			load_plugin_textdomain( 'jsm-show-post-meta', false, 'jsm-show-post-meta/languages/' );
		}

		public static function check_wp_version() {
			global $wp_version;
			if ( version_compare( $wp_version, self::$wp_min_version, '<' ) ) {
				$plugin = plugin_basename( __FILE__ );
				if ( is_plugin_active( $plugin ) ) {
					require_once( ABSPATH.'wp-admin/includes/plugin.php' );	// just in case
					$plugin_data = get_plugin_data( __FILE__, false );	// $markup = false
					deactivate_plugins( $plugin );
					wp_die( 
						sprintf( __( '%1$s requires WordPress version %2$s or higher and has been deactivated.',
							'jsm-show-post-meta' ), $plugin_data['Name'], self::$wp_min_version ).'<br/><br/>'.
						sprintf( __( 'Please upgrade WordPress before trying to reactivate the %1$s plugin.',
							'jsm-show-post-meta' ), $plugin_data['Name'] )
					);
				}
			}
		}

		public function add_meta_boxes( $post_type, $post_obj ) {
			if ( ! isset( $post_obj->ID ) )	// exclude links
				return;
	
			$this->view_cap = apply_filters( 'jsm_spm_view_cap', 'manage_options' );
	
			if ( ! current_user_can( $this->view_cap, $post_obj->ID ) || 
				! apply_filters( 'jsm_spm_post_type', true, $post_type ) )
					return;
	
			add_meta_box( 'jsm-spm', __( 'Post Meta', 'jsm-show-post-meta' ),
				array( &$this, 'show_post_meta' ), $post_type, 'normal', 'low' );
		}
	
		public function show_post_meta( $post_obj ) {
			if ( empty( $post_obj->ID ) )
				return;
	
			$post_meta = get_post_meta( $post_obj->ID );	// since wp v1.5.0
			$post_meta_filtered = apply_filters( 'jsm_spm_post_meta', $post_meta, $post_obj );
			$skip_keys = apply_filters( 'jsm_spm_skip_keys', array( '/^_encloseme/' ) );
	
			?>
			<style>
				div#jsm-spm.postbox table { 
					width:100%;
					max-width:100%;
					text-align:left;
					table-layout:fixed;
				}
				div#jsm-spm.postbox table .key-column { 
					width:30%;
				}
				div#jsm-stm.postbox table tr.added-meta { 
					background-color:#eee;
				}
				div#jsm-spm.postbox table td { 
					padding:10px;
					vertical-align:top;
					border:1px dotted #ccc;
				}
				div#jsm-spm.postbox table td div {
					overflow-x:auto;
				}
				div#jsm-spm.postbox table td div pre { 
					margin:0;
					padding:0;
				}
			</style>
			<?php

			echo '<table><thead><tr><th class="key-column">'.__( 'Key', 'jsm-show-post-meta' ).'</th>';
			echo '<th class="value-column">'.__( 'Value', 'jsm-show-post-meta' ).'</th></tr></thead><tbody>';
	
			ksort( $post_meta_filtered );
			foreach( $post_meta_filtered as $meta_key => $arr ) {
				foreach ( $skip_keys as $preg_dns )
					if ( preg_match( $preg_dns, $meta_key ) )
						continue 2;
	
				foreach ( $arr as $num => $el )
					$arr[$num] = maybe_unserialize( $el );
	
				$is_added = isset( $post_meta[$meta_key] ) ? false : true;

				echo $is_added ? '<tr class="added-meta">' : '<tr>';
				echo '<td class="key-column"><div class="key-cell"><pre>'.
					esc_html( $meta_key ).'</pre></div></td>';
				echo '<td class="value-column"><div class="value-cell"><pre>'.
					esc_html( var_export( $arr, true ) ).'</pre></div></td></tr>'."\n";
			}
			echo '</tbody></table>';
		}
	}

	JSM_Show_Post_Meta::get_instance();
}

?>
