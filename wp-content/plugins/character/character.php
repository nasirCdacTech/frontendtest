<?php
/* 

Plugin Name: Character 

Plugin URI: https://character.com/ 

Description: Plugin to create character post type and fill featured image and title by consuming API on the basis of ID 

Version: 1.0 

Author: Nasir Khan

Author URI: https://nasirkhan.com/ 

License: GPLv2 or later 

Text Domain: travelopia 

*/



/* Author : Nasir Khan
*  Description : Create character custom post type 
*
*/

function character_post_type() {
    register_post_type( 'character',
        array(
            'labels' => array(
                'name' => __( 'Character' ),
                'singular_name' => __( 'character' )
            ),
            'public' => true,
            'show_in_rest' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'custom-fields'),
        'has_archive' => true,
            'menu_position' => 5,
        'menu_icon' => 'dashicons-admin-users',
        )
    );
}
add_action( 'init', 'character_post_type' );


/**
 * Activate the plugin. ( Function for activating plugin )
 */

function pluginprefix_activate() { 
	// Trigger our function that registers the custom post type plugin.
	character_post_type(); 
	// Clear the permalinks after the post type has been registered.
	flush_rewrite_rules(); 
}
register_activation_hook( __FILE__, 'pluginprefix_activate' );


/**
 * Deactivation hook.  ( Function for deactivating plugin )
 */

function pluginprefix_deactivate() {
	// Unregister the post type, so the rules are no longer in memory.
	unregister_post_type( 'character' );
	// Clear the permalinks to remove our post type's rules from the database.
	flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'pluginprefix_deactivate' );



/* Author : Nasir Khan
*  Description : Get remote date from api 
*
*/

function get_remote_value_from_api($post_id){

    if ( get_post_type($post_id) == 'character' ) {

      $character_id = get_post_meta($post_id, 'ID', true);
	  if(isset($character_id) && $character_id != ''){

      $request = wp_remote_get( 'https://thronesapi.com/api/v2/Characters/'.$character_id );
      if( is_wp_error( $request ) ) {
	  return false; 
      }    
      
	  // To get data from API 
      $body = wp_remote_retrieve_body( $request );
      $data = json_decode( $body );
      $imageUrl = $data->imageUrl; // Featured Image Url

    
    // Update character post type
    $character_post_update = array(
        'ID'           => $post_id,
        'post_title'   => $data->fullName,
    );
    
    // Function to set featured image in post through Api image Url
    set_featured_image_from_api_image_url($imageUrl, $post_id);
  
    remove_action('save_post', 'character_update'); // To avoid infinte loop as we are using wp_update_post with save_post hook
    // Update the specified character post into the database
    wp_update_post( $character_post_update );
    add_action('save_post', 'character_update');
    }

   }

}

/* Author : Nasir Khan
*  Description : Set the featured image from api url
*
*/

function set_featured_image_from_api_image_url($url, $post_id){
	
	if ( ! filter_var($url, FILTER_VALIDATE_URL) ||  empty($post_id) ) {
		return;
	}
	
	// Add Featured Image to Post
	$image_url 		  = preg_replace('/\?.*/', '', $url); // removing query string from url & Define the image URL here
	$image_name       = basename($image_url);
	$upload_dir       = wp_upload_dir(); // Set upload folder
	$image_data       = file_get_contents($url); // Get image data
	$unique_file_name = wp_unique_filename( $upload_dir['path'], $image_name ); // Generate unique name
	$filename         = basename( $unique_file_name ); // Create image file name

	// Check folder permission and define file location
	if( wp_mkdir_p( $upload_dir['path'] ) ) {
		$file = $upload_dir['path'] . '/' . $filename;
	} else {
		$file = $upload_dir['basedir'] . '/' . $filename;
	}

	// Create the image  file on the server
	file_put_contents( $file, $image_data );

	// Check image file type
	$wp_filetype = wp_check_filetype( $filename, null );

	// Set attachment data
	$attachment = array(
		'post_mime_type' => $wp_filetype['type'],
		'post_title'     => sanitize_file_name( $filename ),
		'post_content'   => '',
		'post_status'    => 'inherit'
	);

	// Create the attachment
	$attach_id = wp_insert_attachment( $attachment, $file, $post_id );

	// Include image.php
	require_once(ABSPATH . 'wp-admin/includes/image.php');

	// Define attachment metadata
	$attach_data = wp_generate_attachment_metadata( $attach_id, $file );

	// Assign metadata to attachment
	wp_update_attachment_metadata( $attach_id, $attach_data );

	// And finally assign featured image to post
	set_post_thumbnail( $post_id, $attach_id );
}


/* Author : Nasir Khan
*  Description : Get character post type update 
*
*/

function character_update($post_id) {

	// Check to see if we are autosaving
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;

    if (wp_is_post_revision( $post_id ) ){
      // if post udpated
      get_remote_value_from_api($post_id);
    } else {
      //if is new post
	  get_remote_value_from_api($post_id);
	}
  }
add_action( 'save_post', 'character_update');

