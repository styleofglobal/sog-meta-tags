<?php
/**
 * Plugin Name: SOG Meta Tags
 * Description: Inserts META TAGS in frontend pages.
 * Version: 1.0
 * Author URI: https://styleofglobal.com
 */

// Function to add META TAGS to the head section of frontend pages
function default_meta_tags($tag){
        $meta_tags = array(
            'app_name' => get_option('sog_meta_application_name', 'ACME SOFTWARE ™'),
            'author_info' => get_option('sog_meta_author_info', 'KRITEK, s.r.o. - https://kritek.eu - info@kritek.eu')
        );

        return $meta_tags[$tag];
}

function sog_insert_meta_tags() {

    echo '<meta name="application-name" content="' . esc_attr(default_meta_tags('app_name')) . '">' . PHP_EOL;
    echo '<meta name="author" content="' . esc_attr(default_meta_tags('author_info')) . '">' . PHP_EOL;
}

// Hook the function to the wp_head action
add_action('wp_head', 'sog_insert_meta_tags');

// Admin Menu
function sog_menu() {
    // add_options_page('SOG Meta Tags', 'SOG Meta Tags', 'manage_options', 'sog-meta-tags', 'sog_settings_page'); if you want it under Settings menu.
    add_menu_page('SOG Meta Tags', 'SOG Meta Tags', 'manage_options', 'sog-meta-tags', 'sog_settings_page');
}
add_action('admin_menu', 'sog_menu');

// Settings Page
// Create the settings page
function sog_settings_page() {
    if (isset($_POST['sog_submit'])) {
        update_option('sog_meta_application_name', sanitize_text_field($_POST['sog_meta_application_name']));
        update_option('sog_meta_author_info', sanitize_text_field($_POST['sog_meta_author_info']));
        echo '<div class="updated"><p>Settings updated!</p></div>';
    }
    ?>
    <div class="wrap">
        <h2>SOG Meta Tags Settings</h2>
        <form method="post" action="">
            <table class="form-table">
                <tr>
                    <th scope="row"><label for="sog_meta_application_name">Application Name</label></th>
                    <td><input type="text" name="sog_meta_application_name" id="sog_meta_application_name" value="<?php echo esc_attr(default_meta_tags('app_name')); ?>" /></td>
                </tr>
                <tr>
                    <th scope="row"><label for="sog_meta_author_info">Author Info</label></th>
                    <td><input type="text" name="sog_meta_author_info" id="sog_meta_author_info" value="<?php echo esc_attr(default_meta_tags('author_info')); ?>" /></td>
                </tr>
            </table>
            <p class="submit">
                <input type="submit" name="sog_submit" id="submit" class="button button-primary" value="Save Changes" />
            </p>
        </form>
    </div>
    <?php
}
