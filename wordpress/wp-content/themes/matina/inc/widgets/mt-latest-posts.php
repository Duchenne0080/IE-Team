<?php
/**
 * Widget for display latest posts.
 *
 * @package Matina
 */

class Matina_Latest_Posts extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        $widget_ops = array( 
            'classname'                     => 'matina-widget matina_latest_posts',
            'description'                   => __( 'Display latest posts with post thumbnail.', 'matina' ),
            'customize_selective_refresh'   => true,
        );
        parent::__construct( 'matina_latest_posts', __( 'MT: Latest Posts', 'matina' ), $widget_ops );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {
        
        $fields = array(
            'title' => array(
                'matina_widgets_name'               => 'title',
                'matina_widgets_title'              => __( 'Widget Title', 'matina' ),
                'matina_widgets_default'            => __( 'Recent Posts', 'matina' ),
                'matina_widgets_field_type'         => 'title',
                'matina_widget_field_placeholder'   => __( 'Widget Title', 'matina' )
            ),

            'widget_posts_count' => array(
                'matina_widgets_name'           => 'widget_posts_count',
                'matina_widgets_title'          => __( 'No. of posts', 'matina' ),
                'matina_widgets_default'        => '4',
                'matina_widgets_field_type'     => 'number'
            ),

            'widget_posts_date' => array(
                'matina_widgets_name'           => 'widget_posts_date',
                'matina_widgets_title'          => __( 'Checked to show the posts publish date.', 'matina' ),
                'matina_widgets_default'        => '',
                'matina_widgets_field_type'     => 'checkbox'
            )
            
        );

        return $fields;

    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {
        extract( $args );
        if ( empty( $instance ) ) {
            return;
        }

        $widget_title   = empty( $instance['title'] ) ? '' : $instance['title'];
        $posts_count    = empty( $instance['widget_posts_count'] ) ? 4 : $instance['widget_posts_count'];
        $post_date      = empty( $instance['widget_posts_date'] ) ? '' : $instance['widget_posts_date'];

        $latest_args = array(
            'post_type'             => 'post',
            'posts_per_page'        => intval( $posts_count ),
            'ignore_sticky_posts'   => 1
        );

        $latest_query = new WP_Query( $latest_args );

        echo $before_widget;
    ?>
        <div class="mt-aside latest-posts-wrapper mt-clearfix">
            <?php
                if ( ! empty( $widget_title ) ) {
                    echo $before_title . esc_html( $widget_title ) . $after_title;
                }
            ?>
            <div class="posts-wrapper mt-clearfix">
                <?php
                    if ( $latest_query->have_posts() ) {
                        while ( $latest_query->have_posts() ) {
                            $latest_query->the_post();
                            $post_image = get_the_post_thumbnail_url( get_the_ID(), 'medium' );
                ?>
                            <div class="single-post-wrap mt-clearfix">
                                <figure class="post-thumb" style="background-image:url( <?php echo esc_url( $post_image ); ?> )"></figure>
                                <div class="post-content-wrap">
                                    <h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                    <?php if ( ! empty( $post_date ) ) { ?>
                                        <div class="post-meta">
                                            <?php matina_posted_on(); ?>
                                        </div>
                                    <?php } ?>
                                </div><!-- .post-content-wrap -->
                            </div><!-- .single-post-wrap -->
                <?php
                        }
                    }
                    wp_reset_postdata();
                ?>
            </div><!-- .posts-wrapper -->
        </div><!-- .mt-aside latest-posts-wrapper -->
    <?php

        echo $after_widget;
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param   array   $new_instance   Values just sent to be saved.
     * @param   array   $old_instance   Previously saved values from database.
     *
     * @uses    matina_widgets_updated_field_value()      defined in mt-widgets-fields.php
     *
     * @return  array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ( $widget_fields as $widget_field ) {

            extract( $widget_field );

            // Use helper function to get updated field values
            $instance[$matina_widgets_name] = matina_widgets_updated_field_value( $widget_field, $new_instance[$matina_widgets_name] );
        }

        return $instance;
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param   array $instance Previously saved values from database.
     *
     * @uses    matina_widgets_show_widget_field()        defined in mt-widgets-fields.php
     */
    public function form( $instance ) {

        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ( $widget_fields as $widget_field ) {

            // Make array elements available as variables
            extract( $widget_field );

            if ( empty( $instance ) && isset( $matina_widgets_default ) ) {
                $matina_widgets_field_value = $matina_widgets_default;
            } elseif ( empty( $instance ) ) {
                $matina_widgets_field_value = '';
            } else {
                $matina_widgets_field_value = $instance[$matina_widgets_name];
            }
            matina_widgets_show_widget_field( $this, $widget_field, $matina_widgets_field_value );
        }
    }

}