<?php
/**
 * Plugin Name: Fancy Jobs Manager
 * Description: A custom plugin to manage job listings.
 * Version: 1.9
 * Author: Tanjil Rashid
 */

if (!defined('ABSPATH')) {
    exit;
}

// Include required files
require_once plugin_dir_path(__FILE__) . 'includes/class-jm-cpt.php';
require_once plugin_dir_path(__FILE__) . 'includes/class-jm-meta-fields.php';
require_once plugin_dir_path(__FILE__) . 'includes/class-jm-shortcodes.php';
require_once plugin_dir_path(__FILE__) . 'includes/class-jm-settings.php';

class JobsManager {
    public function __construct() {
        $this->init_hooks();
    }

    private function init_hooks() {
        add_action('init', ['JM_CPT', 'register_jobs_cpt']);
        add_action('add_meta_boxes', ['JM_Meta_Fields', 'add_meta_boxes']);
        add_action('save_post', ['JM_Meta_Fields', 'save_meta_fields']);
        add_shortcode('job_listings', ['JM_Shortcodes', 'display_jobs']);
        add_action('admin_init', ['JM_Settings', 'register_settings']);
        add_action('admin_menu', ['JM_Settings', 'settings_page']);
        add_action('wp_enqueue_scripts', [$this, 'jm_enqueue_assets']);
        add_filter('single_template', [$this, 'jm_load_single_job_template']);
        add_filter('archive_template', [$this, 'jm_load_archive_job_template']);
    }

    public function jm_enqueue_assets() {
        wp_enqueue_style('jm-style', plugin_dir_url(__FILE__) . 'assets/css/style.css');
        wp_enqueue_script('jm-script', plugin_dir_url(__FILE__) . 'assets/js/script.js', ['jquery'], null, true);
    
        wp_localize_script('jm-script', 'job_ajax', [
            'ajax_url' => admin_url('admin-ajax.php'),
            'security' => wp_create_nonce('jm_ajax_nonce'),
        ]);
    }

    public function jm_load_single_job_template($template) {
        if (is_singular('jobs')) {
            return plugin_dir_path(__FILE__) . 'templates/single-job.php';
        }
        return $template;
    }

    public function jm_load_archive_job_template($template) {
        if (is_post_type_archive('jobs')) {
            return plugin_dir_path(__FILE__) . 'templates/archive-jobs.php';
        }
        return $template;
    }
}

// Initialize the plugin
new JobsManager();
