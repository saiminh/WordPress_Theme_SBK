<?php get_header(); ?>
<section id="content" role="main">
	<header class="category-header">
		<h1 class="category-title">\ <?php single_cat_title(); ?></h1>
		<h1 class="entry-title category_entry-title"><span><?php single_cat_title(); ?></span></h1>
	</header>
	
	<?php
		$term_id = get_queried_object()->term_id;
		$avatar = get_term_meta( $term_id, '_categorycontent_term_avatar', true );
		echo '<div class="background category_background"><div class="cover"><img class="cover" src="'. $avatar . '" /></div></div>';
	?>
	<div class="entry-content entry-content-category">
		<div class="category-content-box">
		<?php	
			$categorycontent = wpautop(get_term_meta( $term_id, '_categorycontent_term_excerpt', true));
			echo $categorycontent;
		?>
		</div>
		<div class="category_casestudies">
		<h3 class="category_postlist_header">Projects:</h3>
		<ul class="category_postlist">

			<!-- the loop -->
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
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
			<?php endwhile; endif; ?>
			<!-- end of the loop -->

		</ul>


		<!-- <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'entry-of-category' ); ?>
		<?php endwhile; endif; ?> -->
		</div>
	
	<?php get_template_part( 'nav', 'below' ); ?>
	</div>
</section>
<?php //get_sidebar(); ?>
<?php get_footer(); ?>