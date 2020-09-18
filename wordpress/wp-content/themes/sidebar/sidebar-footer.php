<?php
/**
 * The sidebar containing the footer widget area
 *
 * If no active widgets in this sidebar, hide it completely.
 *
 * @package sidebar
 */

 if ( ! is_active_sidebar( 'footer-1' ) && ! is_active_sidebar( 'footer-2' ) && ! is_active_sidebar( 'footer-3' ) ) {
 	return;
 }
?>
				<div class="widget-area">
                    <div class="container">
                        <div class="row">

                                <div class="col-md-4 col-sm-6">
									<?php dynamic_sidebar( 'footer-1' ); ?>                                
								</div>

                                <div class="col-md-4 col-sm-6">
									<?php dynamic_sidebar( 'footer-2' ); ?>                                                                
                                </div>
                                
                                <div class="col-md-4 col-sm-12">
									<?php dynamic_sidebar( 'footer-3' ); ?>                                                                
                                </div>
                                
                        </div>
                    </div>
                </div>

