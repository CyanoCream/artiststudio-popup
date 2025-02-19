<?php
/**
 * Plugin Name: Artistudio Popup
 * Description: Custom popup plugin with React frontend
 * Version: 1.0.0
 * Author: Your Name
 * Text Domain: artistudio-popup
 */

namespace Artistudio\Popup;

if (!defined('ABSPATH')) exit;

class Plugin {
    private static $instance = null;
    
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    private function __construct() {
        $this->defineConstants();
        $this->initHooks();
    }
    
    private function defineConstants() {
        define('ARTISTUDIO_POPUP_VERSION', '1.0.0');
        define('ARTISTUDIO_POPUP_PATH', plugin_dir_path(__FILE__));
        define('ARTISTUDIO_POPUP_URL', plugin_dir_url(__FILE__));
    }
    
    private function initHooks() {
        add_action('init', [$this, 'registerPostType']);
        add_action('rest_api_init', [$this, 'registerRestRoutes']);
        add_action('wp_enqueue_scripts', [$this, 'enqueueScripts']);
    }
    
    public function registerPostType() {
        register_post_type('popup', [
            'labels' => [
                'name' => 'Pop Ups',
                'singular_name' => 'Pop Up'
            ],
            'public' => true,
            'has_archive' => false,
            'supports' => ['title', 'editor'],
            'show_in_rest' => true
        ]);
        
        // Register custom fields
        register_meta('post', 'popup_page', [
            'type' => 'string',
            'single' => true,
            'show_in_rest' => true
        ]);
    }
    public function registerRestRoutes() {
        require_once plugin_dir_path(__FILE__) . 'RestAPI.php';
        $api = new Artistudio\Popup\RestAPI();
        $api->registerRoutes();
    }
    public function enqueueScripts() {
        wp_enqueue_script('artistudio-popup-script', plugins_url('frontend/dist/popup.bundle.js', __FILE__), [], ARTISTUDIO_POPUP_VERSION, true);
    }
    
}

// Initialize plugin
Plugin::getInstance();