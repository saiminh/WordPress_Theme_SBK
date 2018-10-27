<?php
add_action( 'after_setup_theme', 'sbkTheme_setup' );
function sbkTheme_setup()
{
load_theme_textdomain( 'sbkTheme', get_template_directory() . '/languages' );
add_theme_support( 'title-tag' );
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'post-thumbnails' );
global $content_width;
if ( ! isset( $content_width ) ) $content_width = 640;
register_nav_menus(
array( 'main-menu' => __( 'Main Menu', 'sbkTheme' ) )
);
}
add_action( 'wp_enqueue_scripts', 'sbkTheme_load_scripts' );
function sbkTheme_load_scripts()
{
wp_enqueue_script( 'jquery' );
}
add_action( 'comment_form_before', 'sbkTheme_enqueue_comment_reply_script' );
function sbkTheme_enqueue_comment_reply_script()
{
if ( get_option( 'thread_comments' ) ) { wp_enqueue_script( 'comment-reply' ); }
}
add_filter( 'the_title', 'sbkTheme_title' );
function sbkTheme_title( $title ) {
if ( $title == '' ) {
return '&rarr;';
} else {
return $title;
}
}
add_filter( 'wp_title', 'sbkTheme_filter_wp_title' );
function sbkTheme_filter_wp_title( $title )
{
return $title . esc_attr( get_bloginfo( 'name' ) );
}
add_action( 'widgets_init', 'sbkTheme_widgets_init' );
function sbkTheme_widgets_init()
{
register_sidebar( array (
'name' => __( 'Sidebar Widget Area', 'sbkTheme' ),
'id' => 'primary-widget-area',
'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
'after_widget' => "</li>",
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>',
) );
}
function sbkTheme_custom_pings( $comment )
{
$GLOBALS['comment'] = $comment;
?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo comment_author_link(); ?></li>
<?php 
}
add_filter( 'get_comments_number', 'sbkTheme_comments_number' );
function sbkTheme_comments_number( $count )
{
if ( !is_admin() ) {
global $id;
$comments_by_type = &separate_comments( get_comments( 'status=approve&post_id=' . $id ) );
return count( $comments_by_type['comment'] );
} else {
return $count;
}
}

// ------------------------------------------------
//clean up the header by http://www.themelab.com/remove-code-wordpress-header/
// ------------------------------------------------

	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wlwmanifest_link');
	remove_action('wp_head', 'wp_generator');
	remove_action('wp_head', 'start_post_rel_link');
	remove_action('wp_head', 'index_rel_link');
	remove_action('wp_head', 'adjacent_posts_rel_link');

// ------------------------------------------------
// Custom Gallery Markup
// ------------------------------------------------

add_filter('post_gallery','customFormatGallery',10,2);

function customFormatGallery($string,$attr){

    $output = "<div id=\"gallery\">";
    $posts = get_posts(array('include' => $attr['ids'],'post_type' => 'attachment'));

    foreach($posts as $imagePost){
        // Fetch all data related to attachment 
        $img = wp_prepare_attachment_for_js($imagePost);
        // Store the caption
        $caption = $img['caption'];

        $output .= "<div class='gallery_image-container'>";
        // $output .= "<img src='".wp_get_attachment_image_src($imagePost->ID, 'small')[0]."'>";
        //  $output .= "<img src='".wp_get_attachment_image_src($imagePost->ID, 'medium')[0]."' data-media=\"(min-width: 400px)\">";
        $output .= "<img class='gallery_image' src='".wp_get_attachment_image_src($imagePost->ID, 'large')[0]."' data-media=\"(min-width: 950px)\">";
        //  $output .= "<img src='".wp_get_attachment_image_src($imagePost->ID, 'extralarge')[0]."' data-media=\"(min-width: 1200px)\">";
        // Output the caption if it exists
        if ($caption) { 
            $output .= "<div class=\"gallery_image-caption\"><span>{$caption}</span></div>\n";
        }
        $output .= "</div>";
    }

    $output .= "</div>";

    return $output;
}

// -----------
// Add thumbnail sizes
// ------------
add_theme_support( 'post-thumbnails' );
add_image_size( 'gallery-size', 1500, 1000 );

// ------------------------------------------------
/**
 * Get the CMB2 bootstrap! 
 */
// ------------------------------------------------

if ( file_exists( dirname( __FILE__ ) . '/cmb2/init.php' ) ) {
    require_once dirname( __FILE__ ) . '/cmb2/init.php';
} elseif ( file_exists( dirname( __FILE__ ) . '/CMB2/init.php' ) ) {
    require_once dirname( __FILE__ ) . '/CMB2/init.php';
}   

// ------------------------------------------------
// Adding my own CSS to the backend to overwrite stuff here
// ------------------------------------------------

function cmb2_override_styles() {
   echo '<link rel="stylesheet" href="'. get_template_directory_uri().'/assets/cmb2overrides.css" type="text/css" media="all">';
}

add_action('admin_head', 'cmb2_override_styles');


// ------------------------------------------------
// Start: Front Page Headline Field (don't want to use 'Front page')
// ------------------------------------------------

add_action( 'cmb2_admin_init', 'frontpage_metabox_function' );
/**
 * Define the metabox and field configurations.
 */
function frontpage_metabox_function() {

    // Start with an underscore to hide fields from custom fields list
    $prefix = '_frontpage_meta_';

    /**
     * Initiate the metabox
     */
    $cmb = new_cmb2_box( array(
        'id'            => 'frontpage_metabox',
        'title'         => __( 'Frontpage', 'cmb2' ),
        'object_types'  => array( 'page'), // Post type 
        'priority'      => 'after_title',
        'show_on'      => array( 'key' => 'page-template', 'value' => 'template-frontPage.php' ), 
    ) );

    // Regular text field
    $cmb->add_field( array(
        'name'       => __( 'Headline', 'cmb2' ),
        'desc'       => __( 'Enter the headline to appear on the frontpage', 'cmb2' ),
        'id'         => $prefix . 'headline',
        'type'       => 'text',      
    ) );
}

// Displaying the headline field before the Editor

function frontpage_header_output_custom_mb_location() {
    $cmb = cmb2_get_metabox( 'frontpage_metabox' );

    if ( in_array( get_page_template_slug(), $cmb->prop( 'show_on' ), 1 ) ) {
     $cmb->show_form();
    }
}
add_action( 'edit_form_after_title', 'frontpage_header_output_custom_mb_location' );

// ------------------------------------------------
// Start: Front Page 3 Column layout for categories
// ------------------------------------------------

add_action( 'cmb2_admin_init', 'home_categoryintro_register_field_metabox' );
/** hook in and add a metabox with grouped fields */

function home_categoryintro_register_field_metabox() {
    $prefix = '_homecategoryinfo_';

    // Repeatable group field
    $cmb_categoryintro = new_cmb2_box( array(
        'id'            => $prefix . 'metabox',
        'title'         => esc_html__('Category intro', 'cmb2'),
        'object_types'  => array( 'page', ), // Post type
        'show_on'      => array( 'key' => 'page-template', 'value' => 'template-frontPage.php' ),        
    ) );

    $cmb_categoryintro->add_field( array(
        'name'    => esc_html__( 'Category 1 intro text', 'cmb2' ),
        'id'      => 'homecategoryinfo1_content',
        'type'    => 'wysiwyg',
        'options' => array( 
            'textarea_rows' => 10, 
        ),
    ) );
    $cmb_categoryintro->add_field( array(
        'name'    => esc_html__( 'Category 2 intro text', 'cmb2' ),
        'id'      => 'homecategoryinfo2_content',
        'type'    => 'wysiwyg',
        'options' => array( 
            'textarea_rows' => 10, 
        ),
    ) );
    $cmb_categoryintro->add_field( array(
        'name'    => esc_html__( 'Category 3 intro text', 'cmb2' ),
        'id'      => 'homecategoryinfo3_content',
        'type'    => 'wysiwyg',
        'options' => array( 
            'textarea_rows' => 10, 
        ),
    ) );

}

// ------------------------------------------------------------
// Start: Fact sheet for Casestudies
// ------------------------------------------------------------

// Callback for 'Show only for certain categories')
function sbk_hide_if_no_case( $field ) {
    if ( ! has_category( array('office', 'residential', 'retail'), $field->object_id ) ) {
        return false;
    }
    return true;
}

// Manually render the casefact field rows so they appear next to each other.
function casefacts_render_row_cb( $field_args, $field ) {
    $id          = $field->args( 'id' );
    $label       = $field->args( 'name' );
    $name        = $field->args( '_name' );
    $value       = $field->escaped_value();
    $description = $field->args( 'description' );
    ?>
    <div class="casefacts-row">
        <label for="<?php echo $id; ?>"><strong><?php echo $label; ?></strong> <em>(<?php echo $description; ?>)</em></label>
        <input id="<?php echo $id; ?>" type="text" name="<?php echo $name; ?>" value="<?php echo $value; ?>" />
    </div>
    <?php
}


add_action( 'cmb2_admin_init', 'casefacts_register_repeatable_group_field_metabox' );
/**
 * Hook in and add a metabox with repeatable grouped fields
 */
function casefacts_register_repeatable_group_field_metabox() {
    $prefix = '_casefacts_group_';

    /**
     * Repeatable Field Groups
     */
    $cmb_group = new_cmb2_box( array(
        'id'           => $prefix . 'metabox',
        'title'        => esc_html__( 'Fact Sheet', 'cmb2' ),
        'object_types' => array( 'post', ),
        'show_on_cb' => 'sbk_hide_if_no_case',
    ) );

    // $group_field_id is the field id string, so in this case: $prefix . 'demo'
    $group_field_id = $cmb_group->add_field( array(
        'id'          => $prefix . 'demo',
        'type'        => 'group',
        'options'     => array(
            'group_title'   => esc_html__( 'Fact {#}', 'cmb2' ), // {#} gets replaced by row number
            'add_button'    => esc_html__( 'Add Another Fact', 'cmb2' ),
            'remove_button' => esc_html__( 'Remove Entry', 'cmb2' ),
            'sortable'      => true, // beta
            // 'closed'     => true, // true to have the groups closed by default
        ),
    ) );

    /**
     * Group fields works the same, except ids only need
     * to be unique to the group. Prefix is not needed.
     *
     * The parent field's id needs to be passed as the first argument.
     */
    $cmb_group->add_group_field( $group_field_id, array(
        'name'          => esc_html__( 'Fact', 'cmb2' ),
        'description'   => esc_html__( 'e.g. Budget', 'cmb2' ),
        'id'            => 'factname',
        'type'          => 'text',
        'render_row_cb' => 'casefacts_render_row_cb',
    ) );

    $cmb_group->add_group_field( $group_field_id, array(
        'name' => esc_html__( 'Value', 'cmb2' ),
        'description'=> esc_html__( 'e.g. smell of a slightly oily rag', 'cmb2' ),
        'id'   => 'factvalue',
        'type' => 'text',
        'render_row_cb' => 'casefacts_render_row_cb',
    ) );
}

// ------------------------------------------------------------
// Start: Client Block
// ------------------------------------------------------------

add_action( 'cmb2_admin_init', 'client_register_field_metabox' );
/** hook in and add a metabox with grouped fields */

function client_register_field_metabox() {
    $prefix = '_client_';

    // Repeatable group field
    $cmb_client = new_cmb2_box( array(
        'id'            => $prefix . 'metabox',
        'title'         => esc_html__('Meet the Client', 'cmb2'),
        'object_types'  => array( 'post', ),        
    ) );


    $cmb_client->add_field( array(
        'name'          => esc_html__( 'Headline', 'cmb2' ),
        'id'            => 'client_headline',
        'type'          => 'text',        
        'attributes'  => array(
            'placeholder' => esc_html__( 'e.g. "Meet Superhero Henk Hamsterweek"', 'cmb2' ),
        ),
    ) );

    $cmb_client->add_field( array(
        'name'          => esc_html__( 'Client Image', 'cmb2' ),
        'id'            => 'client_image',
        'type'          => 'file',        
        'preview_size' => array( 100, 100 ),
    ) );

    $cmb_client->add_field( array(
        'name'    => esc_html__( 'Client text', 'cmb2' ),
        'id'      => 'client_content',
        'type'    => 'wysiwyg',
        'options' => array( 
            'textarea_rows' => 5, 
        ),
    ) );

}

// ------------------------------------------------------------
// Start: Brief Block
// ------------------------------------------------------------

add_action( 'cmb2_admin_init', 'brief_register_field_metabox' );
/** hook in and add a metabox with grouped fields */

function brief_register_field_metabox() {
    $prefix = '_brief_';

    // Repeatable group field
    $cmb_brief = new_cmb2_box( array(
        'id'            => $prefix . 'metabox',
        'title'         => esc_html__('The brief', 'cmb2'),
        'object_types'  => array( 'post', ),        
    ) );


    $cmb_brief->add_field( array(
        'name'          => esc_html__( 'Brief Headline', 'cmb2' ),
        'id'            => 'brief_headline',
        'type'          => 'text',        
        'attributes'  => array(
            'placeholder' => esc_html__( 'e.g. "My brief: do it but do it quietly"', 'cmb2' ),
        ),
    ) );

    $cmb_brief->add_field( array(
        'name'    => esc_html__( 'Brief text', 'cmb2' ),
        'id'      => 'brief_content',
        'type'    => 'wysiwyg',
        'options' => array( 
            'textarea_rows' => 5, 
        ),
    ) );

}

// ------------------------------------------------------------
// Start: approach Block
// ------------------------------------------------------------

add_action( 'cmb2_admin_init', 'approach_register_field_metabox' );
/** hook in and add a metabox with grouped fields */

function approach_register_field_metabox() {
    $prefix = '_approach_';

    // Repeatable group field
    $cmb_approach = new_cmb2_box( array(
        'id'            => $prefix . 'metabox',
        'title'         => esc_html__('My approach', 'cmb2'),
        'object_types'  => array( 'post', ),        
    ) );


    $cmb_approach->add_field( array(
        'name'          => esc_html__( 'My Approach Headline', 'cmb2' ),
        'id'            => 'approach_headline',
        'type'          => 'text',        
        'attributes'  => array(
            'placeholder' => esc_html__( 'e.g. "My approach: Run"', 'cmb2' ),
        ),
    ) );

    $cmb_approach->add_field( array(
        'name'    => esc_html__( 'approach text', 'cmb2' ),
        'id'      => 'approach_content',
        'type'    => 'wysiwyg',
        'options' => array( 
            'textarea_rows' => 5, 
        ),
    ) );

}

// ------------------------------------------------------------
// Start: result Block
// ------------------------------------------------------------

add_action( 'cmb2_admin_init', 'result_register_field_metabox' );
/** hook in and add a metabox with grouped fields */

function result_register_field_metabox() {
    $prefix = '_result_';

    // Repeatable group field
    $cmb_result = new_cmb2_box( array(
        'id'            => $prefix . 'metabox',
        'title'         => esc_html__('The result', 'cmb2'),
        'object_types'  => array( 'post', ),        
    ) );


    $cmb_result->add_field( array(
        'name'          => esc_html__( 'The result Headline', 'cmb2' ),
        'id'            => 'result_headline',
        'type'          => 'text',        
        'attributes'  => array(
            'placeholder' => esc_html__( 'e.g. "Mission accomplished: Everybody happy "', 'cmb2' ),
        ),
    ) );

    $cmb_result->add_field( array(
        'name'    => esc_html__( 'result text', 'cmb2' ),
        'id'      => 'result_content',
        'type'    => 'wysiwyg',
        'options' => array( 
            'textarea_rows' => 5, 
        ),
    ) );

}

// ------------------------------------------------------------
// Start: Contact Me Block
// ------------------------------------------------------------

add_action( 'cmb2_admin_init', 'cta_register_field_metabox' );
/** hook in and add a metabox with grouped fields */

function cta_register_field_metabox() {
    $prefix = '_cta_';

    // Repeatable group field
    $cmb_cta = new_cmb2_box( array(
        'id'            => $prefix . 'metabox',
        'title'         => esc_html__('The Call to action', 'cmb2'),
        'object_types'  => array( 'post', ),        
    ) );


    $cmb_cta->add_field( array(
        'name'          => esc_html__( 'The CTA Headline', 'cmb2' ),
        'id'            => 'cta_headline',
        'type'          => 'text',        
        'attributes'  => array(
            'value' => esc_html__( 'Do you have a project?', 'cmb2' ),
        ),
    ) );

    $cmb_cta->add_field( array(
        'name'    => esc_html__( 'CTA rich content', 'cmb2' ),
        'id'      => 'cta_content',
        'type'    => 'wysiwyg',
        'options' => array( 
            'textarea_rows' => 5, 
        ),
        'attributes'  => array(
            'value' => esc_html__( "Or do you know someone who would be interested? Please don't hesitate to contact us and we'll chat about what we can do for you!", 'cmb2' ),
        ),
    ) );

    $cmb_cta->add_field( array(
        'name'          => esc_html__( 'The CTA button text', 'cmb2' ),
        'id'            => 'cta_button_text',
        'type'          => 'text',        
        'attributes'  => array(
            'value' => esc_html__( 'Get in touch', 'cmb2' ),
        ),
    ) );

    $cmb_cta->add_field( array(
        'name'          => esc_html__( 'The CTA button link', 'cmb2' ),
        'id'            => 'cta_button_link',
        'type'          => 'text_url',        
        'attributes'  => array(
            'value' => esc_html__( 'mailto:simon@simonbushking.com', 'cmb2' ),
        ),
    ) );

}

// ------------------------------------------------------------
// Start: Gallery Block
// ------------------------------------------------------------

add_action( 'cmb2_admin_init', 'gallery_register_field_metabox' );
/** hook in and add a metabox with grouped fields */

function gallery_register_field_metabox() {
    $prefix = '_gallery_';

    // Repeatable group field
    $cmb_gallery = new_cmb2_box( array(
        'id'            => $prefix . 'metabox',
        'title'         => esc_html__('Image gallery', 'cmb2'),
        'object_types'  => array( 'post', 'page'),                
    ) );

    $cmb_gallery->add_field( array(
        'name'         => esc_html__( 'Multiple Files', 'cmb2' ),
        'desc'         => esc_html__( 'Upload or add multiple images/attachments.', 'cmb2' ),
        'id'           => $prefix . 'file_list',
        'type'         => 'file_list',
        'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
    ) );

}

function wp_get_attachment( $attachment_id ) {

    $attachment = get_post( $attachment_id );
    return array(
        'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
        'caption' => $attachment->post_excerpt,
        'description' => $attachment->post_content,
        'href' => get_permalink( $attachment->ID ),
        'src' => $attachment->guid,
        'title' => $attachment->post_title
    );
}

/**
 * Sample template tag function for outputting a cmb2 file_list
 *
 * @param  string  $file_list_meta_key The field meta key. ('wiki_test_file_list')
 * @param  string  $img_size           Size of image to show
 */
function cmb2_output_file_list( $file_list_meta_key, $img_size = 'gallery-size' ) {

    // Get the list of files
    $files = get_post_meta( get_the_ID(), $file_list_meta_key, 1 );

    echo '<div class="file-list-wrap">';
    // Loop through them and output an image
    foreach ( (array) $files as $attachment_id => $attachment_url ) {
        echo '<div class="slide">
              <div class="cover">';
        echo wp_get_attachment_image( $attachment_id, $img_size, "", ["class" => "casestudy_gallery_image cover"] );
        $img_id =  wp_get_attachment( $attachment_id );
        echo '<div class="casestudy_gallery_caption">' . $img_id['caption'] . '</div>'; 
        echo '</div>
              </div>';
    }
    echo '</div>';
}

// ------------------------------------------------------------
// Start: Category Rich content
// ------------------------------------------------------------

add_action( 'cmb2_admin_init', 'categorycontent_register_taxonomy_metabox' );

function categorycontent_register_taxonomy_metabox() {
    $prefix = '_categorycontent_term_';       

    $cmb_term = new_cmb2_box( array(
        'id'               => $prefix . 'edit',
        'object_types'     => array( 'term' ), // Tells CMB2 to use term_meta vs post_meta
        'taxonomies'       => array( 'category', 'post_tag'), // Tells CMB2 which taxonomies should have these fields
        // 'new_term_section' => true, // Will display in the "Add New Category" section
    ) );

    $cmb_term->add_field( array(
        'name' => esc_html__( 'Term Image', 'cmb2' ),
        'desc' => esc_html__( 'field description (optional)', 'cmb2' ),
        'id'   => $prefix . 'avatar',
        'type' => 'file',
    ) );

    $cmb_term->add_field( array(
        'name'       => __('Excerpt', 'default'),           
        'id'       => $prefix . 'excerpt',
        'type'     => 'wysiwyg',
        'on_front' => false,
    ) );
}

// -------------------------------------------
// Start: Hide main content editor on home
// Disabled for the moment
// -------------------------------------------

/*add_action( 'admin_head', 'hide_editor' );

function hide_editor() {
    global $pagenow;
    if( !( 'post.php' == $pagenow ) ) return;

    global $post;
    // Get the Post ID.
    $post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;
    if( !isset( $post_id ) ) return;

  // Hide the editor on the page titled 'Homepage'
  $homepgname = get_the_title($post_id);
  if($homepgname == 'Home'){ 
    remove_post_type_support('page', 'editor');
  }

  // Hide the editor on a page with a specific page template
  // Get the name of the Page Template file.
  $template_file = get_post_meta($post_id, '_wp_page_template', true);

  if($template_file == 'my-page-template.php'){ // the filename of the page template
    remove_post_type_support('page', 'editor');
  }
}*/
