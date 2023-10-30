<?php

/**
 * The template for displaying the Feature left Image Block
 *
 * Methods for TimberHelper can be found in the /functions sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */
$context = Timber::context();
$context['feature'] = $attributes;
Timber::render('feature-left-image.twig', $context);
