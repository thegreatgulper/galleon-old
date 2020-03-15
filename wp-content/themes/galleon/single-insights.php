<?php
/*
Template Name: Insights
*/
get_header();
get_sidebar();



$args = array(
    'post_type'   => 'marketing_insights',
    'post_status' => 'publish',
    'posts_per_page' => 6,
    'paged' => 1,
);
$obj = get_post_type_object( 'marketing_insights' );

$marketing_insights = new WP_Query( $args );
$count_posts = wp_count_posts( 'marketing_insights' )->publish;
$page_id = get_queried_object_id();
if ( has_post_thumbnail( $page_id ) ) :
    $image_array = wp_get_attachment_image_src( get_post_thumbnail_id( $page_id ), 'optional-size' );
    $image = $image_array[0];
else :
    $image = get_template_directory_uri() . '/images/default-background.jpg';
endif;
//var_dump($case_study);

?>
    <div class="page-content">
        <?php while ( have_posts() ): the_post(); ?>
            <section <?php post_class(); ?>>

                <div class="post-wrapper group">

                    <header class="entry-header group">

                        <div class="newsletter-popup"><button id="subscribe_trigger">Subscribe</button></div>

                        <h1 class="entry-title"><?php the_title(); ?></h1>
                    </header>
                </div>

            </section><!--/.post-->

        <?php endwhile; ?>

        <!--this is where loop for custom posts starts-->
        <div class="insights-wrapper">
            <?php

            if ( $marketing_insights->have_posts() ) :
                while ( $marketing_insights->have_posts() ) : $marketing_insights->the_post(); ?>
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
                            <h2><?php echo get_the_title(); ?></h2>
                            <?php echo get_the_content(); ?>
                        </div>

                    </div>
                <?php endwhile;

            endif;
            wp_reset_postdata();
            ?>

        </div>
        <?php if($count_posts > 6) { ?>
            <div class="loadmore"><button>Load more insights</button></div>
        <?php } ?>

        <!--this is where loop for custom posts ends-->
    </div><!--    page-content-->


    <div class="f-mobile">
        <?php get_footer('mobile'); ?>
    </div>
    <div id="bg">
        <img src="<?php echo $image ?>" alt="">
    </div>    <script type="text/javascript">
	var ajaxurl = "<?php echo admin_url( 'admin-ajax.php' ); ?>";
	var page = 2;
	jQuery(function($) {
		$('body').on('click', '.loadmore', function() {
			var data = {
				'action': 'load_posts_by_ajax',
				'page': page,
				'security': '<?php echo wp_create_nonce("load_more_posts"); ?>'
			};

			$.post(ajaxurl, data, function(response) {
				if(response != '') {
					$('.insights-wrapper').append(response);
					page++;
				} else {
					$('.loadmore').hide();
				}
			});
		});
	});
</script>
<div class="overlay hidden signup">
    <div class="wrapper">
        <div class="site-nav__toggle">
            <button class="btn--menu" data-toggle=".menu" data-swap="close">
                <span class="icon-close"></span>
            </button>
        </div>
        <section><?php echo do_shortcode("[ninja_form id=8]"); ?></section>
    </div>

</div>

<?php get_footer('global') ?>