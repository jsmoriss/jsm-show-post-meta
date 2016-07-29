<?php
/*
 * Plugin Name: JSM's Show Post Meta
 * Plugin URI: http://wordpress.org/extend/plugins/jsm-show-post-meta/
 * Author: JS Morisset
 * Author URI: http://surniaulula.com/
 * License: GPLv3
 * License URI: http://www.gnu.org/licenses/gpl.txt
 * Description: Show post meta in a metbox on post editing pages. 
 * Tested Up To: 4.6
 * Version: 1.0.0-1
 *
 * Original code from the "Post Meta Inspector" plugin at:
 * https://wordpress.org/plugins/post-meta-inspector/
 * By: Daniel Bachhuber and Automattic
 */

define( 'POST_META_INSPECTOR_VERSION', '1.1.1' );

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
		add_action( 'add_meta_boxes', array( self::$instance, 'action_add_meta_boxes' ) );
	}

	public function action_add_meta_boxes() {
		$this->view_cap = apply_filters( 'jsm_spm_view_cap', 'manage_options' );
		if ( ! current_user_can( $this->view_cap ) || 
			! apply_filters( 'jsm_spm_post_type', '__return_true', get_post_type() ) )
				return;
		add_meta_box( 'jsm-spm', 'Post Meta', array( self::$instance, 'show_post_meta' ), get_post_type() );
	}

	public function show_post_meta() {
		$custom_fields = get_post_meta( get_the_ID() ); ?>
		<style>
			div#jsm-spm.postbox table { 
				width:100%;
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
			}
		</style>
		<table><thead><tr><th class="key-column">Key</th>
		<th class="value-column">Value</th></tr></thead><tbody>
		<?php
		foreach( $custom_fields as $key => $arr ) {
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

