<div class="clear"></div>
</div>
<footer id="footer" role="contentinfo">
	<div class="footer_links">
		<a href="<?php echo esc_url( get_permalink( get_option( 'wp_page_for_privacy_policy' ) ) ); ?>">Privacy Policy</a>
	</div>
	<div id="copyright">
	<?php echo sprintf( __( '%1$s %2$s %3$s. All Rights Reserved.', 'sbkTheme' ), '&copy;', date( 'Y' ), esc_html( get_bloginfo( 'name' ) ) ); ?>
	</div>
</footer>
</div>
<?php wp_footer(); ?>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.fullpage.min.js"></script>
<?php if( is_front_page() ): ?>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/instafeed.min.js"></script>
<script>
	// Instafeed  plugin
// -----------------------------
	jQuery(document).ready(function(){
		var feed = new Instafeed({
	        get: 'user',
	        userId: '2302118850',	       
	        clientId: '636fc1c024c7459c94034082f2679bb5',
	        accessToken: '2302118850.636fc1c.a8f720bd8409476fad11009214b8a5ec',
	        target: 'instagram_images',
	        resolution: 'standard_resolution',
	        template: '<a href="{{link}}"><span class="instagram_image_caption">{{caption}}</span><img src="{{image}}" /></a>'
	    });
	    feed.run();
	});
</script>
<?php endif; ?>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/scripts.js"></script>
</body>
</html>