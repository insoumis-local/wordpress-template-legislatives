<?php
/**
 * Template Name: Couverture
 */
?>

<?php use Roots\Sage\Titles; ?>
<?php while (have_posts()) : the_post(); ?>

    <div class="fi-cover has-picture">
        <div class="picture" style="background-image: url('<?php echo has_post_thumbnail() ? get_the_post_thumbnail_url() : get_header_image(); ?>');"></div>
        <div class="data">
            <div class="wrapper">
                <?php
                $title = Titles\title();
                $split = strpos($title, ' &');
                ?>
                <h1 class="candidates">
                  <strong><?php echo substr($title, 0, $split !== FALSE ? $split : 99999); ?></strong>
                  <?php if ($split !== FALSE): ?>
                    <span><?php echo substr($title, $split); ?></span>
                  <?php endif; ?>
                </h1>
                <?php the_content(); ?>
                <button class="scrolldown"><span>En savoir plus</span></button>
            </div>
        </div>
    </div>

<?php endwhile; ?>
