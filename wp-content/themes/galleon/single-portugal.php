<?php
/*
Template Name: Portugal
*/
?>

<?php get_header(); ?>
<?php get_sidebar(); ?>
<?php
$imageArray = [];
$image;
$page_id = get_queried_object_id();
if ( has_post_thumbnail( $page_id ) ) :
    $image_array = wp_get_attachment_image_src( get_post_thumbnail_id( $page_id ), 'optional-size' );
    $image = $image_array[0];
    array_push( $imageArray, $image_array[0] );
endif;
if( class_exists('Dynamic_Featured_Image') ) {
    global $dynamic_featured_image;
    $featured_images = $dynamic_featured_image->get_featured_images( $postId );
    foreach ($featured_images as $image) {
        array_push( $imageArray, $image['full'] );
    }
$image = $image_array[0];
}


$args = array(
    'post_type'   => 'testimonials',
    'post_status' => 'publish',
    'orderby' => 'rand'
);

$testimonials = new WP_Query( $args );

?>
    <!--  <div class="page-content" style="background: url(<?php echo $image ?>) no-repeat;">-->
    <div class="page-content">
        <?php while ( have_posts() ): the_post(); ?>
            <div class="slide-in">

                <article <?php post_class(); ?>>

                    <div class="post-wrapper group">

                        <header class="entry-header group" style="background-image: url(<?php echo $imageArray[2] ?>);background-position: bottom;">
                            <div class="h_wrapper">
                                <h1 class="entry-title" style="width: 82%;"><?php the_title(); ?></h1>
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
            <div class="exerpt-wrapper">
                <div class="exerpt-testimonials">
                    <?php if( $testimonials->have_posts() ) : ?>
                        <?php
                        while( $testimonials->have_posts() ) :
                            $testimonials->the_post();
                            ?>
                            <div class="testimonial"><?php printf(  get_the_content() );  ?><br/><strong><?php printf(  get_the_title() ) ?></strong></div>
                        <?php endwhile; wp_reset_postdata();?>
                    <?php  endif; ?>
                </div>
            </div>

        <?php endwhile; ?>
    </div><!--/.content-->


    <div class="f-mobile">
        <?php get_footer('mobile'); ?>
    </div>
    <div id="bg" <?php if(count($imageArray) > 1) { ?>class="fadeBg" <?php } ?> >
        <?php
            foreach ($imageArray as $key => $value) {
                echo '<div><img src="'.$value.'" /></div>';
            }
        ?>
    </div>

<div class="overlay hidden signup">
    <div class="wrapper portugal">
        <div class="site-nav__toggle">
            <button class="btn--menu" data-toggle=".menu" data-swap="close">
                <span class="icon-close"></span>
            </button>
        </div>
        <section><?php echo do_shortcode("[ninja_form id=9]"); ?></section>
    </div>
</div>
<?php get_footer('global') ?>