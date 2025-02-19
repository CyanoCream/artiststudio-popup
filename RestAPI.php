<?php
namespace Artistudio\Popup;

class RestAPI {
    public function registerRoutes() {
        register_rest_route('artistudio/v1', '/popup', [
            'methods' => 'GET',
            'callback' => [$this, 'getPopups'],
            'permission_callback' => [$this, 'checkPermission']
        ]);
    }
    
    public function checkPermission() {
        return is_user_logged_in();
    }
    
    public function getPopups(\WP_REST_Request $request) {
        $posts = get_posts([
            'post_type' => 'popup',
            'posts_per_page' => -1
        ]);
        
        $data = array_map(function($post) {
            return [
                'id' => $post->ID,
                'title' => $post->post_title,
                'content' => $post->post_content,
                'page' => get_post_meta($post->ID, 'popup_page', true)
            ];
        }, $posts);
        
        return rest_ensure_response($data);
    }
}