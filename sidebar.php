<aside id="sidebar" role="complementary">
<a class="sidebar_logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_html( get_bloginfo( 'name' ) ); ?>" rel="home"><?php include ("assets/img/SBK_Logo.svg"); ?></a>
	<?php 
	// the current post ID
	$currentID = get_the_ID();
	// the query
	$wpb_all_query = new WP_Query(array('post_type'=>'post', 'post_status'=>'publish', 'posts_per_page'=>-1, 'post__not_in'=>array($currentID), 'orderby'=>'rand', 'posts_per_page'=>'4')); ?>

	<?php if ( $wpb_all_query->have_posts() && !is_single() ) : ?>
	<h3 class="sidebar_header">
		<?php if (is_page_template('template-frontPage.php')) {
			echo 'Latest projects'; 
		} else {
			echo 'More projects';
		} ?>
	</h3>
	<ul class="sidebar_postlist">

		<!-- the loop -->
		<?php while ( $wpb_all_query->have_posts() ) : $wpb_all_query->the_post(); ?>
			<li class="sidebar_postlist_wrapper">
				<a class="sidebar_postlist_postlink" href="<?php the_permalink(); ?>">
					<div class="sidebar_postlist_thumbnail-wrapper" style="background-image: url(<?php the_post_thumbnail_url('medium'); ?>);">
					</div>
					<span class="sidebar_postlist_postlink_text"><?php the_title(); ?></span>					
				</a>
				<div class="sidebar_postlist_categorylink">
					<?php the_category(); ?>
				</div>
			</li>
		<?php endwhile; ?>
		<!-- end of the loop -->

	</ul>

		<?php wp_reset_postdata(); ?>

	<?php elseif ( $wpb_all_query->have_posts() && is_single() ) : ?>

	<div class="related_projects">
		<h3 class="sidebar_header">
			More projects in <?php the_category(); ?>
		</h3>
		<ul class="category_postlist">
		<?php 
			$related = new WP_Query(
			    array(
			        'category__in'   => wp_get_post_categories( $post->ID ),
			        'posts_per_page' => 6,
			        'post__not_in'   => array( $post->ID )
			    )
			);

			if( $related->have_posts() ) : 
			    while( $related->have_posts() ) : 
			        $related->the_post(); 
					
			       

		?>

			<li class="category_postlist_wrapper">
				<a class="category_postlist_postlink" href="<?php the_permalink(); ?>">
					<div class="category_postlist_thumbnail-wrapper" style="background-image: url(<?php the_post_thumbnail_url('medium'); ?>);">
					</div>
					<div class="category_postlist_postlink_text"><?php the_title(); ?></div>					
				</a>			
				<div class="category_excerpt">
					<?php the_excerpt(); ?>
				</div>
			</li>

		<?php wp_reset_postdata(); endwhile; endif; ?>
		</ul>
	</div>


	<?php else : ?>
		<p><?php _e( 'No posts yet, stay tuned!' ); ?></p>
	<?php endif; ?>


	<!-- <?php if ( is_active_sidebar( 'primary-widget-area' ) ) : ?>
	
	<div id="primary" class="widget-area">
		<ul class="xoxo">
			<?php dynamic_sidebar( 'primary-widget-area' ); ?>
		</ul>
	</div>
	
	<?php endif; ?> -->



</aside>