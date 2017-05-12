<?php
/**
 * Sage includes
 *
 * The $sage_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/sage/pull/1042
 */
$sage_includes = [
  'lib/assets.php',    // Scripts and stylesheets
  'lib/extras.php',    // Custom functions
  'lib/setup.php',     // Theme setup
  'lib/titles.php',    // Page titles
  'lib/wrapper.php',   // Theme wrapper class
  'lib/customizer.php', // Theme customizer
  'lib/navwalker.php',  // Bootstrap Nav Walker
];

foreach ($sage_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);

// Add Phi logo to wp-login

function phi_login_logo() { ?>
  <style type="text/css">
    #login h1 a, .login h1 a {
      background: url(<?php echo get_stylesheet_directory_uri(); ?>/assets/images/phi.svg) center no-repeat transparent;
      -webkit-background-size: contain;
      background-size: contain;
    }
  </style>
<?php }
add_action( 'login_enqueue_scripts', 'phi_login_logo' );
