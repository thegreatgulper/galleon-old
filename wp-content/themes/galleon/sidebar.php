<div class="logo-nav">
    <div class="ln">
        <div class="site-logo">
            <?php //echo get_custom_logo(); ?>
            <a href="/"><img src="<?php echo get_template_directory_uri(); ?>/img/Galleon_Logo.svg"></a>
        </div>
        <div class="site-nav">
            <div class="site-nav__toggle">
                <button class="btn--menu" data-toggle=".menu" data-swap="close">
                    <span class="icon-hamburger"></span>
                    <span class="icon-close hidden"></span>
                </button>
            </div>
        <?php
            wp_nav_menu( array(
            'menu' => 'main-menu',
            'menu_class' => '',
            'container' => 'div',
            'container_class' => 'menu',
            'theme_location' => 'test-menu',
            'menu_id' => 'foo'
            ) );
        ?>
        </div>
    </div>

    <div class="f-desktop">
        <?php get_footer('desktop'); ?>
    </div>
</div><!--/.logo-nav-->
	
