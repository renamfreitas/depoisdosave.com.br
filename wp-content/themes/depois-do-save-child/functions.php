<?php
/**
 * Depois do Save child theme (Twenty Twenty-Five).
 *
 * Block theme: Site Editor changes are stored in the database.
 * Versioned code (this file, style.css, theme.json, template overrides) lives here.
 *
 * @package DepoisDoSaveChild
 */

declare(strict_types=1);

if (!defined('ABSPATH')) {
	exit;
}

/**
 * Enqueue the child stylesheet on the front end.
 *
 * Twenty Twenty-Five loads its design through theme.json, so this file has no parent handle to depend on.
 */
function depois_do_save_child_enqueue_styles(): void {
	wp_enqueue_style(
		'depois-do-save-child-style',
		get_stylesheet_uri(),
		array(),
		wp_get_theme()->get('Version')
	);
}
add_action('wp_enqueue_scripts', 'depois_do_save_child_enqueue_styles');
