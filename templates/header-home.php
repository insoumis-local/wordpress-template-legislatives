<?php if (!empty(get_theme_mod('candidate1'))): ?>
<div class="fi-cover">
  <div class="picture"></div>
  <div class="data">
    <div class="wrapper">
      <h1 class="candidates">
        <strong><?php echo get_theme_mod('candidate1'); ?></strong>
        <?php if (!empty(get_theme_mod('candidate2'))): ?>
        <span class="successor">& <?php echo get_theme_mod('candidate2'); ?></span>
        <?php endif; ?>
      </h1>
      <div class="logo">
        <div class="title">La France Insoumise</div>
        <div class="subtitle">avec Jean-Luc Mélenchon</div>
      </div>
      <div class="cities">
        <?php echo nl2br(get_theme_mod('cities')); ?>
      </div>
      <div class="district">
        <?php echo get_theme_mod('district'); ?>
      </div>
      <div class="election">Élections législatives 2017</div>
      <button class="scrolldown"><span>Suite</span></button>
    </div>
  </div>
</div>
<?php else: ?>
<!-- The home banner won't show until you define at least the candidate. -->
<?php endif; ?>
