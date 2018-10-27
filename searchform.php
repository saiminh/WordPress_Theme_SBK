<?php
/**
 * Template for displaying search forms in SBK Website
 */
?>

<?php $unique_id = esc_attr( uniqid( 'search-form-' ) ); ?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="<?php echo $unique_id; ?>">
		<span class="screen-reader-text">
			<?php echo _x( 'Search for:', 'label', 'sbkTheme' ); ?>
		</span>
	</label>
	<input type="search" id="<?php echo $unique_id; ?>" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'sbkTheme' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
	<button type="submit" class="search-submit">
		<span class="screen-reader-text">
			<i class="fa fa-search" aria-hidden="true"></i>
		</span>
	</button>
</form>
