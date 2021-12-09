<?php
/**
 * Plugin Name: Resolve Attachment Path
 * Plugin URI:  https://alpipego.com/
 * Version:     1.0.3
 * Author:      Alex
 * Author URI:  http://alpipego.com/
 */

add_filter('upload_dir', function ($uploads) {
    $uploads['path']    = ($path = realpath($uploads['path'])) ? $path : $uploads['path'];
    $uploads['basedir'] = ($basedir = realpath($uploads['basedir'])) ? $basedir : $uploads['basedir'];

    foreach ($uploads as &$fragment) {
        while (strpos($fragment, '/./')) {
            $fragment = preg_replace('%/\./%', '/', $fragment);
        }

        while (strpos($fragment, '/../')) {
            $fragment = preg_replace('%([^/]+?)/\.{2}/%', '', $fragment);
        }

        if (strpos($fragment, '/.')) {
            $fragment = preg_replace('%/\.$%', '/', $fragment);
        }

        if (strpos($fragment, '/..')) {
            $fragment = preg_replace('%([^/]+?)/\.{2}$%', '', $fragment);
        }
    }
    unset($fragment);

    return $uploads;
});
