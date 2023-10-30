<?php

/**
 * The template for displaying the Logo's Small block
 *
 * Methods for TimberHelper can be found in the /functions sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */
$context = Timber::context();
$context['logos'] = $attributes;
//does not like $attributes['logos-small']🤷
Timber::render('logos-small.twig', $context);
