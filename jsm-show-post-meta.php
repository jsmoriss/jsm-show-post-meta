<?php
/**
 * Plugin Name: JSM's Show Post Metadata
 * Text Domain: jsm-show-post-meta
 * Domain Path: /languages
 * Plugin URI: https://surniaulula.com/extend/plugins/jsm-show-post-meta/
 * Assets URI: https://jsmoriss.github.io/jsm-show-post-meta/assets/
 * Author: JS Morisset
 * Author URI: https://surniaulula.com/
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl.txt
 * Description: Show all post meta (aka custom fields) keys and their unserialized values in a metabox on post editing pages.
 * Requires PHP: 7.2
 * Requires At Least: 5.2
 * Tested Up To: 5.8.2
 * Version: 2.0.0-dev.2
 *
 * Version Numbering: {major}.{minor}.{bugfix}[-{stage}.{level}]
 *
 *      {major}         Major structural code changes / re-writes or incompatible API changes.
 *      {minor}         New functionality was added or improved in a backwards-compatible manner.
 *      {bugfix}        Backwards-compatible bug fixes or small improvements.
 *      {stage}.{level} Pre-production release: dev < a (alpha) < b (beta) < rc (release candidate).
 *
 * Copyright 2016-2021 Jean-Sebastien Morisset (https://surniaulula.com/)
 */

if ( ! defined( 'ABSPATH' ) ) {

	die( 'These aren\'t the droids you\'re looking for.' );
}

if ( ! class_exists( 'JsmShowPostMeta' ) ) {

	class JsmShowPostMeta {

		private static $instance = null;	// JsmShowPostMeta class object.

		private function __construct() {

			if ( ! is_admin() ) {

				return;
			}

			$plugin_dir = trailingslashit( dirname( __FILE__ ) );

			require_once $plugin_dir . 'lib/config.php';

			JsmShowPostMetaConfig::set_constants( __FILE__ );

			JsmShowPostMetaConfig::require_libs( __FILE__ );

			add_action( 'init', array( $this, 'init_textdomain' ) );

			add_action( 'init', array( $this, 'init_objects' ) );
		}

		public static function &get_instance() {

			if ( null === self::$instance ) {

				self::$instance = new self;
			}

			return self::$instance;
		}

		public function init_textdomain() {

			load_plugin_textdomain( 'jsm-show-post-meta', false, 'jsm-show-post-meta/languages/' );
		}

		public function init_objects() {

			new JsmShowPostMetaPost();
			new JsmShowPostMetaScript();
		}
	}

	JsmShowPostMeta::get_instance();
}
