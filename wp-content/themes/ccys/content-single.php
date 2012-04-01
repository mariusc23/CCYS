<?php
/**
 * @package Toolbox
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<?php if(has_post_thumbnail( $post_id )) {
			echo '<div class="image-wrap entry-thumbnail">' . get_the_post_thumbnail($post_id, "full", $src) . '</div>';
		}; ?>

		<small class="entry-meta">
			<?php toolbox_posted_on(); ?>
			<?php edit_post_link('Edit'); ?> 
		</small><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'toolbox' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->

	<!--<footer class="entry-meta">
		<small>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$category_list = get_the_category_list( __( ', ', 'toolbox' ) );
	
				/* translators: used between list items, there is a space after the comma */
				$tag_list = get_the_tag_list( '', ', ' );
	
				if ( ! toolbox_categorized_blog() ) {
					// This blog only has 1 category so we just need to worry about tags in the meta text
					if ( '' != $tag_list ) {
						$meta_text = __( 'This entry was tagged %2$s.', 'toolbox' );
					} 
				} else {
					// But this blog has loads of categories so we should probably display them here
					if ( '' != $tag_list ) {
						$meta_text = __( 'This entry was posted in %1$s and tagged %2$s.', 'toolbox' );
					} else {
						$meta_text = __( 'This entry was posted in %1$s.', 'toolbox' );
					}
	
				} // end check for categories on this blog
	
				printf(
					$meta_text,
					$category_list,
					$tag_list,
					get_permalink(),
					the_title_attribute( 'echo=0' )
				);
			?>

			<?php edit_post_link( __( 'Edit', 'toolbox' ), '<span class="edit-link">', '</span>' ); ?>
		</small>
	</footer>--><!-- .entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->
