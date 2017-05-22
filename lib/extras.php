<?php

namespace Roots\Sage\Extras;

use Roots\Sage\Setup;

/**
 * Add <body> classes
 */
function body_class($classes) {
  // Add page slug if it doesn't exist
  if (is_single() || is_page() && !is_front_page()) {
    if (!in_array(basename(get_permalink()), $classes)) {
      $classes[] = basename(get_permalink());
    }
  }

  // Add class if sidebar is active
  if (Setup\display_sidebar()) {
    $classes[] = 'sidebar-primary';
  }

  return $classes;
}
add_filter('body_class', __NAMESPACE__ . '\\body_class');

/**
 * Clean up the_excerpt()
 */
function excerpt_more() {
  return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'sage') . '</a>';
}
add_filter('excerpt_more', __NAMESPACE__ . '\\excerpt_more');

/**
 * Change WooCommerce checkout page
 */
add_filter('woocommerce_enable_order_notes_field', '__return_false');

/**
 * Custom shortcodes.
 */
foreach (['candidate1', 'candidate2', 'district', 'twitter', 'facebook', 'youtube'] as $setting) {
  add_shortcode('fi-' . $setting, function ($atts) use ($setting) {
    return get_theme_mod($setting);
  });
}
add_shortcode('fi-cities', function ($atts) {
  $cities = get_theme_mod('cities');
  if (!empty($atts)) {
    if (array_search('newline', $atts) !== FALSE) {
      $cities = nl2br($cities);
    }
    elseif ($atts['join']) {
      $cities = implode($atts['join'], explode("\n", $cities));
    }
  }
  return $cities;
});
