<?php
class JM_AJAX {
    public static function init() {
        add_action('wp_ajax_filter_jobs', [__CLASS__, 'filter_jobs']);
        add_action('wp_ajax_nopriv_filter_jobs', [__CLASS__, 'filter_jobs']);
    }

    public static function filter_jobs() {
        check_ajax_referer('jm_ajax_nonce', 'security');

        $company  = sanitize_text_field($_POST['company'] ?? '');
        $location = sanitize_text_field($_POST['location'] ?? '');

        $args = [
            'post_type'      => 'jobs',
            'posts_per_page' => 10,
            'meta_query'     => [],
        ];

        if (!empty($company)) {
            $args['meta_query'][] = [
                'key'     => 'company_name',
                'value'   => $company,
                'compare' => 'LIKE',
            ];
        }

        if (!empty($location)) {
            $args['meta_query'][] = [
                'key'     => 'location',
                'value'   => $location,
                'compare' => 'LIKE',
            ];
        }

        $query = new WP_Query($args);

        ob_start();
        if ($query->have_posts()) :
            while ($query->have_posts()) :
                $query->the_post();
                get_template_part('templates/job-listing');
            endwhile;
        else :
            echo '<p>No jobs found.</p>';
        endif;

        wp_reset_postdata();
        echo ob_get_clean();
        die();
    }
}

JM_AJAX::init();
