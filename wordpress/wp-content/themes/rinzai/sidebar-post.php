<?php
/**
 * Post sidebar template file.
 */
?>

<?php if ( is_active_sidebar( 'post-sidebar' ) ) : ?>
    <aside class="sidebar post-sidebar">
        <?php dynamic_sidebar( 'post-sidebar' ); ?>
    </aside>
<?php endif; ?>
