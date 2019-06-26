<?php
/**
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
 * Requires PHP: 5.6
 * Requires At Least: 3.8
 * Tested Up To: 5.2.2
 * Version: 1.0.8
 *
 * Version Numbering: {major}.{minor}.{bugfix}[-{stage}.{level}]
 *
 *      {major}         Major structural code changes / re-writes or incompatible API changes.
 *      {minor}         New functionality was added or improved in a backwards-compatible manner.
 *      {bugfix}        Backwards-compatible bug fixes or small improvements.
 *      {stage}.{level} Pre-production release: dev < a (alpha) < b (beta) < rc (release candidate).
 *
 * Copyright 2016-2019 Jean-Sebastien Morisset (https://surniaulula.com/)
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( 'These aren\'t the droids you\'re looking for...' );
}

if ( ! class_exists( 'JSM_Show_Post_Meta' ) ) {

	class JSM_Show_Post_Meta {

		private static $instance;
		private static $wp_min_version = '3.8';
	
		public $view_cap;
	
		private function __construct() {
			if ( is_admin() ) {
				add_action( 'plugins_loaded', array( __CLASS__, 'load_textdomain' ) );
				add_action( 'admin_init', array( __CLASS__, 'check_wp_version' ) );	// Requires WP v3.8 or better.
				add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ), 1000, 2 );
			}
		}
	
		public static function &get_instance() {

			if ( ! isset( self::$instance ) ) {
				self::$instance = new self;
			}

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

					if ( ! function_exists( 'deactivate_plugins' ) ) {
						require_once trailingslashit( ABSPATH ) . 'wp-admin/includes/plugin.php';
					}

					$plugin_data = get_plugin_data( __FILE__, false ); // $markup is false

					deactivate_plugins( $plugin, true ); // $silent is true

					wp_die( 
						'<p>' . sprintf( __( '%1$s requires %2$s version %3$s or higher and has been deactivated.',
							'jsm-show-post-meta' ), $plugin_data['Name'], 'WordPress', self::$wp_min_version ) . '</p>' . 
						'<p>' . sprintf( __( 'Please upgrade %1$s before trying to re-activate the %2$s plugin.',
							'jsm-show-post-meta' ), 'WordPress', $plugin_data['Name'] ) . '</p>'
					);
				}
			}
		}

		public function add_meta_boxes( $post_type, $post_obj ) {

			if ( ! isset( $post_obj->ID ) ) {	// exclude links
				return;
			}
	
			$this->view_cap = apply_filters( 'jsm_spm_view_cap', 'manage_options' );
	
			if ( ! current_user_can( $this->view_cap, $post_obj->ID ) || ! apply_filters( 'jsm_spm_post_type', true, $post_type ) ) {
				return;
			}

			$metabox_id      = 'jsm-spm';
			$metabox_title   = __( 'Post Meta', 'jsm-show-post-meta' );
			$metabox_screen  = $post_type;
			$metabox_context = 'normal';
			$metabox_prio    = 'low';
			$callback_args   = array(	// Second argument passed to the callback function / method.
				'__block_editor_compatible_meta_box' => true,
			);

			add_meta_box( $metabox_id, $metabox_title,
				array( $this, 'show_post_meta' ), $metabox_screen,
					$metabox_context, $metabox_prio, $callback_args );
		}
	
		public function show_post_meta( $post_obj ) {

			if ( empty( $post_obj->ID ) ) {
				return;
			}
	
			$post_meta          = get_post_meta( $post_obj->ID );
			$post_meta_filtered = apply_filters( 'jsm_spm_post_meta', $post_meta, $post_obj );
			$skip_keys          = apply_filters( 'jsm_spm_skip_keys', array( '/^_encloseme/' ) );
	
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

			echo '<table><thead><tr><th class="key-column">' . __( 'Key', 'jsm-show-post-meta' ) . '</th>';
			echo '<th class="value-column">' . __( 'Value', 'jsm-show-post-meta' ) . '</th></tr></thead><tbody>';
	
			ksort( $post_meta_filtered );

			foreach( $post_meta_filtered as $meta_key => $arr ) {

				foreach ( $skip_keys as $preg_dns ) {
					if ( preg_match( $preg_dns, $meta_key ) ) {
						continue 2;
					}
				}
	
				foreach ( $arr as $num => $el ) {
					$arr[ $num ] = maybe_unserialize( $el );
				}
	
				$is_added = isset( $post_meta[ $meta_key ] ) ? false : true;

				echo $is_added ? '<tr class="added-meta">' : '<tr>';
				echo '<td class="key-column"><div class="key-cell"><pre>' . esc_html( $meta_key ) . '</pre></div></td>';
				echo '<td class="value-column"><div class="value-cell"><pre>' . esc_html( var_export( $arr, true ) ) . '</pre></div></td></tr>' . "\n";
			}

			echo '</tbody></table>';
		}
	}

	JSM_Show_Post_Meta::get_instance();
}
