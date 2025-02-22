<?php
if (!defined('ABSPATH')) {
    exit; // Prevent direct access
}

class JM_Shortcodes {
    public static function display_jobs($atts) {
        ob_start();

        $query = new WP_Query([
            'post_type'      => 'jobs',
            'posts_per_page' => 10,
            'post_status'    => 'publish',
        ]);

        if ($query->have_posts()) {
            echo '<div class="job-listings">';
            while ($query->have_posts()) {
                $query->the_post();
                include plugin_dir_path(dirname(__FILE__)) . 'templates/template-parts/job-listing.php';
            }
            echo '</div>';
        } else {
            echo '<p>No job listings available.</p>';
        }

        wp_reset_postdata();
        return ob_get_clean();
    }
}

// Register the shortcode
add_shortcode('job_listings', ['JM_Shortcodes', 'display_jobs']);
