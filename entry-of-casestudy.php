<?php /* 
-----------------------
Displays: case-study entries
-----------------------
*/ ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('casestudy'); ?>>
	<div class="background casestudy_background"> 
		<div class="cover">
			<?php if ( has_post_thumbnail() ) { the_post_thumbnail('gallery-size', ["class" => "cover"]); } ?>			
		</div>
	</div>
	<header class="casestudy-header">
		<!-- <h2 class="entry-title casestudy-header_title">
			<span><?php the_title(); ?></span>
		</h2> -->
		<?php edit_post_link(); ?>
		<?php // if ( !is_search() ) get_template_part( 'entry', 'meta' ); ?>
	</header>
	
	

	<section class="entry-content">	

		<?php 
		// –––––––––––––––––––––––– 
		// gallery Block
		// –––––––––––––––––––––––– 
			$galleryfiles  = get_post_meta( get_the_ID(), '_gallery_file_list', true );

			if ( !empty($galleryfiles) ) : // Check if there's any entries			
		?>
			<div class="casestudy_gallery_wrapper">
				<div class="casestudy_gallery_header">
					<div id="site-title">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_html( get_bloginfo( 'name' ) ); ?>" rel="home"><?php include ("assets/img/SBK_Logo.svg"); ?></a>
					</div>
					<div class="category-title">\ Gallery: <?php the_title(); ?> </div>
					<a href="#" class="casestudy_gallery_close">
						<?php include ("assets/img/SBK_UI_X.svg"); ?>
					</a>
				</div>
				<div class="casestudy_gallery_fullpage">		
					<div class="section">	
						<?php cmb2_output_file_list( '_gallery_file_list', 'gallery-size' ); ?>									
					</div>
				</div>
			</div>
		<?php endif; ?>

		<div class="entry-content_editor_content">
			<?php 
			// ––––––––––––––––––––––––
			// The Editor Content
			// ––––––––––––––––––––––––
				the_content();
			 ?>
		</div>
		<?php 
			// –––––––––––––––––––––––– 
			// Fact Sheet
			// –––––––––––––––––––––––– 
			$entries = get_post_meta(get_the_ID() , '_casefacts_group_demo', true); 
			if ( !empty($entries) ) : // Check if there's any entries in the factsheet
		?>	
			<div class="factsheet">
				<table class="factsheet_table">
					<tr>
						<th colspan="2" class="factsheet_title">At a glance</th>
					</tr>
						    
					    
					<?php foreach((array)$entries as $key => $entry) {
					    
					        $factname = $factvalue = '';
					        
							if ( isset( $entry[ 'factname' ] ) ) 
							    $factname = esc_html( $entry[ 'factname' ] );
							        
							if ( isset( $entry[ 'factvalue' ] ) )
							    $factvalue = $entry[ 'factvalue' ];
							        					        
					        if ( !empty($factname) ) {
					        	echo '<tr class="factsheet_row"><td class="factsheet_factname"> ' .$factname . '</td>';			       
					        }			       
					       
					        if ( !empty($factvalue) ) {
					        	echo '<td class="factsheet_factvalue"> ' .$factvalue. '</td></tr>';			       
					        }			        
					    } 
				?>
					</table>

					<div class="launch_the_gallery view-from-1200">
						<?php 
							if($galleryfiles) 
								foreach($galleryfiles as $firstfile) break; //This will only get the first image of the gallery
								echo '<img class="gallery_preview" src="'.$firstfile.'">' 		
							;			
						?>		
						<a class="button button-secondary gallery-button"><i class="fa fa-search-plus" aria-hidden="true"></i> View Gallery</a>
					</div>

					<!-- <a class="button button-secondary gallery-button">View Gallery</a> -->
			</div>
		<?php endif; ?>

		<?php 
		// –––––––––––––––––––––––– 
		// Client Block
		// –––––––––––––––––––––––– 
			$clientheadline = get_post_meta( get_the_ID(), 'client_headline', true );
			$clientimagesrc = get_post_meta( get_the_ID(), 'client_image', true );
			$clientcontent  = get_post_meta( get_the_ID(), 'client_content', true );

			if ( !empty($clientheadline) ) : // Check if there's any entries			
		?>
			<div class="casestudy_client">
				<div class="casestudy_client_image" style="background-image: url(<?php echo esc_html( $clientimagesrc ); ?>)">
				</div>
								
				<div class="casestudy_client_content">
					<h3 class="casestudy_client_headline">
						<?php echo esc_html( $clientheadline ); ?>
					</h3>
					<?php echo $clientcontent; ?>
				</div>
			</div>
		<?php endif; ?>

		<?php 
		// –––––––––––––––––––––––– 
		// brief Block
		// –––––––––––––––––––––––– 
			$briefheadline = get_post_meta( get_the_ID(), 'brief_headline', true );
			$briefcontent  = get_post_meta( get_the_ID(), 'brief_content', true );

			if ( !empty($briefheadline) ) : // Check if there's any entries			
		?>
			<div class="casestudy_brief">								
					<h3 class="casestudy_brief_headline">
						<?php echo esc_html( $briefheadline ); ?>
					</h3>
					<?php echo wpautop(do_shortcode($briefcontent)); ?>
			</div>
		<?php endif; ?>

		<?php 
		// –––––––––––––––––––––––– 
		//	approach Block
		// –––––––––––––––––––––––– 
			$approachheadline = get_post_meta( get_the_ID(), 'approach_headline', true );
			$approachcontent  = get_post_meta( get_the_ID(), 'approach_content', true );

			if ( !empty($approachheadline) ) : // Check if there's any entries			
		?>
			<div class="casestudy_approach">								
					<h3 class="casestudy_approach_headline">
						<?php echo esc_html( $approachheadline ); ?>
					</h3>
					<?php echo wpautop(do_shortcode($approachcontent)); ?>
			</div>
		<?php endif; ?>		

		<?php 
		// –––––––––––––––––––––––– 
		//	result Block 
		// –––––––––––––––––––––––– 		
			$resultheadline = get_post_meta( get_the_ID(), 'result_headline', true );
			$resultcontent  = get_post_meta( get_the_ID(), 'result_content', true );

			if ( !empty($resultheadline) ) : // Check if there's any entries			
		?>
			<div class="casestudy_result">								
					<h3 class="casestudy_result_headline">
						<?php echo esc_html( $resultheadline ); ?>
					</h3>
					<?php echo wpautop(do_shortcode($resultcontent)); ?>					
			</div>
		<?php endif; ?>			

			<div class="launch_the_gallery view-upto-1200">
				<?php 
					if($galleryfiles) 
						foreach($galleryfiles as $firstfile) break; //This will only get the first image of the gallery
						echo '<img class="gallery_preview" src="'.$firstfile.'">' 		
					;			
				?>			
				<a class="button button-secondary gallery-button"><i class="fa fa-search-plus" aria-hidden="true"></i> View Gallery</a>
			</div>

		<?php 
		// –––––––––––––––––––––––– 
		//	CTA Block 
		// –––––––––––––––––––––––– 		
			$ctaheadline = get_post_meta( get_the_ID(), 'cta_headline', true );		
			$ctacontent = get_post_meta( get_the_ID(), 'cta_content', true );		
			$ctabuttontext = get_post_meta( get_the_ID(), 'cta_button_text', true );		
			$ctabuttonlink = get_post_meta( get_the_ID(), 'cta_button_link', true );		
		?>

			<div class="casestudy_cta">
				<h3 class="casestudy_cta_headline"><?php echo esc_html( $ctaheadline ); ?></h3>
				<?php echo wpautop($ctacontent); ?> 
				<a href="<?php echo esc_html( $ctabuttonlink ); ?>" class="button button-cta"><!-- <i class="fa fa-envelope-o" aria-hidden="true"></i>&nbsp;&nbsp; --><?php echo esc_html( $ctabuttontext ); ?></a>
			</div>

	</section>

	<?php // if ( !is_search() ) get_template_part( 'entry-footer' ); ?>

</article>