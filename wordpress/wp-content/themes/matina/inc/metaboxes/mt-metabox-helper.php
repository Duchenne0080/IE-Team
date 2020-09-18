<?php
/**
 * helper file to handle all functions and hooks related to metabox
 *
 * @package Matina
 */

if ( ! function_exists( 'matina_post_meta_sidebar_option' ) ) :

    /**
     * function to return options of single post sidebar.
     *
     * @since 1.0.0
     */
    function matina_post_meta_sidebar_option() {
        $post_sidebar_option = apply_filters( 'matina_post_meta_sidebar_option',
            array(
                'default-sidebar' => array(
                    'id'        => 'post-default-sidebar',
                    'value'     => 'default-sidebar',
                    'label'     => __( 'Default Sidebar', 'matina' ),
                    'thumbnail' => get_template_directory_uri() . '/inc/metaboxes/assets/images/default-sidebar.png'
                ),
                'left-sidebar' => array(
                    'id'        => 'post-right-sidebar',
                    'value'     => 'left-sidebar',
                    'label'     => __( 'Left sidebar', 'matina' ),
                    'thumbnail' => get_template_directory_uri() . '/inc/metaboxes/assets/images/left-sidebar.png'
                ),
                'right-sidebar' => array(
                    'id'        => 'post-left-sidebar',
                    'value'     => 'right-sidebar',
                    'label'     => __( 'Right sidebar', 'matina' ),
                    'thumbnail' => get_template_directory_uri() . '/inc/metaboxes/assets/images/right-sidebar.png'
                ),
                'no-sidebar'    => array(
                    'id'        => 'post-no-sidebar',
                    'value'     => 'no-sidebar',
                    'label'     => __( 'No sidebar Full width', 'matina' ),
                    'thumbnail' => get_template_directory_uri() . '/inc/metaboxes/assets/images/no-sidebar.png'
                ),
                'no-sidebar-center' => array(
                    'id'        => 'post-no-sidebar-center',
                    'value'     => 'no-sidebar-center',
                    'label'     => __( 'No sidebar Content Centered', 'matina' ),
                    'thumbnail' => get_template_directory_uri() . '/inc/metaboxes/assets/images/no-sidebar-center.png'
                )
            )
        );

        return $post_sidebar_option;
    }

endif;

if ( ! function_exists( 'matina_post_meta_layout_option' ) ) :

    /**
     * function to return options of single post layout.
     *
     * @since 1.0.0
     */
    function matina_post_meta_layout_option() {
        $post_layout_option = apply_filters( 'matina_post_meta_layout_option',
            array(
                'default-layout' => array(
                    'id'        => 'post-default-layout',
                    'value'     => 'default-layout',
                    'label'     => __( 'Default Layout', 'matina' ),
                    'thumbnail' => get_template_directory_uri() . '/inc/metaboxes/assets/images/default-layout.png'
                ),
                'layout-default' => array(
                    'id'        => 'post-layout-default',
                    'value'     => 'layout-default',
                    'label'     => __( 'Layout Default', 'matina' ),
                    'thumbnail' => get_template_directory_uri() . '/inc/metaboxes/assets/images/single-post-layout-default.png'
                ),
                'layout-one' => array(
                    'id'        => 'post-layout-one',
                    'value'     => 'layout-one',
                    'label'     => __( 'Layout One', 'matina' ),
                    'thumbnail' => get_template_directory_uri() . '/inc/metaboxes/assets/images/single-post-layout-one.png'
                )
            )
        );

        return $post_layout_option;
    }

endif;

if ( ! function_exists( 'matina_post_meta_featured_image_option' ) ) :

    /**
     * function to return options of single post featured image option.
     *
     * @since 1.0.0
     */
    function matina_post_meta_featured_image_option() {
        $featured_image_option = apply_filters( 'matina_post_meta_featured_image_option',
            array(
                'default'   => __( 'Default option', 'matina' ),
                'specific'  => __( 'Specific option', 'matina' )
            )
        );

        return $featured_image_option;
    }

endif;

if ( ! function_exists( 'matina_post_meta_featured_image_option_field' ) ) :

    /**
     * function to manage the featured image option field according to post format.
     *
     * @since 1.0.0
     */
    function matina_post_meta_featured_image_option_field( $post_id ) {

        $post_format = get_post_format( $post_id );

        // featured image option
        $featured_image_option = matina_post_meta_featured_image_option();

        switch ( $post_format ) {
            case 'video':

            $matina_stored_meta = get_post_meta( $post_id );

            // value set for featured image option
            $featured_image_option_value = get_post_meta( $post_id, 'featured_image_option', true );
            $featured_image_option_value = ( $featured_image_option_value ) ? $featured_image_option_value : 'default';
        ?>
                <div class="mt-video-format-field-wrapper">
                    <!-- Select field for featured image option -->
                    <div class="mt-single-field mt-featured-option">
                        <label for="post-featured-image-option"><?php esc_html_e( 'Featured Image Option', 'matina' ); ?></label>
                        <select id="post-featured-image-option" name="featured_image_option" class="mt-meta-dropdown">
                            <?php foreach( $featured_image_option as $key => $value ) { ?>
                                <option value="<?php echo esc_attr( $key ); ?>" <?php selected( $featured_image_option_value, $key ); ?>><?php echo esc_html( $value ); ?></option>
                            <?php } ?>
                        </select>
                    </div><!-- .mt-featured-option -->
                    <div class="mt-single-field mt-image-checkbox-options mt-specific-options">
                        <label for="archive_video_featured_image_option">
                            <input type="checkbox" name="archive_video_featured_image_option" id="archive_video_featured_image_option" value="yes" <?php if ( isset ( $matina_stored_meta['archive_video_featured_image_option'] ) ) checked( $matina_stored_meta['archive_video_featured_image_option'][0], true ); ?> />
                            <?php esc_html_e( 'Replace featured image by video on archive.', 'matina' ); ?>
                        </label>
                        <label for="single_video_featured_image_option">
                            <input type="checkbox" name="single_video_featured_image_option" id="single_video_featured_image_option" value="yes" <?php if ( isset ( $matina_stored_meta['single_video_featured_image_option'] ) ) checked( $matina_stored_meta['single_video_featured_image_option'][0], true ); ?> />
                            <?php esc_html_e( 'Replace featured image by video on single.', 'matina' ); ?>
                        </label>
                    </div><!-- .mt-image-checkbox-options -->
                </div><!-- .mt-video-format-field-wrapper -->
        <?php
                break;

            case 'audio':
            $matina_stored_meta = get_post_meta( $post_id );

            // value set for featured image option
            $featured_image_option_value = get_post_meta( $post_id, 'featured_image_option', true );
            $featured_image_option_value = ( $featured_image_option_value ) ? $featured_image_option_value : 'default';
        ?>
                <div class="mt-audio-format-field-wrapper">
                    <!-- Select field for featured image option -->
                    <div class="mt-single-field mt-featured-option">
                        <label for="post-featured-image-option"><?php esc_html_e( 'Featured Image Option', 'matina' ); ?></label>
                        <select id="post-featured-image-option" name="featured_image_option" class="mt-meta-dropdown">
                            <?php foreach( $featured_image_option as $key => $value ) { ?>
                                <option value="<?php echo esc_attr( $key ); ?>" <?php selected( $featured_image_option_value, $key ); ?>><?php echo esc_html( $value ); ?></option>
                            <?php } ?>
                        </select>
                    </div><!-- .mt-featured-option -->
                    <div class="mt-single-field mt-image-checkbox-options mt-specific-options">
                        <label for="archive_audio_featured_image_option">
                            <input type="checkbox" name="archive_audio_featured_image_option" id="archive_audio_featured_image_option" value="yes" <?php if ( isset ( $matina_stored_meta['archive_audio_featured_image_option'] ) ) checked( $matina_stored_meta['archive_audio_featured_image_option'][0], true ); ?> />
                            <?php esc_html_e( 'Replace featured image by audio on archive.', 'matina' ); ?>
                        </label>
                        <label for="single_audio_featured_image_option">
                            <input type="checkbox" name="single_audio_featured_image_option" id="single_audio_featured_image_option" value="yes" <?php if ( isset ( $matina_stored_meta['single_audio_featured_image_option'] ) ) checked( $matina_stored_meta['single_audio_featured_image_option'][0], true ); ?> />
                            <?php esc_html_e( 'Replace featured image by audio on single.', 'matina' ); ?>
                        </label>
                    </div><!-- .mt-image-checkbox-options -->
                </div><!-- .mt-audio-format-field-wrapper -->
        <?php
                break;
            
            default:
                # code...
                break;
        }
    }

endif;