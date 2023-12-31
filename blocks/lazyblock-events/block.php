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
$query = get_posts(array('post_type' => 'event', 'posts_per_page' => -1, 'orderby' => 'meta_value', 'meta_key' => 'date', 'meta_type' => 'DATETIME', 'order' => 'ASC'));
$context = Timber::context();
$context['events'] = $query;
$context['events_to_show'] =  $attributes['events_to_show'];
$context['attributes'] = $attributes;


Timber::render('lazyblock-events.twig', $context);
