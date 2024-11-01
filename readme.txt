=== WPFTS Add-on for WP-Filebase Pro ===
Contributors: Epsiloncool
Donate link: https://www.patreon.com/epsiloncool
Tags: fulltext search, wp filebase pro, add-on, file search, content search
Requires at least: 3.0.1
Tested up to: 5.7.2
Stable tag: trunk
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl-3.0.html

This plugin adds a data bridge between WP-Filebase Pro plugin and WP Fulltext Search Pro (WPFTS) plugin to allow WPFTS index and search files, uploaded by WP-Filebase Pro by their content. 

== Description ==

If you are the active user of the WP Filebase Pro plugin, you may notice the leak of file search by content functionality.

Another great plugin WP Fulltext Search Pro may implement this type of search, but it does not recognize WP Filebase's files directly.

This plugin adds a "bridge" for WPFTS to let it understand WP Filebase's files and implement the search on them like any other attachment files.

=== NOTICES ===

This plugin adds WP Filebase Pro's files to search results automatically.
Also it disables WP Filebase Pro's file lists in search results and replaces it with WPFTS's Smart Excerpts (that contains the relevant portion of the file content).

If you want to re-enable WP Filebase Pro's file lists, please comment out line 114 in this plugin body and Contact Us so we make a modification in the plugin release.

= Documentation =

Please refer [WPFTS Add-on for WP-Filebase Pro Documentation](https://fulltextsearch.org/addon/wpfts-wpfilebase "WPFTS Add-on for WP-Filebase Pro Documentation").

== Installation ==

1. Unpack and upload `wpfts-filebase-addon` folder with all files to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Make sure WPFTS Pro is active and WP-Filebase Pro is active too
1. Go to WPFTS Pro Settings page / Main Settings and press "Rebuild Index" button

== Frequently Asked Questions ==

= Where can I put some notices, comments or bugreports? =

Do not hesistate to write to us at [Contact Us](https://fulltextsearch.org/contact/ "Contact Us") page.

== Changelog ==
= 1.3.0 =
* Code refactored to be compatible with 2.40.151+

= 1.2.0 =
* First version to be in Wordpress repository, just install it

= 1.1.0 =
* Alpha release, checked and tested

= 1.0.0 =
* Test release