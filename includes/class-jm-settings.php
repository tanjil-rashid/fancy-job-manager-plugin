<?php
class JM_Settings {
    public static function register_settings() {
        add_option('jm_default_salary', '');
        register_setting('jm_settings_group', 'jm_default_salary');
    }

    public static function settings_page() {
        add_menu_page('Jobs Settings', 'Jobs Settings', 'manage_options', 'jm_settings', [__CLASS__, 'settings_page_html']);
    }

    public static function settings_page_html() {
        ?>
        <div class="wrap">
            <h1>Job Manager Settings</h1>
            <form method="post" action="options.php">
                <?php settings_fields('jm_settings_group'); ?>
                <table class="form-table">
                    <tr valign="top">
                        <th scope="row">Default Salary:</th>
                        <td><input type="text" name="jm_default_salary" value="<?php echo get_option('jm_default_salary', ''); ?>" /></td>
                    </tr>
                </table>
                <?php submit_button(); ?>
            </form>
        </div>
        <?php
    }
}
