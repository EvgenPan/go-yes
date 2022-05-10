<?php
/*
*   Template Name: Template Products
*/
get_header();
$id = get_the_ID();
$title = get_field('the_title_top-prod', $id) ?: '';
$subtitle = get_field('the_subtitle_top-prod', $id) ?: '';
$background_image = get_field('background_image-prod', $id) ?: '';
$link_btn = get_field('link_btn_top-prod', $id) ?: '';
$text_btn = get_field('button_text_top-prod', $id) ?: '';

$f_btn_text = get_field('first_button_text', $id) ?: '';/*FIRST BUTTON (LEFT SIDE) */
$f_btn_link = get_field('first_button_link', $id) ?: '';

$s_btn_text = get_field('second_button_text', $id) ?: ''; /*SECOND BUTTON (LEFT SIDE) */
$s_btn_link = get_field('second_button_link', $id) ?: '';
?>
<section class="block_hero block_hero_inner">
    <div class="container-top">
        <div class="top_section_inner" style="background-image: url(<?= $background_image ?>)">
            <div class="container">
                <div class="row row_wrapper">
                    <div class="col-lg-5 col_left_side">
                        <?php if($title) {?>
                            <div class="wrapper_content p68">
                                <span class="top_lable">Product</span>
                                <h1 class="h2"> <?= $title ?></h1>
                                <?php if ($subtitle) { ?>
                                    <p class="subtitle"><?= $subtitle ?></p>
                                <?php } ?>
                                <?php if ($link_btn && $text_btn) { ?>
                                    <div class="pt42">
                                        <a class="btn_main btn_orange" href="<?php echo $link_btn; ?>"><?= $text_btn ?></a>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="col-lg-7 col_right_side">
                        <div class="wrapper_left-side wrapper_btn">
                            <?php if ($f_btn_text && $f_btn_link) { ?>
                                <div class="mb16">
                                    <a class="btn_main btn_grey" href="<?php echo $f_btn_link; ?>"><?= $f_btn_text ?></a>
                                </div>
                            <?php } ?>
                            <?php if ($s_btn_text && $s_btn_link) { ?>
                                <div>
                                    <a class="btn_main btn_grey" href="<?php echo $s_btn_link; ?>"><?= $s_btn_text ?></a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <?php the_content(); ?>


<?php endwhile; endif; ?>

<?php get_footer("1"); ?>
