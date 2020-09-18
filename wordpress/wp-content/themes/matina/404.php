<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Matina
 */
get_header();

$page_caption 	= get_theme_mod( 'matina_404_page_caption', __( '404', 'matina' ) );
$page_title 	= get_theme_mod( 'matina_404_page_title', __( 'Oops! That page can&rsquo;t be found.', 'matina' ) );
$page_content 	= get_theme_mod( 'matina_404_page_content', __( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'matina' ) );
$search_option = get_theme_mod( 'matina_enable_404_search', true );
$button_label = get_theme_mod( 'matina_404_button_label', __( 'Back To Homepage', 'matina' ) );
$button_link = get_theme_mod( 'matina_404_button_link' );

?>
<div class="mt-container">

	<section class="error-404 not-found">
		<span class="page-caption"><?php echo wp_kses_post( $page_caption ); ?></span>
		<header class="page-header">
			<h1 class="page-title"><?php echo wp_kses_post( $page_title ); ?></h1>
		</header><!-- .page-header -->

		<div class="page-content">
			<p><?php echo wp_kses_post( $page_content ); ?></p>

			<?php
				if ( true === $search_option ) {
					get_search_form();
				}

				if ( ! empty( $button_label ) ) {
					echo '<a class="mt-button 404-button" href="'. esc_url( $button_link ) .'">'. esc_html( $button_label ) .'</a>';
				}
			?>

		</div><!-- .page-content -->
	</section><!-- .error-404 -->
	
</div><!-- .mt-container -->
<?php

get_footer();
