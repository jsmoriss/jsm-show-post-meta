<?php
/*
 * Plugin Name: JSM's Show Post Meta
 * Plugin URI: http://wordpress.org/extend/plugins/jsm-show-post-meta/
 * Author: JS Morisset
 * Author URI: http://surniaulula.com/
 * License: GPLv3
 * License URI: http://www.gnu.org/licenses/gpl.txt
 * Description: Show all post meta (aka custom fields) keys and their unserialized values in a metabox on post editing pages.
 * Requires At Least: 3.0
 * Tested Up To: 4.6
 * Version: 1.0.4-1
 *
 * The original code comes from the Post Meta Inspector plugin
 * (https://wordpress.org/plugins/post-meta-inspector/) by Daniel Bachhuber
 * and Automattic. Improvements include better CSS for display boundaries,
 * unserializing array values, arrays shown as preformatted wrapped text,
 * additional filters, etc.
 */

class JSM_Show_Post_Meta {

	private static $instance;

	public $view_cap;

	public static function instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new JSM_Show_Post_Meta;
			self::setup_actions();
		}
		return self::$instance;
	}

	private function __construct() {
	}

	private static function setup_actions() {
		if ( ! is_admin() )
			return;

		add_action( 'add_meta_boxes', 
			array( self::$instance, 'add_meta_boxes' ), 1000, 2 );
	}

	public function add_meta_boxes( $post_type, $post_obj ) {
		if ( ! isset( $post_obj->ID ) )	// exclude links
			return;

		$this->view_cap = apply_filters( 'jsm_spm_view_cap', 'manage_options' );

		if ( ! current_user_can( $this->view_cap, $post_obj->ID ) || 
			! apply_filters( 'jsm_spm_post_type', true, $post_type ) )
				return;

		add_meta_box( 'jsm-spm', 'Post Meta', 
			array( &$this, 'show_post_meta' ), $post_type, 'normal', 'low' );
	}

	public function show_post_meta( $post_obj ) {
		if ( empty( $post_obj->ID ) )
			return;

		$post_meta = apply_filters( 'jsm_spm_post_meta', 
			get_post_meta( $post_obj->ID ), $post_obj );	// since wp v1.5.0

		$skip_keys = apply_filters( 'jsm_spm_skip_keys', 
			array(
				'_encloseme',
			)
		);

		?>
		<style>
			div#jsm-spm.postbox table { 
				width:100%;
				max-width:100%;
				text-align:left;
			}
			div#jsm-spm.postbox table td { 
				padding:10px;
				vertical-align:top;
				border:1px dotted #ccc;
			}
			div#jsm-spm.postbox table td pre { 
				margin:0;
				padding:0;
				white-space:pre-wrap;
			}
			div#jsm-spm.postbox table .key-column { 
				width:20%;
			}
		</style>
		<table><thead><tr><th class="key-column">Key</th>
		<th class="value-column">Value</th></tr></thead><tbody>
		<?php

		ksort( $post_meta );
		foreach( $post_meta as $key => $arr ) {
			foreach ( $skip_keys as $dnsw )
				if ( strpos( $key, $dnsw ) === 0 )
					continue 2;

			foreach ( $arr as $num => $el )
				$arr[$num] = maybe_unserialize( $el );

			echo '<tr><td class="key-column">'.esc_html( $key ).'</td>'.
				'<td class="value-column"><pre>'.
					esc_html( var_export( $arr, true ) ).'</pre></td></tr>';
		}
		echo '</tbody></table>';
	}
}

function jsm_show_post_meta() {
	return JSM_Show_Post_Meta::instance();
}

add_action( 'plugins_loaded', 'jsm_show_post_meta' );

