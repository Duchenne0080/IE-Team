<?php
/**
 * Sidebar template file.
 */
?>

<?php if ( is_active_sidebar( 'blog-sidebar' ) ) : ?>
    <aside class="sidebar blog-sidebar">
        <?php dynamic_sidebar( 'blog-sidebar' ); ?>
    </aside>
<?php endif; ?>
