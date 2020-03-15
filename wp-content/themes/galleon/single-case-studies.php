<?php
/*
Template Name: CaseStudy
*/
get_header();
get_sidebar();

//You can now loop through the image to display them as required
//var_dump(count($featured_images));
$page_id = get_queried_object_id();
if ( has_post_thumbnail( $page_id ) ) :
    $image_array = wp_get_attachment_image_src( get_post_thumbnail_id( $page_id ), 'optional-size' );
    $imageBg = $image_array[0];
else :
    $image = get_template_directory_uri() . '/images/default-background.jpg';
endif;

$args = array(
    'post_type'   => 'case_study',
    'post_status' => 'publish',
);
$obj = get_post_type_object( 'case_study' );

$case_study = new WP_Query( $args );
//var_dump($case_study);

?>

    <div class="page-content">
<?php while ( have_posts() ): the_post(); ?>
        <section <?php post_class(); ?>>

            <div class="post-wrapper group">

                <header class="entry-header group">
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                </header>

                <div class="entry-content">
                    <p class="note">*Average per project</p>
                    <div class="entry themeform">
                        <?php the_content(); ?>
                        <div class="clear"></div>
                    </div><!--/.entry-->
                </div>
            </div>

        </section><!--/.post-->

<?php endwhile; ?>

        <!--this is where loop for custom posts starts-->
        <div class="case_study-wrapper">
            <?php

            if ( $case_study->have_posts() ) :
                while ( $case_study->have_posts() ) : $case_study->the_post(); ?>
                    <?php $case_page_id = get_queried_object_id(); ?>
                    <?php
                    $imageArray = [];
                    if( class_exists('Dynamic_Featured_Image') ) {
                        global $dynamic_featured_image;
                        $featured_images = $dynamic_featured_image->get_featured_images( get_the_ID() );
                        foreach ($featured_images as $image) {
                            array_push( $imageArray, $image['full'] );
                        }
                    }
                    if ( has_post_thumbnail( $page_id ) ) :
                        $image_array = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'optional-size' );
                        $image = $image_array[0];
                        array_push( $imageArray, $image_array[0] );
                    endif;
                    ?>
                    <div class="the_case">
<!--                        <div class="description">-->
                            <div class="details">
                                <h2><?php echo get_the_title(); ?></h2>
                                <?php echo get_the_content(); ?>
                            </div>


                            <div id="image-case-<?php echo get_the_ID(); ?>" class="image image-case" data-id="<?php echo get_the_ID(); ?>">
                                <?php if(count($imageArray) > 1) {
                                    foreach ($imageArray as $key => $value) {
                                        echo "<div><img src='".$value."' /></div>";

                                    };
                                } else {
                                    if ( has_post_thumbnail() ) {
                                        the_post_thumbnail();
                                    }
                                } ?>
                            </div>
<!--                        </div>-->
                    </div>

                <?php endwhile;

            endif;
            wp_reset_postdata();
            ?>
        </div>

        <!--this is where loop for custom posts ends-->

    </div><!--    page-content-->


    <div class="f-mobile">
        <?php get_footer('mobile'); ?>
    </div>
    <div id="bg">
        <img src="<?php echo $imageBg ?>" alt="">
    </div>

<?php get_footer('global') ?>