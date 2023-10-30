<?php

/**
 * The template for displaying the Hero Banner Block
 *
 * Methods for TimberHelper can be found in the /functions sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */
$context = Timber::context();

$context['hero'] = $attributes;
Timber::render('hero-full-image.twig', $context);
