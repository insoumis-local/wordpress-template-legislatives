<span class="text-muted">
<time class="updated" datetime="<?php echo get_post_time('c', true); ?>"><?php echo get_the_date(); ?></time>
dans
<?php
  $categories = get_the_category();

  foreach ($categories as $key => $category) {
?>
<a href="<?php echo get_category_link($category->cat_ID) ?>">
  <?php echo $category->name; ?>
</a><?php echo $key < count($categories) - 1 ? ', ': '' ?>
<?php } ?>
</span>
<p class="entry-tags text-muted">
  <?php the_tags(); ?>
</p>
