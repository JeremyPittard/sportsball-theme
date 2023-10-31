<?php

/**
 * The template for displaying the logo's block
 *
 * Methods for TimberHelper can be found in the /functions sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */
$context = Timber::context();
$context['section_title'] = $attributes;
Timber::render('section-title.twig', $context);
