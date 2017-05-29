<?php while (have_posts()) : the_post(); ?>
  <?php if(is_main_site()) : ?>
    <?php 
      $sites = query_posts(array(
        'post_type' => 'sites',
        'showposts' => -1
      ));
    ?>

    <?php if (have_posts()) : ?>
      <ul style="display: none;">
        <?php while (have_posts()) : the_post(); ?>
          <li>
            <a href="<?php the_field('link'); ?>">
              <img
                src="<?php echo get_field('picture')['url']; ?>"
                alt="<?php the_title(); ?>"
                width="<?php echo get_field('picture')['width']; ?>"
                height="<?php echo get_field('picture')['height']; ?>"
                style="display: block; width: 100px; height: auto;">
              <strong><?php the_field('number'); ?> - <?php the_field('candidates'); ?></strong>
              <br>
              <small><?php the_title(); ?></small>
              <br>
              <small><u><?php the_field('link'); ?></u></small>
            </a>
          </li>
        <?php endwhile; ?>
      </ul>
    <?php endif; ?>

    <?php wp_reset_query(); ?>

    <?php the_content() ?>

  <?php else : ?>

    <?php get_template_part('templates/page', 'header'); ?>
    <?php get_template_part('templates/content', 'page'); ?>

  <?php endif; ?>
<?php endwhile; ?>
