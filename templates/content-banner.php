<div class="row">
  <div class="hidden-print">
    <div class="background" style="background-image: url('<?php echo has_post_thumbnail() ? get_the_post_thumbnail_url() : get_header_image(); ?>');">
      <div class="container container-menu">
        <div class="row">
          <div class="logo">
            <?php the_custom_logo(); ?>
          </div>
        </div>
        <div class="row row-menu container-signup-banner">
          <div class="menu">
            <?php
              if (has_nav_menu('home_page_left_navigation')) {
                wp_nav_menu( array(
                  'theme_location' => 'home_page_left_navigation',
                  'walker' => new wp_bootstrap_navwalker(),
                  'menu_class' => 'nav nav-pills nav-stacked text-center'
                ));
              }
            ?>
          </div>
          <div class="menu menu-right">
            <?php
              if (has_nav_menu('home_page_right_navigation')) {
                wp_nav_menu( array(
                  'theme_location' => 'home_page_right_navigation',
                  'walker' => new wp_bootstrap_navwalker(),
                  'menu_class' => 'nav nav-pills nav-stacked text-center'
                ));
              }
            ?>
          </div>
          <div class="col-xs-12 col-md-6 col-md-pull-3 card">
            <?php dynamic_sidebar('sidebar-pre-footer'); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
