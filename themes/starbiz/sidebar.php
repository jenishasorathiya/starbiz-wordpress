<?php
/**
 * The sidebar containing the main widget area
 *
 * @package starbiz
 */

// Check if sidebar is active
if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
    <aside id="secondary" class="widget-area mb-4">
        <?php
        dynamic_sidebar( 'sidebar-1' );
        ?>
    </aside>
<?php endif; ?>
