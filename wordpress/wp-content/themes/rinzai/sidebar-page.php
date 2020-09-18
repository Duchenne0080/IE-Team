<?php
/**
 * Page sidebar template file.
 */
?>

<?php if ( is_active_sidebar( 'page-sidebar' ) ) : ?>
    <aside class="sidebar page-sidebar">
        <?php dynamic_sidebar( 'page-sidebar' ); ?>
    </aside>
<?php endif; ?>
