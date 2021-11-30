=== JSM's Show Post Metadata ===
Plugin Name: JSM's Show Post Metadata
Plugin Slug: jsm-show-post-meta
Text Domain: jsm-show-post-meta
Domain Path: /languages
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl.txt
Assets URI: https://jsmoriss.github.io/jsm-show-post-meta/assets/
Tags: custom fields, meta, post meta, post types, delete, debug, inspector
Contributors: jsmoriss
Requires PHP: 7.2
Requires At Least: 5.2
Tested Up To: 5.8.2
Stable Tag: 2.0.0

Show post metadata (aka custom fields) in a metabox when editing posts / pages - a great tool for debugging issues with post metadata.

== Description ==

The JSM's Show Post Metadata plugin displays post (ie. posts, pages, and custom post types) meta keys (aka custom field names) and their unserialized values in a metabox at the bottom of post editing pages.

By default, the current user needs to have the 'manage_options' capability to view the Post Metadata metabox, and the 'manage_options' capability to delete individual meta keys. The default 'manage_options' capability can be modified using the 'jsmspm_show_metabox_capability' and 'jsmspm_delete_meta_capability' filters (see filters.txt in the plugin folder).

There are no plugin settings - simply *install* and *activate* the plugin.

= Related Plugins =

* [JSM's Show Comment Metadata](https://wordpress.org/plugins/jsm-show-comment-meta/)
* [JSM's Show Term Metadata](https://wordpress.org/plugins/jsm-show-term-meta/)
* [JSM's Show User Metadata](https://wordpress.org/plugins/jsm-show-user-meta/)
* [JSM's Show Registered Shortcodes](https://wordpress.org/plugins/jsm-show-registered-shortcodes/)

== Installation ==

= Automated Install =

1. Go to the wp-admin/ section of your website.
1. Select the *Plugins* menu item.
1. Select the *Add New* sub-menu item.
1. In the *Search* box, enter the plugin name.
1. Click the *Search Plugins* button.
1. Click the *Install Now* link for the plugin.
1. Click the *Activate Plugin* link.

= Semi-Automated Install =

1. Download the plugin ZIP file.
1. Go to the wp-admin/ section of your website.
1. Select the *Plugins* menu item.
1. Select the *Add New* sub-menu item.
1. Click on *Upload* link (just under the Install Plugins page title).
1. Click the *Browse...* button.
1. Navigate your local folders / directories and choose the ZIP file you downloaded previously.
1. Click on the *Install Now* button.
1. Click the *Activate Plugin* link.

== Frequently Asked Questions ==

== Screenshots ==

01. The "Post Metadata" metabox added to admin post editing pages.

== Changelog ==

<h3 class="top">Version Numbering</h3>

Version components: `{major}.{minor}.{bugfix}[-{stage}.{level}]`

* {major} = Major structural code changes / re-writes or incompatible API changes.
* {minor} = New functionality was added or improved in a backwards-compatible manner.
* {bugfix} = Backwards-compatible bug fixes or small improvements.
* {stage}.{level} = Pre-production release: dev < a (alpha) < b (beta) < rc (release candidate).

<h3>Repositories</h3>

* [GitHub](https://jsmoriss.github.io/jsm-show-post-meta/)
* [WordPress.org](https://plugins.trac.wordpress.org/browser/jsm-show-post-meta/)

<h3>Changelog / Release Notes</h3>

**Version 3.0.0 (2021/11/30)**

* **New Features**
	* Added the ability to delete individual post meta.
* **Improvements**
	* None.
* **Bugfixes**
	* None.
* **Developer Notes**
	* Updated the `js/com/jquery-admin-page.js` library.
	* Updated the `JsmSpmScript->get_admin_page_script_data()` method to add an '_ajax_actions' array.
* **Requires At Least**
	* PHP v7.2.
	* WordPress v5.2.

**Version 2.0.0 (2021/11/26)**

* **New Features**
	* When a post / page is saved in the WordPress block editor, the Post Metadata metabox is now refreshed.
* **Improvements**
	* None.
* **Bugfixes**
	* None.
* **Developer Notes**
	* Complete rewrite of the plugin - all class, method, and filter names have changed.
* **Requires At Least**
	* PHP v7.2.
	* WordPress v5.2.

== Upgrade Notice ==

= 3.0.0 =

(2021/11/30) Added the ability to delete individual post meta.

= 2.0.0 =

(2021/11/26) When a post / page is saved in the WordPress block editor, the Post Metadata metabox is now refreshed.

