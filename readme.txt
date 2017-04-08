=== JSM's Show Post Meta on Post Editing Pages ===
Plugin Name: JSM's Show Post Meta
Plugin Slug: jsm-show-post-meta
Text Domain: jsm-show-post-meta
Domain Path: /languages
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl.txt
Assets URI: https://jsmoriss.github.io/jsm-show-post-meta/assets/
Tags: meta, post meta, custom fields, debug, tools
Contributors: jsmoriss
Requires At Least: 3.7
Tested Up To: 4.7.3
Stable Tag: 1.0.8

Show all post meta (aka custom fields) keys and their unserialized values in a metabox on post editing pages.

== Description ==

<strong>Wondering about the post meta your theme and/or plugins might be creating?</strong>

<strong>Want to find the name of a specific post meta key?</strong>

<strong>Need some help debugging your post meta?</strong>

<p>The JSM's Show Post Meta plugin displays all post meta (aka custom fields) keys and their unserialized values in a metabox at the bottom of post editing pages.</p>

<blockquote>
<p>There are no plugin settings &mdash; simply install and activate the plugin.</p>
</blockquote>

= Developers =

See the plugin [Other Notes](https://wordpress.org/plugins/jsm-show-post-meta/other_notes/) page for information on available filters.

= Related Plugins =

* [JSM's Show Term Meta](https://wordpress.org/plugins/jsm-show-term-meta/) (requires WordPress v4.4 or better)
* [JSM's Show User Meta](https://wordpress.org/plugins/jsm-show-user-meta/)

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

1. Download the plugin archive file.
1. Go to the wp-admin/ section of your website.
1. Select the *Plugins* menu item.
1. Select the *Add New* sub-menu item.
1. Click on *Upload* link (just under the Install Plugins page title).
1. Click the *Browse...* button.
1. Navigate your local folders / directories and choose the zip file you downloaded previously.
1. Click on the *Install Now* button.
1. Click the *Activate Plugin* link.

== Frequently Asked Questions ==

= Frequently Asked Questions =

* None

== Other Notes ==

= Additional Documentation =

**Developer Filters**

*'jsm_spm_view_cap' ( 'manage_options' )* &mdash; The current user must have these capabilities to view the "Post Meta" metabox (default: 'manage_options' ).</p>

*'jsm_spm_post_type' ( true, $post_type )* &mdash; Add the "Post Meta" metabox to the editing pages for this post type.</p>

*'jsm_spm_post_meta' ( $post_meta, $post_obj )* &mdash; The post meta array (unserialized) retrieved for display in the metabox.</p>

*'jsm_spm_skip_keys' ( $array )* &mdash; An array of key name regular expressions to ignore (default: '/^_encloseme/' ).</p>

== Screenshots ==

01. The Post Meta metabox added to admin post editing pages.

== Changelog ==

= Repositories =

* [GitHub](https://jsmoriss.github.io/jsm-show-post-meta/)
* [WordPress.org](https://wordpress.org/plugins/jsm-show-post-meta/developers/)

= Version Numbering =

Version components: `{major}.{minor}.{bugfix}[-{stage}.{level}]`

* {major} = Major structural code changes / re-writes or incompatible API changes.
* {minor} = New functionality was added or improved in a backwards-compatible manner.
* {bugfix} = Backwards-compatible bug fixes or small improvements.
* {stage}.{level} = Pre-production release: dev < a (alpha) < b (beta) < rc (release candidate).

= Changelog / Release Notes =

**Version 1.0.8 (2017/04/08)**

* *New Features*
	* None
* *Improvements*
	* None
* *Bugfixes*
	* None
* *Developer Notes*
	* Maintenance release - update to version numbering scheme.
	* Dropped the package number from the production version string.

== Upgrade Notice ==

= 1.0.8 =

(2017/04/08) Maintenance release - update to version numbering scheme.

