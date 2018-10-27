<?php get_header(); ?>
<section id="content" role="main">
	<header class="category-header">
		<div class="category-title"><span class="category-title_category">\ <?php the_category(' '); ?></span><span class="category-title_casestudy"> \ <?php the_title(); ?></span></div>
	</header>
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<?php if (in_category( array('office', 'retail', 'residential') ) ) {
			get_template_part( 'entry-of-casestudy');
		} else {
			get_template_part( 'entry' ); 
		}; ?>

		<?php // if ( ! post_password_required() ) comments_template( '', true ); ?>
	<?php endwhile; endif; ?>

<?php /* Really not sure if we ever need a entry footer...
	<footer class="footer">
		<?php // get_template_part( 'nav', 'below-single' ); ?>
	</footer>
*/ ?>
</section>
<?php get_sidebar(); ?>
<?php get_footer(); ?>