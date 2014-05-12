<?php
/**
 * @author Matthias Thom | http://upplex.de
 * @package upBootWP 1.1
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('well'); ?>>
	<header class="entry-header">
		<h1 class="entry-title">
			<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
		</h1>

		<?php if ( 'post' == get_post_type() ) : ?>
		<?php $GLOBALS['authorId'] = get_the_author_meta( 'ID'); ?>
		<div class="entry-meta">
			<?php upbootwp_posted_on(); ?>
			<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
			<span class="comments-link"><?php comments_number( 
				 __( '<span class="label label-default" title="No comments">0 <span class="glyphicon glyphicon-comment"></span>', 'upbootwp'), 
				 __( '<span class="label label-primary" title="One comment">1 <span class="glyphicon glyphicon-comment"></span>', 'upbootwp'), 
				 __( '<span class="label label-success" title="% comments">% <span class="glyphicon glyphicon-comment"></span>', 'upbootwp')
			) ?></span>
			<?php endif; ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-summary">
		<?php
			if ( function_exists( 'sharing_display' ) ) { 
				remove_filter( 'the_content', 'sharing_display', 19 );
				$GLOBALS['share_this_post'] = sharing_display();
				//remove_class_filter( 'the_content', 'GPlus_Authorship' , 'post_output_wrapper', 22 );
			}
		?>
		<?php the_content( __( '<span class="meta-nav glyphicon glyphicon-circle-arrow-right"></span> Continue reading', 'upbootwp')); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'upbootwp' ),
				'after'  => '</div>',
			));
		?>
	</div><!-- .entry-summary -->

	<footer class="entry-meta">
		<?php if ('post' == get_post_type()) : // Hide category and tag text for pages on Search ?>
			<?php
				if ( function_exists( 'sharing_display' ) ) { 
					$share_this_post = $GLOBALS['share_this_post'];
					$share_this_post = preg_replace('#<(/?)h3#', '<$1span', $share_this_post);
					$share_this_post = str_replace('<span class="sd-title"', '<span class="glyphicon glyphicon-share"></span> <span class="sr-only"', $share_this_post);
					$share_this_post = str_replace('class="sd-content"', '', $share_this_post);
					$share_this_post = str_replace('sd-button', 'sd-button btn btn-default btn-xs', $share_this_post);
					echo $share_this_post;
				}
			?>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( '</span> <span class="label label-primary">' );
				if ( $categories_list && upbootwp_categorized_blog() ) :
			?>
			<div class="cat-links">
				<?php printf( __( '<strong class="glyphicon glyphicon-book" title="Categories"><span class="text-hide">Posted in:</strong> <span class="label label-primary">%1$s</span>', 'upbootwp' ), $categories_list ); ?>
			</div>
			<?php endif; // End if categories ?>

			<?php
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '<span class="label label-default">', '</span> <span class="label label-default">', '</span>' );
				if ( $tags_list ) :
			?>
			<div class="tags-links">
				<?php printf( __( '<strong class="glyphicon glyphicon-tag" title="Tags"><span class="text-hide">Tagged:</strong> %1$s', 'upbootwp' ), $tags_list ); ?>
			</div>
			<?php endif; // End if $tags_list ?>
		<?php endif; // End if 'post' == get_post_type() ?>

		<?php edit_post_link( __( 'Edit', 'upbootwp' ), '<span><span class="edit-link">', '</span></span>' ); ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-## -->
