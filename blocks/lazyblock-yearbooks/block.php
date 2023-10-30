<?php

/**
 * The template for displaying 404 pages (Not Found)
 *
 * Methods for TimberHelper can be found in the /functions sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */
$query = get_posts(array('post_type' => 'yearbooks', 'posts_per_page' => -1));
$context = Timber::context();
$context['yearbooks'] = $query;
Timber::render('lazyblock-yearbooks.twig', $context);
