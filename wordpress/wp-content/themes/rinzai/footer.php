<?php
/**
 * Footer template file.
 */
?>
            </div> <!-- #site-content -->

            <footer id="site-footer" class="uk-section uk-section-small">

                <?php if ( is_active_sidebar( 'footer-1' ) ||
                           is_active_sidebar( 'footer-2' ) ||
                           is_active_sidebar( 'footer-3' ) ||
                           is_active_sidebar( 'footer-4' ) ) : ?>
                    <div class="uk-container">
                        <div class="uk-grid-large uk-margin-top uk-margin-medium-bottom" data-uk-grid>
                            <?php
                			/**
                			 * Functions hooked into rinzai_footer_sidebars action
                			 *
                			 * @hooked rinzai_footer_sidebar_one           - 0
                             * @hooked rinzai_footer_sidebar_two           - 10
                			 * @hooked rinzai_footer_sidebar_three         - 20
                             * @hooked rinzai_footer_sidebar_four          - 30
                			 */
                            do_action( 'rinzai_footer_sidebars' ); ?>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="uk-container">
                    <div class="uk-child-width-1-1 uk-child-width-expand@m uk-flex-middle uk-flex-center" data-uk-grid>
                        <?php
                        /*
                         * Functions hooked into rinzai_after_footer action.
                         *
                         * @hooked rinzai_print_footer_left_section()      - 0
                         * @hooked rinzai_print_footer_center_section()    - 10
                         * @hooked rinzai_print_footer_right_section()     - 20
                         */
                        do_action( 'rinzai_footer' ); ?>
                    </div>
                </div>

            </footer> <!-- #site-footer -->

            <?php
            /*
             * Functions hooked into rinzai_after_footer action.
             *
             * @hooked rinzai_print_offcanvas_nav()                        - 0
             * @hooked rinzai_print_search_modal()                         - 10
             */
            do_action( 'rinzai_after_footer' ); ?>

        </div> <!-- .uk-offcanvas-content -->

    </div><!-- #app -->
<?php wp_footer(); ?>
</body>
</html>
