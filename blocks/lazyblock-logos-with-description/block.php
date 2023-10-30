<?php

/**
 * The template for displaying the Logo's with title
 *
 * Methods for TimberHelper can be found in the /functions sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */
$context = Timber::context();
$context['logos'] = $attributes;
Timber::render('logos-with-description.twig', $context);
