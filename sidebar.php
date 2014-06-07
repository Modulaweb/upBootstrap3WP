<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @author Matthias Thom | http://upplex.de
 * @package upBootWP 1.1
 */
?>
	<div id="secondary" class="widget-area" role="complementary">
		<?php do_action( 'before_sidebar' ); ?>
		<aside id="search" class="widget widget_search well well-sm">
			<?php get_search_form(); ?>
		</aside>
		<?php if ( (isset($GLOBALS['authorId']) && 'post' == get_post_type()) || is_author() ) : ?>
			<?php
				if (!isset($GLOBALS['authorId'])) {
					$author = get_user_by( 'slug', get_query_var( 'author_name' ) );
					$GLOBALS['authorId'] = $author->ID;
				}
			?>
			<?php query_posts('author='.$GLOBALS['authorId'].'&showposts=1'); ?>
			<aside id="author_infos" class="widget well well-sm">
				<h1 class="widget-title"><? _e('About the author', 'upbootwp'); ?></h1>
				<img src="https://www.gravatar.com/avatar/<?php echo md5(get_the_author_meta( 'email', $GLOBALS['authorId'] )); ?>/?s=512&d=mm&r=g" alt=" " class="img-responsive no-grav">
				<h4><a href="<?php echo get_author_posts_url( $GLOBALS['authorId'] ); ?>" title="<?php echo sprintf( __('Other posts from %1$s', 'upbootwp'), get_the_author_meta( 'display_name', $GLOBALS['authorId'] ) ); ?>"><?php echo get_the_author_meta( 'display_name', $GLOBALS['authorId'] ); ?></a></h4>
				<p><?php echo nl2br(get_the_author_meta( 'description', $GLOBALS['authorId'] )); ?></p>
				<?php echo Bootsy_social_links_get($GLOBALS['authorId']); ?>
				<div class="clearfix"></div>
				<p>
					<a href="<?php echo get_author_posts_url( $GLOBALS['authorId'] ) ?>" class="btn btn-primary btn-xs"><?php _e('<span class="glyphicon glyphicon-user"></span> Other posts', 'upbootwp'); ?></a>
				</p>
			</aside>
			<?php if ( isset($GLOBALS['share_this_post']) ) : ?>
				<aside id="share_this_post" class="widget well well-sm">
					<?php
						$share_this_post = preg_replace('#<(/?)h3#', '<$1h1', $GLOBALS['share_this_post']);
						$share_this_post = str_replace('class="sd-content"', '', $share_this_post);
						$share_this_post = str_replace('sd-button', 'sd-button btn btn-default btn-xs', $share_this_post);
						echo $share_this_post;
					?>
				</aside>
			<?php endif; ?>
			<?php if ('post' == get_post_type() && !is_author()) : ?>
			<aside id="license" class="widget well well-sm">
				<h1 class="widget-title"><? _e('License', 'upbootwp'); ?></h1>
				<p><a rel="license" href="http://creativecommons.org/licenses/by-sa/4.0/"><img alt="Licence Creative Commons" style="border-width:0" src="http://i.creativecommons.org/l/by-sa/4.0/88x31.png" /></a><br />Cet article et son contenu est mis à disposition selon les termes de la <a rel="license" href="http://creativecommons.org/licenses/by-sa/4.0/">Licence Creative Commons Attribution -  Partage dans les Mêmes Conditions 4.0 International</a></p>
				<p>Par conséquent, vous pouvez partager et adapter (traduire, compléter, modifier) tout ou partie de cet article à condition de citer sa source et son auteur ansi que de redistribuer ce contenu ainsi produit en accordant les mêmes droits à vos lecteurs.</p>
			</aside>
			<?php endif; ?>
		<?php endif; ?>
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</div><!-- #secondary -->
