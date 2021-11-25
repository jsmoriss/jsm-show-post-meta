<?php
/**
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl.txt
 * Copyright 2012-2021 Jean-Sebastien Morisset (https://surniaulula.com/)
 */

if ( ! defined( 'ABSPATH' ) ) {

	die( 'These aren\'t the droids you\'re looking for.' );
}

if ( ! defined( 'JSMSPM_PLUGINDIR' ) ) {

	die( 'Do. Or do not. There is no try.' );
}

if ( ! class_exists( 'JsmShowPostMetaPost' ) ) {

	class JsmShowPostMetaPost {

		public function __construct() {
			
			add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ), 1000, 2 );

			add_action( 'wp_ajax_get_metabox_postbox_id_jsmspm_inside', array( $this, 'ajax_get_metabox' ) );
		}

		public function add_meta_boxes( $post_type, $post_obj ) {

			if ( ! isset( $post_obj->ID ) ) {	// Exclude links.

				return;
			}

			$view_cap = apply_filters( 'jsmspm_view_cap', 'manage_options' );

			if ( ! current_user_can( $view_cap, $post_obj->ID ) ) {
			
				return;

			} elseif ( ! apply_filters( 'jsmspm_post_type', true, $post_type ) ) {

				return;
			}

			$metabox_id      = 'jsmspm';
			$metabox_title   = __( 'Post Metadata', 'jsm-show-post-meta' );
			$metabox_screen  = $post_type;
			$metabox_context = 'normal';
			$metabox_prio    = 'low';
			$callback_args   = array(	// Second argument passed to the callback function / method.
				'__block_editor_compatible_meta_box' => true,
			);

			add_meta_box( $metabox_id, $metabox_title, array( $this, 'show_metabox' ), $metabox_screen, $metabox_context, $metabox_prio, $callback_args );
		}

		public function ajax_get_metabox() {

			$doing_ajax = SucomUtilWP::doing_ajax();

			if ( ! $doing_ajax ) {	// Just in case.

				return;

			} elseif ( SucomUtil::get_const( 'DOING_AUTOSAVE' ) ) {

				die( -1 );
			}

			check_ajax_referer( JSMSPM_NONCE_NAME, '_ajax_nonce', true );

			if ( empty( $_POST[ 'post_id' ] ) ) {

				die( -1 );
			}

			$post_id = $_POST[ 'post_id' ];

			$post_obj = SucomUtil::get_post_object( $post_id );

			if ( ! is_object( $post_obj ) ) {

				die( -1 );

			} elseif ( empty( $post_obj->post_type ) ) {

				die( -1 );

			} elseif ( empty( $post_obj->post_status ) ) {

				die( -1 );
			}

			$metabox_html = $this->get_metabox( $post_obj );

			die( $metabox_html );
		}

		public function show_metabox( $post_obj ) {

			echo $this->get_metabox( $post_obj );
		}

		public function get_metabox( $post_obj ) {

			if ( empty( $post_obj->ID ) ) {

				return;
			}

			$post_meta_orig     = get_post_meta( $post_obj->ID );
			$post_meta_filtered = apply_filters( 'jsmspm_post_meta', $post_meta_orig, $post_obj );
			$skip_keys_preg     = apply_filters( 'jsmspm_skip_keys', array( '/^_encloseme/' ) );
			$metabox_html       = $this->get_metabox_css();
			$metabox_html       .= '<table><thead><tr><th class="key-column">' . __( 'Key', 'jsm-show-post-meta' ) . '</th>';
			$metabox_html       .= '<th class="value-column">' . __( 'Value', 'jsm-show-post-meta' ) . '</th></tr></thead><tbody>';

			ksort( $post_meta_filtered );

			foreach( $post_meta_filtered as $key => $el ) {

				foreach ( $skip_keys_preg as $preg_expr ) {

					if ( preg_match( $preg_expr, $key ) ) {

						continue 2;
					}
				}

				$is_added = isset( $post_meta_orig[ $key ] ) ? false : true;
				$key_esc  = esc_html( $key );
				$el       = $this->maybe_unserialize_array( $el );
				$el_esc   = esc_html( var_export( $el, true ) );

				$metabox_html .= $is_added ? '<tr class="added-meta">' : '<tr>';
				$metabox_html .= '<td class="key-column"><div class="key-cell"><pre>' . $key_esc . '</pre></div></td>';
				$metabox_html .= '<td class="value-column"><div class="value-cell"><pre>' . $el_esc . '</pre></div></td></tr>' . "\n";
			}

			$metabox_html .= '</tbody></table>';

			return $metabox_html;
		}

		public function maybe_unserialize_array( $mixed ) {

			if ( is_array( $mixed ) ) {	// Just in case.

				foreach ( $mixed as $num => $el ) {

					$mixed[ $num ] = $this->maybe_unserialize_array( $el );
				}

			} else {

				$mixed = maybe_unserialize( $mixed );
			}

			return $mixed;
		}

		public function get_metabox_css() {

			$custom_style_css = '

				div#jsmspm.postbox table {
					width:100%;
					max-width:100%;
					text-align:left;
					table-layout:fixed;
				}

				div#jsmspm.postbox table .key-column {
					width:30%;
				}

				div#jsmspm.postbox table tr.added-meta {
					background-color:#eee;
				}

				div#jsmspm.postbox table td {
					padding:10px;
					vertical-align:top;
					border:1px dotted #ccc;
				}

				div#jsmspm.postbox table td div {
					overflow-x:auto;
				}

				div#jsmspm.postbox table td div pre {
					margin:0;
					padding:0;
				}
			';

			$custom_style_css = SucomUtil::minify_css( $custom_style_css, $filter_prefix = 'jsmspm' );

			return '<style type="text/css">' . $custom_style_css . '</style>';
		}
	}
}
