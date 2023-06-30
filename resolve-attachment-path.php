<?php
/**
 * Plugin Name: Resolve Attachment Path
 * Plugin URI:  https://github.com/alpipego/wp-resolve-attachment-path
 * Version:     1.1.0
 * Author:      Alex
 * Author URI:  https://alpipego.com/
 */

add_filter('upload_dir', function ($uploads) {
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
