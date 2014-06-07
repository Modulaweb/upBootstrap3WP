<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @author Matthias Thom | http://upplex.de
 * @package upBootWP 1.1
 */
?>

	</div><!-- #content -->
	<footer id="page-footer" class="navbar-default">
		<div class="container">
			<div class="row">
				<div class="col-md-9">
					<div class="row">
						<div class="col-md-4">
							<?php dynamic_sidebar( 'footer-1' ); ?>
						</div>
						<div class="col-md-8">
							<?php dynamic_sidebar( 'footer-2' ); ?>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<?php dynamic_sidebar( 'footer-3' ); ?>
				</div>
			</div>
		</div>
	</footer>
</div><!-- #page -->

<?php wp_footer(); ?>
<script>
	$(function(){$('#main-menu').parent().append($('#social-nav-html').html());
var $footer=$('#page-footer');var footerO=$footer.offset();
if(footerO.top+$footer.height()<$(window).height()){
	$footer.css({bottom:0,position:'absolute',width:'100%'});
};
});
</script>
</body>
</html>