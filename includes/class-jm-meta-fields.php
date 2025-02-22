<?php
class JM_Meta_Fields {
    public static function add_meta_boxes() {
        add_meta_box('jm_job_details', 'Job Details', [__CLASS__, 'job_fields_callback'], 'jobs', 'normal', 'high');
    }

    public static function job_fields_callback($post) {
        wp_nonce_field(basename(__FILE__), 'jm_jobs_nonce');
        $jm_stored_meta = get_post_meta($post->ID);
        ?>
        <p>
            <label for="company_name">Company Name:</label>
            <input type="text" name="company_name" id="company_name" value="<?php echo esc_attr($jm_stored_meta['company_name'][0] ?? ''); ?>" style="width:100%;" />
        </p>
        <p>
            <label for="location">Location:</label>
            <input type="text" name="location" id="location" value="<?php echo esc_attr($jm_stored_meta['location'][0] ?? ''); ?>" style="width:100%;" />
        </p>
        <p>
            <label for="salary">Salary:</label>
            <input type="text" name="salary" id="salary" value="<?php echo esc_attr($jm_stored_meta['salary'][0] ?? get_option('jm_default_salary', '')); ?>" style="width:100%;" />
        </p>
        <?php
    }

    public static function save_meta_fields($post_id) {
        if (!isset($_POST['jm_jobs_nonce']) || !wp_verify_nonce($_POST['jm_jobs_nonce'], basename(__FILE__))) {
            return;
        }
        update_post_meta($post_id, 'company_name', sanitize_text_field($_POST['company_name'] ?? ''));
        update_post_meta($post_id, 'location', sanitize_text_field($_POST['location'] ?? ''));
        update_post_meta($post_id, 'salary', sanitize_text_field($_POST['salary'] ?? ''));
    }
}
