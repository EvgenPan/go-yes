<?php

get_header();

?>


        <div class="container single_press_top_content">
           <h1 class="h3"><?php the_title(); ?></h1>
            <h5 class="press_item_date"><?php echo get_the_date(); ?></h5>
            <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
        </div>
    <div class="container single_press_content">
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <?php the_content();?>

                <?php endwhile; endif; ?>

    </div>

<?php get_footer();