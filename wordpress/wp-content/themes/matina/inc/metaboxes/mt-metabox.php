<?php
/**
 * Add custom metabox for post/page.
 *
 * @package Matina
 */


// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

require get_template_directory() . '/inc/metaboxes/mt-metabox-helper.php';

add_action( 'add_meta_boxes', 'matina_metaboxes', 10, 2 );

if ( ! function_exists( 'matina_metaboxes' ) ) :

    /**
     * register required metabox
     *
     * @since 1.0.0
     */
    function matina_metaboxes() {
    
        add_meta_box(
            'matina_post_sidebar',
            __( 'Post Meta Settings', 'matina' ),
            'matina_sidebar_meta_callback',
            'post',
            'normal',
            'default'
        );
        
    }

endif;

/*-------------------------------------------------------------------------------*/

if ( ! function_exists( 'matina_sidebar_meta_callback' ) ) :

    /**
     * add required fields.
     *
     * @since 1.0.0
     */
    function matina_sidebar_meta_callback( $post ) {

        //global $post;

        // sidebar option
        $post_sidebar_option = matina_post_meta_sidebar_option();

        // layout option
        $post_layout_option = matina_post_meta_layout_option();

        // value set for meta tab.
        $get_post_meta_identity = get_post_meta( $post->ID, 'post_meta_identity', true );
        $post_identity_value    = empty( $get_post_meta_identity ) ? 'mt-metabox-info' : $get_post_meta_identity;

        // value set for post sidebar.
        $post_sidebar = get_post_meta( $post->ID, 'post_sidebar', true );
        $post_sidebar = ( $post_sidebar ) ? $post_sidebar : 'default-sidebar';

        // value set for post layout.
        $post_layout = get_post_meta( $post->ID, 'post_layout', true );
        $post_layout = ( $post_layout ) ? $post_layout : 'default-layout';

        // Create our nonce field.
        wp_nonce_field( basename( __FILE__ ) , 'matina_post_meta_nonce' );
?>
        <div class="mt-meta-container mt-clearfix">

            <ul class="mt-meta-menu-wrapper">
                <li class="mt-meta-tab <?php if ( $post_identity_value == 'mt-metabox-info' ) { echo 'active'; } ?>" data-tab="mt-metabox-info"><span class="dashicons dashicons-info"></span><?php esc_html_e( 'Information', 'matina' ); ?></li>
                <li class="mt-meta-tab <?php if ( $post_identity_value == 'mt-metabox-sidebar' ) { echo 'active'; } ?>" data-tab="mt-metabox-sidebar"><span class="dashicons dashicons-exerpt-view"></span><?php esc_html_e( 'Sidebars', 'matina' ); ?></li>
                <li class="mt-meta-tab <?php if ( $post_identity_value == 'mt-metabox-layout' ) { echo 'active'; } ?>" data-tab="mt-metabox-layout"><span class="dashicons dashicons-layout"></span><?php esc_html_e( 'Layouts', 'matina' ); ?></li>
            </ul>

            <div class="mt-metabox-content-wrapper">

                <!-- Info tab content -->
                <div class="mt-single-meta <?php if ( $post_identity_value == 'mt-metabox-info' ) { echo 'active'; } ?>" id="mt-metabox-info">
                    <div class="content-header">
                        <h4><?php esc_html_e( 'About Metabox Options', 'matina' ) ;?></h4>
                    </div><!-- .content-header -->
                    <div class="meta-options-wrap"><?php esc_html_e( 'In this section we have lots of features which make your post unique and completely different.', 'matina' ); ?></div><!-- .meta-options-wrap  -->
                </div><!-- #mt-metabox-info -->

                <!-- Sidebar tab content -->
                <div class="mt-single-meta" id="mt-metabox-sidebar">
                    <div class="content-header">
                        <h4><?php esc_html_e( 'Available Sidebars', 'matina' ) ;?></h4>
                        <span class="section-desc"><em><?php esc_html_e( 'Select sidebar from available options which replaced sidebar layout from customizer settings.', 'matina' ); ?></em></span>
                    </div><!-- .content-header -->
                    <div class="mt-meta-options-wrap">
                        <div class="buttonset">
                            <?php foreach ( $post_sidebar_option as $field ) { ?>
                                    <input type="radio" id="<?php echo esc_attr( $field['id'] ); ?>" value="<?php echo esc_attr( $field['value'] ); ?>" name="post_sidebar" <?php checked( $field['value'], $post_sidebar ); ?> />
                                    <label for="<?php echo esc_attr( $field['id'] ); ?>">
                                        <span class="screen-reader-text"><?php echo esc_html( $field['label'] ); ?></span>
                                        <img src="<?php echo esc_url( $field['thumbnail'] ); ?>" title="<?php echo esc_attr( $field['label'] ); ?>" alt="<?php echo esc_attr( $field['label'] ); ?>" />
                                    </label>
                            <?php } ?>
                        </div><!-- .buttonset -->
                    </div><!-- .meta-options-wrap  -->
                </div><!-- #mt-metabox-sidebar -->

                <!-- Layouts tab content -->
                <div class="mt-single-meta" id="mt-metabox-layout">
                    <div class="content-header">
                        <h4><?php esc_html_e( 'Available Layouts', 'matina' ) ;?></h4>
                        <span class="section-desc"><em><?php esc_html_e( 'Select post layout from available options which replaced post layout from customizer settings.', 'matina' ); ?></em></span>
                    </div><!-- .content-header -->
                    <div class="mt-meta-options-wrap">
                        <div class="buttonset">
                            <?php foreach ( $post_layout_option as $field ) { ?>
                                    <input type="radio" id="<?php echo esc_attr( $field['id'] ); ?>" value="<?php echo esc_attr( $field['value'] ); ?>" name="post_layout" <?php checked( $field['value'], $post_layout ); ?> />
                                    <label for="<?php echo esc_attr( $field['id'] ); ?>">
                                        <span class="screen-reader-text"><?php echo esc_html( $field['label'] ); ?></span>
                                        <img src="<?php echo esc_url( $field['thumbnail'] ); ?>" title="<?php echo esc_attr( $field['label'] ); ?>" alt="<?php echo esc_attr( $field['label'] ); ?>" />
                                    </label>
                            <?php } ?>
                        </div><!-- .buttonset -->
                    </div><!-- .meta-options-wrap -->
                </div><!-- #mt-metabox-layout -->

            </div><!-- .mt--metabox-content-wrapper -->
            <input type="hidden" id="post-meta-selected" name="post_meta_identity" value="<?php echo esc_attr( $post_identity_value ); ?>" />
        </div><!-- .mt-meta-container -->
<?php
    }

endif;

if ( ! function_exists( 'matina_save_post_meta' ) ) :

    /**
     * save the post meta
     *
     * @since 1.0.0
     */
    function matina_save_post_meta( $post_id ) {

        // Verify the nonce before proceeding.
        $matina_post_meta_nonce   = isset( $_POST['matina_post_meta_nonce'] ) ? $_POST['matina_post_meta_nonce'] : '';
        $matina_post_meta_nonce_action = basename( __FILE__ );

        //* Check if nonce is set...
        if ( ! isset( $matina_post_meta_nonce ) ) {
            return;
        }

        //* Check if nonce is valid...
        if ( ! wp_verify_nonce( $matina_post_meta_nonce, $matina_post_meta_nonce_action ) ) {
            return;
        }

        //* Check if user has permissions to save data...
        if ( ! current_user_can( 'edit_page', $post_id ) ) {
            return;
        }

        // Check auto save
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        }

        //* Check if not a revision...
        if ( wp_is_post_revision( $post_id ) ) {
            return;
        }

        // Check value and save meta for post sidebar.
        if ( isset( $_POST['post_sidebar'] ) ) {
            
            // We validate making sure that the option is something we can expect.
            $value = in_array( $_POST['post_sidebar'], array( 'default-sidebar', 'left-sidebar', 'right-sidebar', 'no-sidebar', 'no-sidebar-center' ) ) ? $_POST['post_sidebar'] : 'default-sidebar';
            
            // We update our post meta.
            update_post_meta( $post_id, 'post_sidebar', $value );
        }

        // Check value and save meta for post layout.
        if ( isset( $_POST['post_layout'] ) ) {
            
            // We validate making sure that the option is something we can expect.
            $value = in_array( $_POST['post_layout'], array( 'default-layout', 'layout-default', 'layout-one' ) ) ? $_POST['post_layout'] : 'default-layout';
            
            // We update our post meta.
            update_post_meta( $post_id, 'post_layout', $value );
        }

        /**
         * save meta for post tab identity
         */
        $post_identity      = get_post_meta( $post_id, 'post_meta_identity', true );
        $stz_post_identity  = sanitize_text_field( $_POST[ 'post_meta_identity' ] );

        if ( $stz_post_identity && '' == $stz_post_identity ){
            add_post_meta( $post_id, 'post_meta_identity', $stz_post_identity );
        } elseif ( $stz_post_identity && $stz_post_identity != $post_identity ) {
            update_post_meta($post_id, 'post_meta_identity', $stz_post_identity );
        } elseif ( '' == $stz_post_identity && $post_identity ) {
            delete_post_meta( $post_id, 'post_meta_identity', $post_identity );
        }

    }

endif;

add_action( 'save_post', 'matina_save_post_meta' );