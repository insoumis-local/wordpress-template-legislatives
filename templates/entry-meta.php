<p class="text-muted entry-meta">
  <time class="updated" datetime="<?php echo get_post_time('c', true); ?>"><?php echo get_the_date(); ?></time>
  <?php
    $categories = get_the_category();

    foreach ($categories as $key => $category) {
      if($category->cat_ID != 1) {
  ?>
  <a href="<?php echo get_category_link($category->cat_ID) ?>">
    <?php echo $category->name; ?>
  </a>
  <?php } } ?>
</p>
