<?php get_header();
echo do_shortcode( '[show_top_section]' );
?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<?php the_content(); ?>
   

<?php endwhile; endif; ?>
<?php get_footer();