<?php /* Template Name: InDevelopment:FrontPage */ get_header(); ?>
<header class="category-header">
	<div class="category-title"><span class="category-title_category">\ Simon Bush-King Architecture</span></div>
</header>
<section id="content" role="main">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>		
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="background"> 
				<div class="cover">
					<img class="cover" src="
						<?php if ( has_post_thumbnail() ) { the_post_thumbnail_url(); } ?>
					">
				</div>
			</div>
			<header class="frontpage_header">								
				<h1 class="entry-title frontpage_entry-title">
					<span>
						<?php
							$text = get_post_meta( get_the_ID(), '_frontpage_meta_headline', true );
							echo esc_html( $text );
						?>
					</span>
				</h1>
				<div class="frontpage_nav">
					
					<?php /* 
					-----------------
					That stuff was intended to be frontpage navigation, maybe i should get rif of it
					-----------------
					 <a href="
						<?php 
							$category_object = get_category_by_slug('retail'); 
							$category_link = get_category_link($category_object); 
							echo $category_link;
						?>" 
						class="button frontpage_nav_button">
						<?php 
							$category_name = get_cat_name($category_object->term_id); 
							echo $category_name; 
						?> 
						<i class="fa fa-chevron-right" aria-hidden="true"></i>
					</a>
					<br>
					<a href="<?php $category_object = get_category_by_slug('office'); $category_link = get_category_link($category_object); echo $category_link ?>" class="button frontpage_nav_button"><?php $category_name = get_cat_name($category_object->term_id); echo $category_name; ?> <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
					<br>
					<a href="<?php $category_object = get_category_by_slug('residential'); $category_link = get_category_link($category_object); echo $category_link ?>" class="button frontpage_nav_button"><?php $category_name = get_cat_name($category_object->term_id); echo $category_name; ?> <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
					<br> 
					*/ ?>
					<a id="about" href="#about" class="button frontpage_more_button anchorlink">More about Simon <i class="fa fa-chevron-down" aria-hidden="true"></i></a>
				</div>
			</header>			
			<?php get_template_part( 'entry', ( is_archive() || is_search() ? 'summary' : 'content' ) ); ?>
			<?php // if ( !is_search() ) get_template_part( 'entry-footer' ); ?>
		</article>

		<?php // comments_template(); ?>
	<?php endwhile; endif; ?>
	<?php // get_template_part( 'nav', 'below' ); ?>
</section>
<?php get_sidebar(); ?>
<?php get_template_part('instagram'); ?>
<?php get_footer(); ?>