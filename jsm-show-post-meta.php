<?php
/*
 * Plugin Name: JSM Show Post Metadata
 * Text Domain: jsm-show-post-meta
 * Domain Path: /languages
 * Plugin URI: https://surniaulula.com/extend/plugins/jsm-show-post-meta/
 * Assets URI: https://jsmoriss.github.io/jsm-show-post-meta/assets/
 * Author: JS Morisset
 * Author URI: https://surniaulula.com/
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl.txt
 * Description: Show post metadata (aka custom fields) in a metabox when editing posts / pages - a great tool for debugging issues with post metadata.
 * Requires PHP: 7.4.33
 * Requires At Least: 5.9
 * Tested Up To: 6.8.0
 * Version: 4.6.2
 *
 * Version Numbering: {major}.{minor}.{bugfix}[-{stage}.{level}]
 *
 *      {major}         Major structural code changes and/or incompatible API changes (ie. breaking changes).
 *      {minor}         New functionality was added or improved in a backwards-compatible manner.
 *      {bugfix}        Backwards-compatible bug fixes or small improvements.
 *      {stage}.{level} Pre-production release: dev < a (alpha) < b (beta) < rc (release candidate).
 *
 * Copyright 2016-2025 Jean-Sebastien Morisset (https://surniaulula.com/)
 */

if ( ! defined( 'ABSPATH' ) ) {

	die( 'These aren\'t the droids you\'re looking for.' );
}

if ( ! class_exists( 'JsmSpm' ) ) {

	class JsmSpm {

		private static $instance = null;	// JsmSpm class object.

		public function __construct() {

			if ( ! is_admin() ) return;	// This is an admin-only plugin.

			$plugin_dir = trailingslashit( dirname( __FILE__ ) );

			require_once $plugin_dir . 'lib/config.php';

			JsmSpmConfig::set_constants( __FILE__ );
			JsmSpmConfig::require_libs( __FILE__ );

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

			new JsmSpmPost();
			new JsmSpmScript();
		}
	}

	JsmSpm::get_instance();
}
