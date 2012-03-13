<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Toolbox
 * @since Toolbox 0.1
 */
?>

		<?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
		<div id="tertiary" class="fivecol widget-area" role="complementary">
			<?php dynamic_sidebar( 'sidebar-2' ); ?>
		</div><!-- #tertiary .widget-area -->
		<?php endif; ?>