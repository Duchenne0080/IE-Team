<?php
/**
 * Loop file for banner slider.
 *
 * @package business-class
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


$panel_name   = 'front_page';
$section_name = 'banner_slider';

$align_contents = business_class_get_theme_mod( $panel_name, $section_name, 'align_contents' );

$category = get_the_category();
$cat_name = ! empty( $category[0]->name ) ? $category[0]->name : '';

?>

<article <?php post_class( 'first' ); ?> id="banner-slider-<?php the_ID(); ?>">

	<div class="caption">

		<div class="slider-caption <?php echo esc_attr( $align_contents ); ?>">

			<?php
			if ( ! empty( $cat_name ) ) {
				echo wp_kses_post( "<h4>{$cat_name}</h4>" );
			}

			the_title(
				'<h3><a href="' . esc_url( get_the_permalink() ) . '">',
				'</a></h3>'
			);

			the_excerpt();
			?>

			<div class="slider-buttons">
				<a class="custom-button  button-medium" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read More', 'business-class' ); ?></a>
			</div><!-- .slider-buttons -->

		</div><!-- .slider-caption -->

	</div><!-- .caption -->

	<?php if ( has_post_thumbnail() ) { ?>
		<a href="<?php the_permalink(); ?>">
			<?php the_post_thumbnail( 'large' ); ?>
		</a>
	<?php } ?>

</article>

