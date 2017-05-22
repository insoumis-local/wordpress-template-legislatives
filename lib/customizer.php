<?php

namespace Roots\Sage\Customizer;

use Roots\Sage\Assets;
use WP_Customize_Control;
use WP_Customize_Media_Control;

/**
 * Add postMessage support
 */
function customize_register($wp_customize) {
  $wp_customize->get_setting('blogname')->transport = 'postMessage';

  $wp_customize->add_section('fi-home', [
    'title'    => __('FI 2017 Home', 'sage'),
    'priority' => 1000,
  ]);

  $wp_customize->add_setting('cover-enabled', [
    'default'   => 1,
    'transport' => 'refresh',
    'sanitize_callback' => 'absint',
  ]);
  $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'cover-enabled', [
    'label'    => __('Activer l\'en-tête', 'sage'),
    'section'  => 'fi-home',
    'settings' => 'cover-enabled',
    'type'     => 'checkbox',
  ]));

  $wp_customize->add_setting('cover', [
    'default'   => '',
    'transport' => 'refresh',
    'sanitize_callback' => 'absint',
  ]);
  $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'cover', [
    'label'    => __('Image de couverture par défaut', 'sage'),
    'description' => __('Taille recommandée : 960x570', 'sage'),
    'section'  => 'fi-home',
    'settings' => 'cover',
  ]));

  $wp_customize->add_setting('cover-desktop', [
    'default'   => '',
    'transport' => 'refresh',
    'sanitize_callback' => 'absint',
  ]);
  $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'cover-desktop', [
    'label'    => __('[option] Grande image de couverture', 'sage'),
    'description' => __('Taille recommandée : 2000x1500 (avec le sujet centré). Sera utilisée en remplacement de l\'image par défaut pour les appareils à grand écran.', 'sage'),
    'section'  => 'fi-home',
    'settings' => 'cover-desktop',
  ]));

  $wp_customize->add_setting('candidate1', [
    'default'   => 'Candidat⋅e',
    'transport' => 'refresh',
    'sanitize_callback' => 'wp_strip_all_tags',
  ]);
  $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'candidate1', [
    'label'    => __('Candidat⋅e', 'sage'),
    'section'  => 'fi-home',
    'settings' => 'candidate1',
  ]));

  $wp_customize->add_setting('candidate2', [
    'default'   => 'Remplaçant⋅e',
    'transport' => 'refresh',
    'sanitize_callback' => 'wp_strip_all_tags',
  ]);
  $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'candidate2', [
    'label'    => __('Remplaçant⋅e', 'sage'),
    'description' => __('Supprimez cette valeur si votre remplaçant⋅e n\'a pas encore été désigné⋅e.', 'sage'),
    'section'  => 'fi-home',
    'settings' => 'candidate2',
  ]));

  $wp_customize->add_setting('cities', [
    'default'   => "Ville 1, Ville2\nCanton A, Canton B\nVille Nème arrondissement",
    'transport' => 'refresh',
    'sanitize_callback' => __NAMESPACE__ . '\\fi_sanitize_cities',
  ]);
  $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'cities', [
    'label'    => __('Villes', 'sage'),
    'description' => __('Champ limité à 150 caractères, espaces compris.', 'sage'),
    'section'  => 'fi-home',
    'settings' => 'cities',
    'type'     => 'textarea',
  ]));

  $wp_customize->add_setting('district', [
    'default'   => 'Xème circonscription du Département',
    'transport' => 'refresh',
    'sanitize_callback' => 'wp_strip_all_tags',
  ]);
  $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'district', [
    'label'    => __('Circonscription', 'sage'),
    'section'  => 'fi-home',
    'settings' => 'district',
  ]));

  // Social settings

  $wp_customize->add_section('fi-social', [
    'title'    => __('FI 2017 Social', 'sage'),
    'priority' => 1000,
  ]);

  $wp_customize->add_setting('twitter', [
    'default'   => 'https://twitter.com/',
    'transport' => 'refresh',
    'sanitize_callback' => 'esc_url',
  ]);
  $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'twitter', [
    'label'    => __('Profil twitter', 'sage'),
    'section'  => 'fi-social',
    'settings' => 'twitter',
  ]));

  $wp_customize->add_setting('facebook', [
    'default'   => 'https://facebook.com/',
    'transport' => 'refresh',
    'sanitize_callback' => 'esc_url',
  ]);
  $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'facebook', [
    'label'    => __('Profil facebook', 'sage'),
    'section'  => 'fi-social',
    'settings' => 'facebook',
  ]));

  $wp_customize->add_setting('youtube', [
    'default'   => 'https://youtube.com/',
    'transport' => 'refresh',
    'sanitize_callback' => 'esc_url',
  ]);
  $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'youtube', [
    'label'    => __('Chaîne youtube', 'sage'),
    'section'  => 'fi-social',
    'settings' => 'youtube',
  ]));
}
add_action('customize_register', __NAMESPACE__ . '\\customize_register');

function fi_sanitize_cities($string) {
  return mb_substr(wp_strip_all_tags($string, FALSE), 0, 150);
}

function customize_css() {
  $cover_id = get_theme_mod('cover');
  if (!empty($cover_id)) {
    ?>
    <style type="text/css">
      .fi-cover .picture {
        background-image: url(<?php echo wp_get_attachment_url($cover_id); ?>);
        background-size: cover;
      }
      <?php if ($cover_id = get_theme_mod('cover-desktop')): ?>
      @media (orientation: landscape) {
        .fi-cover .picture {
          background-image: url(<?php echo wp_get_attachment_url($cover_id); ?>);
        }
      }
      <?php endif; ?>
    </style>
    <?php
  }
}

add_action('wp_head', __NAMESPACE__ . '\\customize_css');

/**
 * Customizer JS
 */
function customize_preview_js() {
  wp_enqueue_script('sage/customizer', Assets\asset_path('scripts/customizer.js'), ['customize-preview'], NULL, TRUE);
}

add_action('customize_preview_init', __NAMESPACE__ . '\\customize_preview_js');
