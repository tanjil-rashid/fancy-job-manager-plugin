<?php
class JM_CPT {
    public static function register_jobs_cpt() {
        $labels = array(
            'name'               => 'Jobs',
            'singular_name'      => 'Job',
            'menu_name'          => 'Jobs',
            'add_new'            => 'Add New',
            'add_new_item'       => 'Add New Job',
            'edit_item'          => 'Edit Job',
            'new_item'           => 'New Job',
            'view_item'          => 'View Job',
            'search_items'       => 'Search Jobs',
            'not_found'          => 'No jobs found',
            'not_found_in_trash' => 'No jobs found in Trash',
        );

        $args = array(
            'labels'             => $labels,
            'public'             => true,
            'supports'           => array('title', 'editor'),
            'has_archive'        => true,
            'menu_position'      => 5,
            'menu_icon'          => 'dashicons-businessman',
            'show_in_rest'       => true,
        );
        register_post_type('jobs', $args);
    }
}
