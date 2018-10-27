<?php /* 
-----------------------
Displays: Entries in category listing
-----------------------
*/ ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class( 'category-entry section' ); ?>>
			<div class="category-entry_thumbnail""> 
				<div class="cover">
					<?php if ( has_post_thumbnail() ) { the_post_thumbnail('large'); } ?>
				</div>
			</div>
			<header class="category-entry_header">
				<?php if ( is_singular() ) { echo '<h1 class="entry-title category-entry_title">'; } else { echo '<h2 class="entry-title category-entry_title">'; } ?><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a><?php if ( is_singular() ) { echo '</h1>'; } else { echo '</h2>'; } ?> 
				<?php // if ( !is_search() ) get_template_part( 'entry', 'meta' ); ?>
				<a class="button category-entry_link" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark">Read case study</a>
				<?php edit_post_link(); ?>
			</header>
			
			<?php // get_template_part( 'entry', ( is_archive() || is_search() ? 'summary' : 'content' ) ); ?>
			<?php // if ( !is_search() ) get_template_part( 'entry-footer' ); ?>
		</article>
	<?php /* if( $wp_query->current_post == $posts_per_page ) : // This is really just to show the closing div ?>
		</div>
	<?php endif; */ ?>
