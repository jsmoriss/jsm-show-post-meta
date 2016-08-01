=== JSM's Show Post Meta ===
Plugin Name: JSM's Show Post Meta
Plugin Slug: jsm-show-post-meta
Contributors: jsmoriss
Tags: post meta, custom fields, tools
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl.txt
Tested up to: 4.6
Requires At Least: 3.1
Stable tag: 1.0.3-1

Show all post meta (aka custom fields) keys and their unserialized values in a metabox on post editing pages.

== Description ==

<blockquote>
<p><strong>Wondering about the post meta your theme and/or plugins might be creating?</strong></p>
<p><strong>Want to find the name of a specific post meta key?</strong></p>
<p><strong>Need some help debugging your post meta?</strong></p>
</blockquote>

The JSM's Show Post Meta plugin displays all post meta (aka custom fields) keys and their unserialized values in a metabox on the bottom of post editing pages.

= Available Filters =

<code>jsm_spm_view_cap ( 'manage_options' )</code> &mdash; The current user must have these capabilities to view the "Post Meta" metabox (default: 'manage_options' ).

<code>jsm_spm_post_type ( true, $post_type )</code> &mdash; Add the "Post Meta" metabox to the editing pages for this post type.

<code>jsm_spm_post_meta ( $post_meta, $post_obj )</code> &mdash; The post meta array (unserialized) retrieved for display in the metabox.

<code>jsm_spm_skip_keys ( $array )</code> &mdash; An array of key name prefixes to ignore (default: '_encloseme' ).

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

**Version 1.0.3-1 (2016/07/30)**

* *New Features*
	* None
* *Improvements*
	* The post meta keys are now sorted. 
* *Bugfixes*
	* None
* *Developer Notes*
	* Added the 'jsm_spm_skip_keys' filter.

== Upgrade Notice ==

= 1.0.3-1 =

(2016/08/01) Added the 'jsm_spm_skip_keys' filter.

