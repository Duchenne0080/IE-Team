<div id="offcanvas" data-uk-offcanvas="overlay: true">
    <div class="uk-offcanvas-bar">
        <div class="uk-padding-small">
            <button class="uk-offcanvas-close uk-padding-small" type="button" data-uk-close></button>

            <?php if ( has_nav_menu( 'main' ) ) : ?>
                <p class="uk-text-bold uk-text-small uk-text-uppercase uk-margin-remove-top">
                    <?php _e( 'Menu', 'rinzai' ); ?>
                </p>
                <?php wp_nav_menu( array(
                    'theme_location'    => 'main',
                    'container'         => false,
                    'menu_class'        => 'uk-nav uk-nav-default uk-nav-parent-icon',
                    'walker'            => new Rinzai_Offcanvas_Nav_Walker(),
                ) ); ?>
            <?php endif; ?>

            <?php if ( has_nav_menu( 'social' ) ) : ?>
                <p class="uk-text-bold uk-text-small uk-text-uppercase uk-margin-medium-top">
                    <?php _e( 'Follow us', 'rinzai' ); ?>
                </p>
                <?php wp_nav_menu( array(
                    'theme_location'    => 'social',
                    'container'         => false,
                    'menu_class'        => 'uk-nav uk-nav-default',
                    'walker'            => new Rinzai_Offcanvas_Nav_Walker(),
                ) ); ?>
            <?php endif; ?>
        </div>
    </div>
</div>
