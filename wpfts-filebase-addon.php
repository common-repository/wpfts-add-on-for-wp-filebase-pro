<?php

/*
Plugin Name: WPFTS Add-on for WP-Filebase Pro
Description: Implementing an indexing and searching files uploaded by WP Filebase Pro plugin
Version: 1.3.0
Tested up to: 5.7.2
Author: Epsiloncool
Author URI: https://e-wm.org
License: GPL3
License URI: http://www.gnu.org/licenses/gpl-3.0.html
Text Domain: wpfts_lang
Domain Path: /languages/
*/

/**
 *  Copyright 2013-2021 Epsiloncool
 *
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 ******************************************************************************
 *  I am thank you for the help by buying PRO version of this plugin 
 *  at https://fulltextsearch.org/ 
 *  It will keep me working further on this useful product.
 ******************************************************************************
 * 
 *  @copyright 2013-2021
 *  @license GPLv3
 *  @version 1.3.0
 *  @package Wordpress Fulltext Search Pro
 *  @author Epsiloncool <info@e-wm.org>
 */

/**
 * This addon is intended to be run with Wordpress Fulltext Search Pro plugin 2.40.151+
 * 
 * It will help WPFTS to find and index files, which are mantained by WP Filebase Pro plugin.
 */

add_filter('wpfts_index_post', function($index, $post)
{
	global $wpdb, $wpfts_core;

	if ($wpfts_core && ($post->post_type == 'wpfb_filepage')) {

		$file_id = get_post_meta($post->ID, 'file_id', true);

		// Find WPFB file with this ID
		$wpfb_files = isset($wpdb->wpfilebase_files) ? $wpdb->wpfilebase_files : 'wp_wpfb_files';
	
		$q = 'select * from `'.$wpfb_files.'` where file_id = "'.addslashes($file_id).'"';
		$r4 = $wpdb->get_results($q, ARRAY_A);
	
		if (count($r4) > 0) {
			$file_path = $r4[0]['file_path'];
	
			$opt = get_option('wpfilebase');
	
			$fbdir = $opt['upload_path'];
	
			$local = ABSPATH.$fbdir.'/'.$file_path;

			if (is_file($local) && file_exists($local)) {
				require_once $wpfts_core->root_dir.'/includes/wpfts_utils.class.php';

				$ret = WPFTS_Utils::GetCachedFileContent_ByLocalLink($local, false, true);
	
				$index['filebase_content'] = isset($ret['post_content']) ? trim($ret['post_content']) : '';
			}
		}
	}

	return $index;
}, 3, 2);

add_action('pre_get_posts', function($wpq)
{
	if ($wpq->is_main_query() && $wpq->is_search()) {
		// Add 'wpfb_filepage' to the list of searchable post_types
		$inc = 'wpfb_filepage';

		$post_types = $wpq->get('post_type');
		if ($post_types && ($post_types != 'any')) {
			if (is_array($post_types)) {
				if (!in_array($inc, $post_types)) {
					$post_types[] = $inc;
				}
			} else {
				if ($post_types != $inc) {
					$post_types = array($post_types, $inc);
				}
			}
		} else {
			$in_search_post_types = get_post_types( array('exclude_from_search' => false) );
			$post_types = array_merge(array($inc), $in_search_post_types);
		}
		$wpq->set('post_type', $post_types);
	}
}, 1, 5);

add_action('parse_query', function($wpq)
{
	remove_filter('the_excerpt', array('WPFB_Core', 'SearchExcerptFilter'), 100);
}, 255, 1);
