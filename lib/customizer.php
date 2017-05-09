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

  $wp_customize->add_section( 'general' , array(
		'title'      => __( 'FI 2017', 'mytheme' ),
		'priority'   => 30,
  ) );

	$wp_customize->add_setting( 'cover' , array(
		'default'     => '',
		'transport'   => 'refresh',
	) );
	$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'cover', array(
		'label'      => __( 'Couverture', 'mytheme' ),
		'section'    => 'general',
		'settings'   => 'cover',
	) ) );

	$wp_customize->add_setting( 'candidate1' , array(
		'default'     => '',
		'transport'   => 'refresh',
	) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'candidate1', array(
		'label'      => __( 'Candidat⋅e', 'mytheme' ),
		'section'    => 'general',
		'settings'   => 'candidate1',
	) ) );

	$wp_customize->add_setting( 'candidate2' , array(
		'default'     => '',
		'transport'   => 'refresh',
	) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'candidate2', array(
		'label'      => __( 'Remplaçant⋅e', 'mytheme' ),
		'section'    => 'general',
		'settings'   => 'candidate2',
	) ) );

	$wp_customize->add_setting( 'cities' , array(
		'default'     => '',
		'transport'   => 'refresh',
	) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'cities', array(
		'label'      => __( 'Villes', 'mytheme' ),
		'section'    => 'general',
		'settings'   => 'cities',
		'type'       => 'textarea',
	) ) );

	$wp_customize->add_setting( 'district' , array(
		'default'     => '',
		'transport'   => 'refresh',
	) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'district', array(
		'label'      => __( 'Circonscription', 'mytheme' ),
		'section'    => 'general',
		'settings'   => 'district',
	) ) );

	$wp_customize->add_setting( 'twitter' , array(
		'default'     => 'https://twitter.com/',
		'transport'   => 'refresh',
	) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'twitter', array(
		'label'      => __( 'Profil twitter', 'mytheme' ),
		'section'    => 'general',
		'settings'   => 'twitter',
	) ) );

	$wp_customize->add_setting( 'facebook' , array(
		'default'     => 'https://facebook.com/',
		'transport'   => 'refresh',
	) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'facebook', array(
		'label'      => __( 'Profil facebook', 'mytheme' ),
		'section'    => 'general',
		'settings'   => 'facebook',
	) ) );

  $wp_customize->add_section( 'social' , array(
		'title'      => __( 'Social', 'mytheme' ),
		'priority'   => 10,
  ) );
}
add_action('customize_register', __NAMESPACE__ . '\\customize_register');

function customize_css()
{
	$cover_id = get_theme_mod('cover');
	if (!empty($cover_id)) {
	?>
	<style type="text/css">
		.fi-cover .picture { background-image: url(<?php echo wp_get_attachment_url($cover_id); ?>); }
	</style>
	<?php
	}
}
add_action( 'wp_head', __NAMESPACE__ . '\\customize_css');

/**
 * Customizer JS
 */
function customize_preview_js() {
  wp_enqueue_script('sage/customizer', Assets\asset_path('scripts/customizer.js'), ['customize-preview'], null, true);
}
add_action('customize_preview_init', __NAMESPACE__ . '\\customize_preview_js');
