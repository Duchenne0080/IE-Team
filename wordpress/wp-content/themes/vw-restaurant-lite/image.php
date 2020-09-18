<?php
/**
 * The template for displaying image attachments.
 *
 * @package VW Restaurant Lite
 */

get_header(); ?>

<main id="maincontent" role="main">
    <div class="container">
        <?php
            $vw_restaurant_lite_left_right = get_theme_mod( 'vw_restaurant_lite_theme_options','Right Sidebar');
            if($vw_restaurant_lite_left_right == 'Left Sidebar'){ ?>
            <div class="row">
                <div  class="sidebar col-lg-4 col-md-4"><?php dynamic_sidebar('sidebar-2');?></div>
                <div class="services col-lg-8 col-md-8">
            		<?php while ( have_posts() ) : the_post(); ?>    
                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            <div class="entry-content">
                                <h1><?php the_title();?></h1>    
                                <div class="entry-attachment">
                                    <div class="attachment">
                                        <?php vw_restaurant_lite_the_attached_image(); ?>
                                    </div>

                                    <?php if ( has_excerpt() ) : ?>
                                        <div class="entry-caption">
                                            <?php the_excerpt(); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>    
                                <?php
                                    the_content();
                                    wp_link_pages( array(
                                        'before' => '<div class="page-links">' . __( 'Pages:', 'vw-restaurant-lite' ),
                                        'after'  => '</div>',
                                    ) );
                                ?>
                            </div>    
                            <?php edit_post_link( __( 'Edit', 'vw-restaurant-lite' ), '<footer class="entry-meta"><span class="edit-link">', '</span></footer>' ); ?>
                        </article>    
                        <?php
                            // If comments are open or we have at least one comment, load up the comment template
                            if ( comments_open() || '0' != get_comments_number() )
                                comments_template();
                        ?>    
                    <?php endwhile; // end of the loop. ?>
                </div>
            </div>
        <?php }else if($vw_restaurant_lite_left_right == 'Right Sidebar'){ ?>
            <div class="row">
                <div class="services col-lg-8 col-md-8">
                    <?php while ( have_posts() ) : the_post(); ?>    
                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            <div class="entry-content">
                                <h1><?php the_title();?></h1>    
                                <div class="entry-attachment">
                                    <div class="attachment">
                                        <?php vw_restaurant_lite_the_attached_image(); ?>
                                    </div>

                                    <?php if ( has_excerpt() ) : ?>
                                        <div class="entry-caption">
                                            <?php the_excerpt(); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>    
                                <?php
                                    the_content();
                                    wp_link_pages( array(
                                        'before' => '<div class="page-links">' . __( 'Pages:', 'vw-restaurant-lite' ),
                                        'after'  => '</div>',
                                    ) );
                                ?>
                            </div>    
                            <?php edit_post_link( __( 'Edit', 'vw-restaurant-lite' ), '<footer class="entry-meta"><span class="edit-link">', '</span></footer>' ); ?>
                        </article>    
                        <?php
                            // If comments are open or we have at least one comment, load up the comment template
                            if ( comments_open() || '0' != get_comments_number() )
                                comments_template();
                        ?>    
                    <?php endwhile; // end of the loop. ?>
                </div>
                <div  class="sidebar col-lg-4 col-md-4"><?php dynamic_sidebar('sidebar-2');?></div>
            </div>
        <?php }else if($vw_restaurant_lite_left_right == 'One Column'){ ?>
            <div class="services">
                <?php while ( have_posts() ) : the_post(); ?>    
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <div class="entry-content">
                            <h1><?php the_title();?></h1>    
                            <div class="entry-attachment">
                                <div class="attachment">
                                    <?php vw_restaurant_lite_the_attached_image(); ?>
                                </div>

                                <?php if ( has_excerpt() ) : ?>
                                    <div class="entry-caption">
                                        <?php the_excerpt(); ?>
                                    </div>
                                <?php endif; ?>
                            </div>    
                            <?php
                                the_content();
                                wp_link_pages( array(
                                    'before' => '<div class="page-links">' . __( 'Pages:', 'vw-restaurant-lite' ),
                                    'after'  => '</div>',
                                ) );
                            ?>
                        </div>    
                        <?php edit_post_link( __( 'Edit', 'vw-restaurant-lite' ), '<footer class="entry-meta"><span class="edit-link">', '</span></footer>' ); ?>
                    </article>    
                    <?php
                        // If comments are open or we have at least one comment, load up the comment template
                        if ( comments_open() || '0' != get_comments_number() )
                            comments_template();
                    ?>    
                <?php endwhile; // end of the loop. ?>
            </div>
        <?php }else if($vw_restaurant_lite_left_right == 'Three Columns'){ ?>
            <div class="row">
                <div  class="sidebar col-lg-3 col-md-3"><?php dynamic_sidebar('sidebar-1');?></div>
                <div class="services col-lg-6 col-md-6">
                    <?php while ( have_posts() ) : the_post(); ?>    
                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            <div class="entry-content">
                                <h1><?php the_title();?></h1>    
                                <div class="entry-attachment">
                                    <div class="attachment">
                                        <?php vw_restaurant_lite_the_attached_image(); ?>
                                    </div>

                                    <?php if ( has_excerpt() ) : ?>
                                        <div class="entry-caption">
                                            <?php the_excerpt(); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>    
                                <?php
                                    the_content();
                                    wp_link_pages( array(
                                        'before' => '<div class="page-links">' . __( 'Pages:', 'vw-restaurant-lite' ),
                                        'after'  => '</div>',
                                    ) );
                                ?>
                            </div>    
                            <?php edit_post_link( __( 'Edit', 'vw-restaurant-lite' ), '<footer class="entry-meta"><span class="edit-link">', '</span></footer>' ); ?>
                        </article>    
                        <?php
                            // If comments are open or we have at least one comment, load up the comment template
                            if ( comments_open() || '0' != get_comments_number() )
                                comments_template();
                        ?>    
                    <?php endwhile; // end of the loop. ?>
                </div>
                <div  class="sidebar col-lg-3 col-md-3"><?php dynamic_sidebar('sidebar-2');?></div>
            </div>
        <?php }else if($vw_restaurant_lite_left_right == 'Four Columns'){ ?>
            <div class="row">
                <div  class="sidebar col-lg-3 col-md-3"><?php dynamic_sidebar('sidebar-1');?></div>
                <div class="services col-lg-3 col-md-3">
                    <?php while ( have_posts() ) : the_post(); ?>    
                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            <div class="entry-content">
                                <h1><?php the_title();?></h1>    
                                <div class="entry-attachment">
                                    <div class="attachment">
                                        <?php vw_restaurant_lite_the_attached_image(); ?>
                                    </div>

                                    <?php if ( has_excerpt() ) : ?>
                                        <div class="entry-caption">
                                            <?php the_excerpt(); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>    
                                <?php
                                    the_content();
                                    wp_link_pages( array(
                                        'before' => '<div class="page-links">' . __( 'Pages:', 'vw-restaurant-lite' ),
                                        'after'  => '</div>',
                                    ) );
                                ?>
                            </div>    
                            <?php edit_post_link( __( 'Edit', 'vw-restaurant-lite' ), '<footer class="entry-meta"><span class="edit-link">', '</span></footer>' ); ?>
                        </article>    
                        <?php
                            // If comments are open or we have at least one comment, load up the comment template
                            if ( comments_open() || '0' != get_comments_number() )
                                comments_template();
                        ?>    
                    <?php endwhile; // end of the loop. ?>
                </div>
                <div  class="sidebar col-lg-3 col-md-3"><?php dynamic_sidebar('sidebar-2');?></div>
                <div  class="sidebar col-lg-3 col-md-3"><?php dynamic_sidebar('sidebar-3');?></div>
            </div>
        <?php }else if($vw_restaurant_lite_left_right == 'Grid Layout'){ ?>
            <div class="row">
                <div class="services col-lg-8 col-md-8">
                    <?php while ( have_posts() ) : the_post(); ?>    
                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            <div class="entry-content">
                                <h1><?php the_title();?></h1>    
                                <div class="entry-attachment">
                                    <div class="attachment">
                                        <?php vw_restaurant_lite_the_attached_image(); ?>
                                    </div>

                                    <?php if ( has_excerpt() ) : ?>
                                        <div class="entry-caption">
                                            <?php the_excerpt(); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>    
                                <?php
                                    the_content();
                                    wp_link_pages( array(
                                        'before' => '<div class="page-links">' . __( 'Pages:', 'vw-restaurant-lite' ),
                                        'after'  => '</div>',
                                    ) );
                                ?>
                            </div>    
                            <?php edit_post_link( __( 'Edit', 'vw-restaurant-lite' ), '<footer class="entry-meta"><span class="edit-link">', '</span></footer>' ); ?>
                        </article>    
                        <?php
                            // If comments are open or we have at least one comment, load up the comment template
                            if ( comments_open() || '0' != get_comments_number() )
                                comments_template();
                        ?>    
                    <?php endwhile; // end of the loop. ?>
                </div>
                <div class="sidebar col-lg-4 col-md-4"><?php dynamic_sidebar('sidebar-2');?></div>
            </div>
        <?php }else {?>
            <div class="row">
                <div class="services col-lg-8 col-md-8">
                    <?php while ( have_posts() ) : the_post(); ?>    
                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            <div class="entry-content">
                                <h1><?php the_title();?></h1>    
                                <div class="entry-attachment">
                                    <div class="attachment">
                                        <?php vw_restaurant_lite_the_attached_image(); ?>
                                    </div>

                                    <?php if ( has_excerpt() ) : ?>
                                        <div class="entry-caption">
                                            <?php the_excerpt(); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>    
                                <?php
                                    the_content();
                                    wp_link_pages( array(
                                        'before' => '<div class="page-links">' . __( 'Pages:', 'vw-restaurant-lite' ),
                                        'after'  => '</div>',
                                    ) );
                                ?>
                            </div>    
                            <?php edit_post_link( __( 'Edit', 'vw-restaurant-lite' ), '<footer class="entry-meta"><span class="edit-link">', '</span></footer>' ); ?>
                        </article>    
                        <?php
                            // If comments are open or we have at least one comment, load up the comment template
                            if ( comments_open() || '0' != get_comments_number() )
                                comments_template();
                        ?>    
                    <?php endwhile; // end of the loop. ?>
                </div>
                <div  class="sidebar col-lg-4 col-md-4"><?php dynamic_sidebar('sidebar-2');?></div>
            </div>
        <?php }?>
        <div class="clear"></div>
    </div>
    <div class="clearfix"></div>
</main>

<?php get_footer(); ?>