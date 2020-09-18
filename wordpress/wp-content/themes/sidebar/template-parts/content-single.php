<?php
/**
 * Template part for displaying single posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package sidebar
 */

?>

                                <div class="entry-content">
                                <?php 
								the_content(); 
								wp_link_pages( array(
									'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'sidebar' ),
									'after'  => '</div>',
								) );
								
								?>
                                </div>
								<?php the_tags(); ?>		                                
