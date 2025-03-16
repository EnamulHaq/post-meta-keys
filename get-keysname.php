<?php
function get_all_custom_fields_from_post_type($post_type = 'sports') {
    // Get all posts of the specified post type
    $args = array(
        'post_type' => $post_type,
        'posts_per_page' => 1, // Get all posts
    );
    
    $posts = get_posts($args);
    $all_meta_keys = array();
    
    // Loop through each post
    foreach($posts as $post) {
        // Get all custom fields for this post
        $post_meta_keys = get_post_custom_keys($post->ID);
        
        if($post_meta_keys) {
            // Add these keys to our collection
            $all_meta_keys = array_merge($all_meta_keys, $post_meta_keys);
        }
    }
    
    // Remove duplicates
    $all_meta_keys = array_unique($all_meta_keys);
    
    // Filter out WordPress internal meta keys (optional)
    $internal_keys = array('_edit_lock', '_edit_last', '_wp_page_template', '_thumbnail_id');
    $all_meta_keys = array_diff($all_meta_keys, $internal_keys);
    
    return $all_meta_keys;
}

// Usage
$sports_custom_fields = get_all_custom_fields_from_post_type('post');
print_r($sports_custom_fields);
