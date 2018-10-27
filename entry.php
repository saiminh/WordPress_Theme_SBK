<?php /* 
-----------------------
Displays: single posts, archives, search results... Categories have their own template entry-of-category.php ...
-----------------------
*/ ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="background category-entry--featured_background" style="background-image: url(<?php if ( has_post_thumbnail() ) { the_post_thumbnail_url(); } ?>);"></div>
	<header>
		<?php if ( is_singular() ) { 
			echo '<h1 class="entry-title">'; 
		} else { 
			echo '<h2 class="entry-title">'; } 
		?>
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark">
			<?php the_title(); ?>
		</a>
		<?php if ( is_singular() ) { 
			echo '</h1>'; 
		} else { 
			echo '</h2>'; } 
		?>
		<?php edit_post_link(); ?>
		<?php // if ( !is_search() ) get_template_part( 'entry', 'meta' ); ?>
	</header>
	<?php get_template_part( 'entry', ( is_archive() || is_search() ? 'summary' : 'content' ) ); ?>
	<?php if ( !is_search() ) get_template_part( 'entry-footer' ); ?>
</article>