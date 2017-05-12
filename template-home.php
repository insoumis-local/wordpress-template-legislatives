<?php
/**
 * Template Name: Accueil
 */
?>

<?php use Roots\Sage\Titles; ?>
<?php while (have_posts()) : the_post(); ?>

    <div class="fi-cover">
        <div class="picture" style="background-image: url('<?php echo has_post_thumbnail() ? get_the_post_thumbnail_url() : get_header_image(); ?>');"></div>
        <div class="data">
            <div class="wrapper">
                <h1 class="candidates"><?php echo Titles\title(); ?></h1>
                <?php the_content(); ?>
                <button class="scrolldown"><span>En savoir plus</span></button>
            </div>
        </div>
    </div>

<?php endwhile; ?>
