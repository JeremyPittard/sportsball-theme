<?php

/**
 * The template for displaying the Cards Component
 *
 * Methods for TimberHelper can be found in the /functions sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */
$context = Timber::context();
$context['cards'] = $attributes['cards'];
Timber::render('cards.twig', $context);
