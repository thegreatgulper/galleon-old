<?php get_header(); ?>
<?php get_sidebar(); ?>
<?php
if( class_exists('Dynamic_Featured_Image') ) {
    global $dynamic_featured_image;
    $featured_images = $dynamic_featured_image->get_featured_images( $postId );

    //You can now loop through the image to display them as required
    //var_dump(count($featured_images));
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
                            <h1 class="entry-title"><?php the_title(); ?></h1>
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
            <div class="exerpt-testimonials">
                <?php if( $testimonials->have_posts() ) : ?>
                    <ul>
                        <?php
                        while( $testimonials->have_posts() ) :
                            $testimonials->the_post();
                            ?>
                            <li><?php printf(  get_the_content() );  ?><br/><strong><?php printf(  get_the_title() ) ?></strong></li>
                        <?php endwhile; wp_reset_postdata();?>
                    </ul>
                <?php  endif; ?>
            </div>
        <?php endwhile; ?>
    </div><!--/.content-->


    <div class="f-mobile">
        <?php get_footer('mobile'); ?>
    </div>
    <div id="bg">
        <img src="<?php echo $image ?>" alt="">
    </div>
<?php get_footer('global') ?>