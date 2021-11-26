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

if ( ! class_exists( 'JsmSpmPost' ) ) {

	class JsmSpmPost {

		public function __construct() {

			add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ), 1000, 2 );
			add_action( 'wp_ajax_get_metabox_postbox_id_jsmspm_inside', array( $this, 'ajax_get_metabox' ) );
		}

		public function add_meta_boxes( $post_type, $post_obj ) {

			if ( ! isset( $post_obj->ID ) ) {	// Exclude links.

				return;
			}

			$capability = apply_filters( 'jsmspm_add_metabox_capability', 'manage_options', $post_obj );

			if ( ! current_user_can( $capability, $post_obj->ID ) ) {

				return;

			} elseif ( ! apply_filters( 'jsmspm_add_metabox_post_type', true, $post_type ) ) {

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

		public function show_metabox( $post_obj ) {

			echo $this->get_metabox( $post_obj );
		}

		public function get_metabox( $post_obj ) {

			if ( empty( $post_obj->ID ) ) {

				return;
			}

			$post_meta   = get_post_meta( $post_obj->ID );
			$skip_keys   = array( '/^_encloseme/' );
			$metabox_id  = 'jsmspm';
			$key_title   = __( 'Key', 'jsm-show-post-meta' );
			$value_title = __( 'Value', 'jsm-show-post-meta' );

			return SucomUtilMetabox::get_table_metadata( $post_meta, $skip_keys, $post_obj, $metabox_id, $key_title, $value_title );
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
	}
}
