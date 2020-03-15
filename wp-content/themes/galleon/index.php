<?php get_header(); ?>
<?php get_sidebar(); ?>
    <div class="page-content" style="
    background-image: url(https://picsum.photos/1985);">
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
        <div class="exerpt">
            this is blue box down right
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
