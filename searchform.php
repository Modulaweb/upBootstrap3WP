<?php
/**
 * The template for displaying search forms in upBootWP
 *
 * @author Matthias Thom | http://upplex.de
 * @package upBootWP 1.1
 */
?>
<form role="search" method="get" class="search-form form-inline" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="input-group">
      <input type="search" class="search-field form-control" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'upbootwp' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" title="<?php _ex( 'Search for:', 'label', 'upbootwp' ); ?>">
      <span class="input-group-btn">
        <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span><span class="sr-only"><?php echo esc_attr_x( 'Search', 'submit button', 'upbootwp' ); ?></span></button>
      </span>
    </div><!-- /input-group -->
</form>
