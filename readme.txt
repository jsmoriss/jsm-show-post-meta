=== JSM's Show Post Meta ===
Plugin Name: JSM's Show Post Meta
Plugin Slug: jsm-show-post-meta
Text Domain: jsm-show-post-meta
Domain Path: /languages
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl.txt
Donate Link:
Assets URI: https://jsmoriss.github.io/jsm-show-post-meta/assets/
Tags: meta, post meta, custom fields, debug, tools
Contributors: jsmoriss
Requires At Least: 3.0
Tested up to: 4.6
Stable tag: 1.0.4-1

Show all post meta (aka custom fields) keys and their unserialized values in a metabox on post editing pages.

== Description ==

<strong>Wondering about the post meta your theme and/or plugins might be creating?</strong>

<strong>Want to find the name of a specific post meta key?</strong>

<strong>Need some help debugging your post meta?</strong>

<blockquote>
The JSM's Show Post Meta plugin displays all post meta (aka custom fields) keys and their unserialized values in a metabox at the bottom of post editing pages.
</blockquote>

= Plugin Settings =

There are no plugin settings - simply activate to add a metabox to all post editing pages.

= Developer Filters =

*'jsm_spm_view_cap' ( 'manage_options' )* &mdash; The current user must have these capabilities to view the "Post Meta" metabox (default: 'manage_options' ).</p>

*'jsm_spm_post_type' ( true, $post_type )* &mdash; Add the "Post Meta" metabox to the editing pages for this post type.</p>

*'jsm_spm_post_meta' ( $post_meta, $post_obj )* &mdash; The post meta array (unserialized) retrieved for display in the metabox.</p>

*'jsm_spm_skip_keys' ( $array )* &mdash; An array of key name prefixes to ignore (default: '_encloseme' ).</p>

= Related Plugins =

* [JSM's Show Term Meta](https://wordpress.org/plugins/jsm-show-term-meta/) (requires WordPress v4.4 or better)
* [JSM's Show User Meta](https://wordpress.org/plugins/jsm-show-user-meta/)

== Installation ==

= Automated Install =

1. Go to the wp-admin/ section of your website
1. Select the *Plugins* menu item
1. Select the *Add New* sub-menu item
1. In the *Search* box, enter the plugin name
1. Click the *Search Plugins* button
1. Click the *Install Now* link for the plugin
1. Click the *Activate Plugin* link

= Semi-Automated Install =

1. Download the plugin archive file
1. Go to the wp-admin/ section of your website
1. Select the *Plugins* menu item
1. Select the *Add New* sub-menu item
1. Click on *Upload* link (just under the Install Plugins page title)
1. Click the *Browse...* button
1. Navigate your local folders / directories and choose the zip file you downloaded previously
1. Click on the *Install Now* button
1. Click the *Activate Plugin* link

== Frequently Asked Questions ==

= Frequently Asked Questions =

* None

== Other Notes ==

= Additional Documentation =

* None

== Screenshots ==

01. The Post Meta metabox added to admin post editing pages.

== Changelog ==

= Repositories =

* [GitHub](https://github.com/jsmoriss/jsm-show-post-meta)
* [WordPress.org](https://wordpress.org/plugins/jsm-show-post-meta/developers/)

= Changelog / Release Notes =

**Version 1.0.4-1 (2016/08/04)**

* *New Features*
	* None
* *Improvements*
	* Added check for is_admin() before hooking actions and filters.
	* Added 20% width in CSS for the key column.
* *Bugfixes*
	* None
* *Developer Notes*
	* None

== Upgrade Notice ==

= 1.0.4-1 =

(2016/08/04) Added check for is_admin() before hooking actions and filters. Added 20% width in CSS for the key column.
