<?php
// This function enqueues the Normalize.css for use. The first parameter is a name for the stylesheet, the second is the URL. Here we
// use an online version of the css file.
add_theme_support( 'post-thumbnails' );


function add_normalize_CSS() {
   wp_enqueue_style( 'normalize-styles', "https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css");
}
add_action('wp_enqueue_scripts', 'add_normalize_CSS');


// Register a new navigation menu
function add_Main_Nav() {
    register_nav_menu('header-menu',__( 'Header Menu' ));
  }
  // Hook to the init action hook, run our navigation menu function
  add_action( 'init', 'add_Main_Nav' );


// Enqueue custom js and css for travelpia test 
function travelopia_test_scripts() {
  wp_enqueue_style('travelopia-css', get_bloginfo('template_directory').'/custom.css');
	wp_enqueue_script( 'travelopia-script', get_stylesheet_directory_uri() . '/js/custom.js', array( 'jquery' ) );
}
add_action( 'wp_enqueue_scripts', 'travelopia_test_scripts' );


/* Author : Nasir Khan
*  Description : Function to create custom field under post
*
*/

   
function character_add_meta_box( $post ){
   add_meta_box( 'character_meta_box', 'Custom Field', 'character_build_meta_box', 'character', 'normal', 'low' );
}
add_action( 'add_meta_boxes_character', 'character_add_meta_box' );

function character_build_meta_box( $post ){
   wp_nonce_field( basename( __FILE__ ), 'character_meta_box_nonce' );
   $id_custom_field = get_post_meta( $post->ID, 'ID', true); ?> 
   <div id="postcustom" class="postbox ">
   <div class="postbox-header"><h2 class="hndle ui-sortable-handle">ID</h2>
   <div class='inside'>
   <textarea id="metavalue" name="id_custom_field" rows="2" cols="25"><?php echo $id_custom_field; ?></textarea>
   </div>
   </div>
 </div>
<?php }


function character_save_meta_box_data( $post_id ){
 if ( !isset( $_POST['character_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['character_meta_box_nonce'], basename( __FILE__ ) ) ){
   return;
 }

 if ( isset( $_REQUEST['id_custom_field'] ) ) {
   update_post_meta( $post_id, 'ID', sanitize_text_field( $_POST['id_custom_field'] ) );
 }
}
add_action( 'save_post_character', 'character_save_meta_box_data', 10, 2 );