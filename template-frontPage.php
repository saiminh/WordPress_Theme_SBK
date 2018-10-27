<?php /* Template Name: Front Page */ get_header(); ?>
<header class="category-header">
	<div class="category-title"><span class="category-title_category">\ Simon Bush-King Architecture</span></div>
</header>
<section id="content" role="main">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>		
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<!-- <div class="background"> 
				<div class="cover">
					<img class="cover" src="
						<?php if ( has_post_thumbnail() ) { the_post_thumbnail_url(); } ?>
					">
				</div>
			</div> -->
			<div class="background frontpage_hero_carousel">
				<?php cmb2_output_file_list( '_gallery_file_list', 'gallery-size' ); ?>
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
					<a id="about" href="#homepage_content" class="button frontpage_more_button anchorlink">More about Simon <i class="fa fa-chevron-down" aria-hidden="true"></i></a>
				</div>
			</header>
			<div id="homepage_content">			
				<?php get_template_part( 'entry', ( is_archive() || is_search() ? 'summary' : 'content' ) ); ?>
				<?php // if ( !is_search() ) get_template_part( 'entry-footer' ); ?>
				<div class="entry-content entry-content-homecategoryintro">
					<div class="homecategoryinfo">
						<?php
							$text_homecategoryinfo1 = wpautop(get_post_meta( get_the_ID(), 'homecategoryinfo1_content', true ));
							echo $text_homecategoryinfo1;
						?>
					</div>
					<div class="homecategoryinfo">
						<?php
							$text_homecategoryinfo2 = wpautop(get_post_meta( get_the_ID(), 'homecategoryinfo2_content', true ));
							echo $text_homecategoryinfo2;
						?>
					</div>
					<div class="homecategoryinfo">
						<?php
							$text_homecategoryinfo3 = wpautop(get_post_meta( get_the_ID(), 'homecategoryinfo3_content', true ));
							echo $text_homecategoryinfo3;
						?>
					</div>
				</div>
			</div>
		</article>

		<?php // comments_template(); ?>
	<?php endwhile; endif; ?>
	<?php // get_template_part( 'nav', 'below' ); ?>
</section>
<?php get_sidebar(); ?>
<?php get_template_part('instagram'); ?>
<?php get_footer(); ?>