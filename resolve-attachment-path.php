<?php
/**
 * Plugin Name: Resolve Attachment Path
 * Plugin URI:  https://alpipego.com/
 * Version:     1.0.0
 * Author:      Alex
 * Author URI:  http://alpipego.com/
 */

add_filter('upload_dir', function($uploads) {
	$uploads['path'] = realpath($uploads['path']);
	$uploads['basedir'] = realpath($uploads['basedir']);

	while (strpos($uploads['url'], '/./')) {
		$uploads['url'] = preg_replace( '%(?:/\.{1}/)%', '/', $uploads['url'] );
	}

	while (strpos($uploads['baseurl'], '/./')) {
		$uploads['baseurl'] = preg_replace( '%(?:/\.{1}/)%', '/', $uploads['baseurl'] );
	}

	while (strpos($uploads['url'], '/../')) {
		$uploads['url'] = preg_replace( '%(?:([^/]+?)/\.{2}/)%', '', $uploads['url']);
	}

	while (strpos($uploads['baseurl'], '/../')) {
		$uploads['baseurl'] = preg_replace( '%(?:([^/]+?)/\.{2}/)%', '', $uploads['baseurl']);
	}

	return $uploads;
});
