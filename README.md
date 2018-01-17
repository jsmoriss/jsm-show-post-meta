<h1>JSM&#039;s Show Post Meta in a Metabox on Post Editing Pages (Great Plugin for Developers)</h1>

<table>
<tr><th align="right" valign="top" nowrap>Plugin Name</th><td>JSM&#039;s Show Post Meta</td></tr>
<tr><th align="right" valign="top" nowrap>Summary</th><td>Show all post meta (aka custom fields) keys and their unserialized values in a metabox on post editing pages.</td></tr>
<tr><th align="right" valign="top" nowrap>Stable Version</th><td>1.0.8</td></tr>
<tr><th align="right" valign="top" nowrap>Requires At Least</th><td>WordPress 3.8</td></tr>
<tr><th align="right" valign="top" nowrap>Tested Up To</th><td>WordPress 4.9.2</td></tr>
<tr><th align="right" valign="top" nowrap>Contributors</th><td>jsmoriss</td></tr>
<tr><th align="right" valign="top" nowrap>License</th><td><a href="https://www.gnu.org/licenses/gpl.txt">GPLv3</a></td></tr>
<tr><th align="right" valign="top" nowrap>Tags / Keywords</th><td>meta, post meta, inspector, custom fields, debug, tools</td></tr>
</table>

<h2>Description</h2>

<p><strong>Wondering about the post meta your theme and/or plugins might be creating?</strong></p>

<p><strong>Want to find the name of a specific post meta key?</strong></p>

<p><strong>Need some help debugging your post meta?</strong></p>

<p>The JSM's Show Post Meta plugin displays all post meta (aka custom fields) keys and their unserialized values in a metabox at the bottom of post editing pages.</p>

<p>There are no plugin settings &mdash; simply install and activate the plugin.</p>

<h4>Power-users / Developers</h4>

<p>See the plugin <a href="https://wordpress.org/plugins/jsm-show-post-meta/other_notes/">Other Notes</a> page for information on available filters.</p>

<h4>Related Plugins</h4>

<ul>
<li><a href="https://wordpress.org/plugins/jsm-show-term-meta/">JSM's Show Term Meta</a> (requires WordPress v4.4 or better)</li>
<li><a href="https://wordpress.org/plugins/jsm-show-user-meta/">JSM's Show User Meta</a></li>
</ul>


<h2>Installation</h2>

<h4>Automated Install</h4>

<ol>
<li>Go to the wp-admin/ section of your website.</li>
<li>Select the <em>Plugins</em> menu item.</li>
<li>Select the <em>Add New</em> sub-menu item.</li>
<li>In the <em>Search</em> box, enter the plugin name.</li>
<li>Click the <em>Search Plugins</em> button.</li>
<li>Click the <em>Install Now</em> link for the plugin.</li>
<li>Click the <em>Activate Plugin</em> link.</li>
</ol>

<h4>Semi-Automated Install</h4>

<ol>
<li>Download the plugin ZIP file.</li>
<li>Go to the wp-admin/ section of your website.</li>
<li>Select the <em>Plugins</em> menu item.</li>
<li>Select the <em>Add New</em> sub-menu item.</li>
<li>Click on <em>Upload</em> link (just under the Install Plugins page title).</li>
<li>Click the <em>Browse...</em> button.</li>
<li>Navigate your local folders / directories and choose the ZIP file you downloaded previously.</li>
<li>Click on the <em>Install Now</em> button.</li>
<li>Click the <em>Activate Plugin</em> link.</li>
</ol>


<h2>Frequently Asked Questions</h2>

<h3>Frequently Asked Questions</h3>

<ul>
<li>None</li>
</ul>


<h2>Other Notes</h2>

<h3>Other Notes</h3>
<h3>Additional Documentation</h3>

<p><strong>Developer Filters</strong></p>

<p><em>'jsm_spm_view_cap' ( 'manage_options' )</em> &mdash; The current user must have these capabilities to view the "Post Meta" metabox (default: 'manage_options' ).</p></p>

<p><em>'jsm_spm_post_type' ( true, $post_type )</em> &mdash; Add the "Post Meta" metabox to the editing pages for this post type.</p></p>

<p><em>'jsm_spm_post_meta' ( $post_meta, $post_obj )</em> &mdash; The post meta array (unserialized) retrieved for display in the metabox.</p></p>

<p><em>'jsm_spm_skip_keys' ( $array )</em> &mdash; An array of key name regular expressions to ignore (default: '/^_encloseme/' ).</p></p>

