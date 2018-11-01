<?php /* Template Name: Instagram News Page */ get_header(); ?>
<header class="category-header">
	<div class="category-title"><span class="category-title_category">\ <?php the_title(); ?></span></div>
</header>
<section id="content" role="main">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
			<div class="background page_background"> 
				<div class="cover">
					<img class="cover" src="
						<?php if ( has_post_thumbnail() ) { the_post_thumbnail_url(); } ?>
					">
				</div>
			</div>
			<header class="header page-header">
				<h1 class="entry-title page_entry-title"><span><?php the_title(); ?></span></h1> <?php edit_post_link(); ?>
			</header>
			<section class="entry-content page_entry-content">
				<div class="entry-content-slider">
					<?php // if ( has_post_thumbnail() ) { the_post_thumbnail(); } ?>
					<?php the_content(); ?>
					<?php get_template_part('instagram'); ?>
					<div class="entry-links"><?php wp_link_pages(); ?></div>
				</div>
			</section>
		</article>
		<?php if ( ! post_password_required() ) comments_template( '', true ); ?>
	<?php endwhile; endif; ?>
</section>
<?php get_sidebar(); ?>
<?php get_footer(); ?>