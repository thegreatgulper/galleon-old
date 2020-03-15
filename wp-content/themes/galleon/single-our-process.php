<?php
/*
Template Name: OurProcess
*/
 get_header();
get_sidebar();

if( class_exists('Dynamic_Featured_Image') ) {
    global $dynamic_featured_image;
    $featured_images = $dynamic_featured_image->get_featured_images( $postId );

    //You can now loop through the image to display them as required
    $page_id = get_queried_object_id();
    if ( has_post_thumbnail( $page_id ) ) :
        $image_array = wp_get_attachment_image_src( get_post_thumbnail_id( $page_id ), 'optional-size' );
        $image = $image_array[0];
    else :
        $image = get_template_directory_uri() . '/images/default-background.jpg';
    endif;
    //var_dump($image_array);
}

$args = array(
    'post_type'   => 'testimonials',
    'post_status' => 'publish',
    'orderby' => 'rand'
);

$testimonials = new WP_Query( $args );
//var_dump($testimonials)

?>
    <!-- <div class="page-content" style="background: url(<?php echo $image ?>) no-repeat;"> -->
    <div class="page-content">
        <?php while ( have_posts() ): the_post(); ?>
            <div class="slide-in">

                <article <?php post_class(); ?>>

                    <div class="post-wrapper group">

                        <header class="entry-header group" style="background-image: url(<?php echo $image ?>);">
                            <div class="h_wrapper">
                                <h1 class="entry-title"><?php the_title(); ?></h1>
                            </div>
                        </header>

                        <div class="entry-content">
                            <div class="entry themeform">
                                <?php the_content(); ?>
                                <div class="clear"></div>
                            </div><!--/.entry-->
                        </div>
                    </div>

                </article><!--/.post-->


            </div>
            <section class="process">
                <?php

                if ( is_active_sidebar( 'our-process-widget' ) ) : ?>
                    <div id="opw-widget-area" class="opw-widget-area widget-area" role="complementary">
                        <?php dynamic_sidebar( 'our-process-widget' ); ?>
                    </div>

                <?php endif; ?>
            </section>
        <?php endwhile; ?>
    </div><!--/.content-->


    <div class="f-mobile">
        <?php get_footer('mobile'); ?>
    </div>
    <div id="bg">
        <img src="<?php echo $image ?>" alt="">
    </div>
<?php get_footer('global') ?>