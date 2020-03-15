<?php
/*
Template Name: Simple
Template Post Type:post, page, marketing_insights
*/
get_header();
get_sidebar();
$page_id = get_queried_object_id();
$args = array(
    'post_type'   => 'marketing_insights',
    'post_status' => 'publish',
    'showposts' => '3',
    'post__not_in' => array( $page_id )
);
$marketing_insights = new WP_Query( $args );
$imageArray = [];

if( class_exists('Dynamic_Featured_Image') ) {
    global $dynamic_featured_image;
    $featured_images = $dynamic_featured_image->get_featured_images( $postId );
    foreach ($featured_images as $image) {
        array_push( $imageArray, $image['full'] );
    }
}
if ( has_post_thumbnail( $page_id ) ) :
    $image_array = wp_get_attachment_image_src( get_post_thumbnail_id( $page_id ), 'optional-size' );
    $image = $image_array[0];
    array_push( $imageArray, $image_array[0] );
endif;
$image =  $imageArray[array_rand($imageArray)];

?>
    <div class="page-content">
        <?php while ( have_posts() ): the_post(); ?>

            <section <?php post_class(); ?>>

                <div class="post-wrapper group">

                    <header class="entry-header group">
                        <h1 class="entry-title"><?php the_title(); ?></h1>
                    </header>
                    <div class="image">
                        <?php if(count($imageArray) <= 1) { ?>
                            <?php if ( has_post_thumbnail() ) { ?>

                                <?php the_post_thumbnail(); ?>

                            <?php } ?>
                        <?php } else { ?>

                        <!--carousel -  test-->
                        <div class="flex-container">
                            <div class="flexslider">
                                <ul class="slides">
                                    <?php
                                        foreach ($imageArray as $key => $value) {
                                            //echo "{$key} => {$value} ";
                                            echo '<li><img src="'.$value.'" />';
                                        }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <!--carousel -  test ends-->

                        <?php } ?>
                    </div>

                    <div class="entry-content-simple">
                        <div class="entry themeform">
                            <?php the_content(); ?>
                            <div class="clear"></div>
                        </div><!--/.entry-->
                    </div>
                </div>

            </section><!--/.post-->

        <?php endwhile; ?>

        <div class="other-posts">
            <h2 class="other-posts-title">PROPERTY INSIGHTS</h2>
            <?php
            $current_id = get_the_ID();

            if ( $marketing_insights->have_posts() ) :
                while ( $marketing_insights->have_posts() ) : $marketing_insights->the_post();
                    if( $current_id !== get_the_ID()) { ?>
                    <div class="the_item">
                        <?php  ?>
                        <div class="image">
                            <?php if ( has_post_thumbnail() ) { ?>
                                <a href="<?php echo get_permalink() ?>">
                                    <?php the_post_thumbnail(); ?>
                                </a>
                            <?php } ?>
                        </div>
                        <div class="description">
                            <h2><a href="<?php echo get_permalink() ?>"><?php echo get_the_title(); ?></a></h2>
                        </div>

                    </div>
            <?php
                    }

                 endwhile;

            endif;
            wp_reset_postdata();
            ?>
        </div>

    </div><!--    page-content-->


    <div class="f-mobile">
        <?php get_footer('mobile'); ?>
    </div>

<?php get_footer('global') ?>