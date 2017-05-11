<div class="row social text-center bottom-margin top-margin">
  <?php if (($url = get_theme_mod('twitter')) && $url != 'https://twitter.com/'): ?>
    <a href=<?php echo $url; ?> title="Twitter" class="no_icon"><i class="fa fa-twitter fa-3x"></i></a>
  <?php endif; ?>
  <?php if (($url = get_theme_mod('facebook')) && $url != 'https://facebook.com/'): ?>
    <a href="<?php echo $url; ?>" title="Facebook" class="no_icon"><i class="fa fa-facebook fa-3x"></i></a>
  <?php endif; ?>
  <?php if (($url = get_theme_mod('youtube')) && $url != 'https://youtube.com/'): ?>
    <a href="<?php echo $url; ?>" title="Youtube" class="no_icon"><i class="fa fa-youtube-play fa-3x"></i></a>
  <?php endif; ?>
</div>
