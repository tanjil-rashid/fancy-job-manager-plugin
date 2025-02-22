<?php
// If uninstall is not called from WordPress, exit.
if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

// Delete plugin options
delete_option('jm_default_salary');

// Delete all job listings (optional)
$jobs = get_posts(array(
    'post_type'      => 'jobs',
    'numberposts'    => -1,
    'post_status'    => 'any'
));

if (!empty($jobs)) {
    foreach ($jobs as $job) {
        wp_delete_post($job->ID, true);
    }
}

// Clean up orphaned meta data (optional)
global $wpdb;
$wpdb->query("DELETE FROM $wpdb->postmeta WHERE meta_key IN ('company_name', 'location', 'salary')");
