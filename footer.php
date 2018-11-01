<div class="clear"></div>
</div>
<footer id="footer" role="contentinfo">
	<?wp_nav_menu( array( 'theme_location' => 'footer-menu', 'container_class' => 'footer_links' ) ); ?>
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
	        template: '<a href="<?php $page = get_page_by_title( 'News' ); echo get_page_uri( $page ); ?>"><div class="instagram_imageContainer" style="background-image: url({{image}}); background-size: cover"></div><span class="instagram_image_caption">{{caption}}</span></a>',
	        limit: '4'
	    });
	    feed.run();
	});
</script>
<?php elseif ( is_page_template( 'template-instagramPage.php' ) ): ?> 
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
	        template: '<a href="{{link}}">{{model.date}} <div class="instagram_imageContainer"><img class="instagram_image" src="{{image}}" /></div><span class="instagram_image_date">{{model.created_time}} {{model.tagsFormatted}}</span><h3 class="instagram_image_location">{{location}}</h3><p class="instagram_image_caption">{{caption}}</span></p>',
	        limit: '60',
	        filter: function(image) {

	        		var date = new Date(image.created_time*1000);

	        		m = date.getMonth();
	        		d = date.getDate();
	        		y = date.getFullYear();

	        		var month_names = new Array ( );
	        		month_names[month_names.length] = "Jan";
	        		month_names[month_names.length] = "Feb";
	        		month_names[month_names.length] = "Mar";
	        		month_names[month_names.length] = "Apr";
	        		month_names[month_names.length] = "May";
	        		month_names[month_names.length] = "Jun";
	        		month_names[month_names.length] = "Jul";
	        		month_names[month_names.length] = "Aug";
	        		month_names[month_names.length] = "Sep";
	        		month_names[month_names.length] = "Oct";
	        		month_names[month_names.length] = "Nov";
	        		month_names[month_names.length] = "Dec";

	        		var thetime = month_names[m] + ' ' + d + ' ' + y;

	        		image.created_time = thetime;

	        		return true;
	        	}
	    });
	    feed.run();
	});
</script>

<?php endif; ?>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/scripts.js"></script>
</body>
</html>