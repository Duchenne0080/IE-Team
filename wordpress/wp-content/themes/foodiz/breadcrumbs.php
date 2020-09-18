<!-- breadcrumbs -->
<nav class="breadcrumb_back" aria-label="breadcrumb" style="background:url( <?php if ( get_theme_mod( 'foodiz_inner_image' ) ) {
		     echo esc_url( get_theme_mod( 'foodiz_inner_image' ) );
	     } else {
		     echo esc_url( get_template_directory_uri() ) . "/images/callout.jpg";
	     } ?>);">
    <?php if ( have_posts() ) { ?>
    <ol class="breadcrumb d-flex justify-content-center breadCrumbBkground">
        <li class="breadcrumb-item">
            <a href="<?php echo esc_url( home_url() ); ?>"><?php esc_html_e( 'Home', 'foodiz' ); ?></a>
        </li>

        <?php if ( is_page() || is_single() ) { ?>
        <li class="breadcrumb-item " aria-current="page"><?php the_title(); ?></li> <?php } ?>

        <?php if ( is_category() || is_tag() ) { ?>
        <li class="breadcrumb-item " aria-current="page"><?php single_cat_title(); ?></li>
        <?php } ?>

        <?php if ( is_archive() ) {
        if ( is_day() ) : ?>
        <li class="breadcrumb-item " aria-current="page">
		<?php    /* translators: %s: date. */
            printf( esc_html__( 'Daily Archives: %s', 'foodiz' ), '<span>' . get_the_date() . '</span>' ); ?>    
        </li>
        <?php elseif ( is_month() ) :?>
        <li class="breadcrumb-item " aria-current="page">
        <?php    /* translators: %s: month. */
            printf( esc_html__( 'Monthly Archives / %s', 'foodiz' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'foodiz' ) ) . '</span>' ); ?>    
        </li>
        <?php elseif ( is_year() ) :?>
        <li class="breadcrumb-item " aria-current="page">
            <?php    /* translators: %s: year. */
                printf( esc_html__( 'Yearly Archives: %s', 'foodiz' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'foodiz' ) ) . '</span>' ); ?>
        </li>
        <?php endif; } ?>

        <?php if ( is_search() ) { ?>
        <li class="breadcrumb-item " aria-current="page">
            <?php
                /* translators: %s: search term. */
                printf( esc_html__( 'Search Results for: %s', 'foodiz' ), '<span>' . get_search_query() . '</span>' ); ?>
        </li>
        <?php } ?>

        <?php if ( is_author() ) { ?>
            <li class="breadcrumb-item active" aria-current="page"><?php echo get_the_author(); ?></li>
        <?php } ?>

    </ol>
    <?php } elseif ( is_404() ) { ?>

    <ol class="breadcrumb d-flex justify-content-center breadCrumbBkground">
        <li class="breadcrumb-item">
            <a href="<?php echo esc_url( home_url() ); ?>"><?php esc_html_e( 'Home', 'foodiz' ); ?></a>
        </li>

        <li class="breadcrumb-item"><?php esc_html_e( '404 Error', 'foodiz' ); ?></li>
    </ol>
    <?php } ?>
</nav>