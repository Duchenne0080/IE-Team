<?php
/**
 * Template for displaying search form.
 *
 */ ?>

<?php $unique_id = esc_attr( uniqid( 'search-form-' ) ); ?>

<form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label for="<?php echo $unique_id; ?>">
        <span class="screen-reader-text"><?php _e( 'Search for:', 'rinzai' ); ?></span>
    </label>
    <div class="uk-margin">
        <div class="uk-inline">
            <span class="uk-form-icon uk-form-icon-flip" data-uk-icon="icon: search"></span>
            <input type="search" id="<?php echo $unique_id; ?>" class="uk-input" placeholder="<?php esc_attr_e( 'Search&hellip;', 'rinzai' ); ?>" value="<?php echo get_search_query(); ?>" name="s">
        </div>
    </div>
</form>
