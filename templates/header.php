<header class="banner">
  <?php
  if (is_front_page() && !is_page_template('template-cover.php') && get_theme_mod('cover-enabled', 1)) {
    get_template_part('templates/cover');
  }
  ?>
  <nav class="nav-primary navbar navbar-default navbar-static-top">
    <div class="container">
      <div class="navbar-header">
        <?php if (has_nav_menu('primary_navigation')): ?>
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-navbar-collapse" aria-expanded="false">
          Menu <span class="caret"></span>
        </button>
        <?php endif; ?>
        <?php
          if (has_custom_logo()) {
            the_custom_logo();
          } else { ?>
            <a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>">
              <?php bloginfo('name'); ?>
            </a> <?php
          }
        ?>
      </div>
      <?php if (has_nav_menu('primary_navigation')): ?>
      <div class="collapse navbar-collapse" id="main-navbar-collapse">
        <?php
        wp_nav_menu([
          'theme_location' => 'primary_navigation',
          'walker' => new wp_bootstrap_navwalker(),
          'menu_class' => 'nav navbar-nav navbar-right'
        ]);
        ?>
      </div>
      <?php endif; ?>
    </div>
  </nav>
  <nav class="navbar navbar-secondary">
    <div class="container">
      <?php if (has_nav_menu('secondary_navigation')): ?>
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#supporter-nav-collapse">
          <span class="sr-only">Activer la navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>
      <div id="supporter-nav-collapse" class="collapse navbar-collapse">
        <?php
        wp_nav_menu([
          'theme_location' => 'secondary_navigation',
          'walker' => new wp_bootstrap_navwalker(),
          'menu_class' => 'nav navbar-nav'
        ]);
        ?>
      </div>
      <?php endif; ?>
    </div>
  </nav>
</header>
