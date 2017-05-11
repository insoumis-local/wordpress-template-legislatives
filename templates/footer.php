<footer class="content-info">
  <?php if (is_active_sidebar('sidebar-pre-footer') && !is_page_template('template-no-banner.php')): ?>
  <div class="container container-signup-footer hidden-print">
    <div class="row">
      <div class="col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3 col-sm-10 col-sm-offset-1 col-xs-12 card">
        <?php dynamic_sidebar('sidebar-pre-footer'); ?>
      </div>
    </div>
  </div>
  <?php endif; ?>
  <div class="container">
    <?php get_template_part('templates/social'); ?>
    <?php dynamic_sidebar('sidebar-footer'); ?>
  </div>
</footer>
