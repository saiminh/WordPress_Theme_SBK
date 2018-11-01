<?php if ( is_front_page() ) :  ?>
	<div class="instagram instagram-home">
	<h3 class="instagram_header">
		<i class="fa fa-instagram" aria-hidden="true"></i> Our Instagram feed
	</h3>
<?php else : ?>
	<div class="instagram instagram-page">
<?php endif; ?>
	<div id="instagram_images" class="instagram_images">
		<?php // instagram images are loaded through instafeed.js in the footer template ?>
	</div>
</div>