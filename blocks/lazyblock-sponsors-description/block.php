<?php

/**
 * The template for displaying Sponsors with description block
 *
 * Methods for TimberHelper can be found in the /functions sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */
$query = get_posts(array('post_type' => 'sponsor', 'posts_per_page' => -1));

// Check if the sorting function is not already defined
if (!function_exists('custom_post_sort')) {
    // Custom sorting function
    function custom_post_sort($a, $b)
    {
        $tier_a = get_post_meta($a->ID, 'tier', true);
        $tier_b = get_post_meta($b->ID, 'tier', true);
        $order_a = get_post_meta($a->ID, 'order', true);
        $order_b = get_post_meta($b->ID, 'order', true);

        if ($tier_a == $tier_b) {
            return $order_a - $order_b; // Sort by 'order' if 'tier' is the same
        }

        return $tier_a - $tier_b; // Sort by 'tier'
    }
}

usort($query, 'custom_post_sort');

$context = Timber::context();
$context['sponsors'] = $query;
$context['attributes'] = $attributes;
Timber::render('lazyblock-sponsors-description.twig', $context);
