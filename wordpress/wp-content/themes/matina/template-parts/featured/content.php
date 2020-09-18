<?php
/**
 * Template for homepage featured section.
 *
 * @package Matina
 */

$section_class          = 'mt-front-featured-wrapper mt-clearfix';
$featured_cat_layout    = get_theme_mod( 'matina_featured_cat_layout', 'layout-default' );
$item_column            = apply_filters( 'matina_featured_item_column', 3 );

$section_class .= ' featured-categories--'.esc_attr( $featured_cat_layout );
$section_class .= ' column-'.$item_column;

$featured_categories = get_theme_mod( 'matina_featured_categories' );

if ( empty( $featured_categories ) ) {
    return;
}

?>

<div id="featured-section" class="<?php echo esc_attr( $section_class ); ?>">
    <div class="mt-container">
        <?php
            // section title
            get_template_part( 'template-parts/featured/title' );

            // categories featured
            get_template_part( 'template-parts/featured/categories' );
        ?>
    </div><!-- .mt-container -->
</div><!-- #featured-section -->