<?php
/*
  Plugin Name: 1.0.0 - F3A Competitions
  Description: Displays and manages F3A competitiopns
  Version: 1.0.0
  Contributors: Peaceful
  Author: Zsolt Baksa
  Author URI: http://peaceful.hu
  License: GPLv2 or later
  Text Domain: wpplugin
 */

if (!defined('WPINC')) {
    die;
}
include_once plugin_dir_path(__FILE__) . 'init.inc';

function competitions_settings_page() {
    add_menu_page(
            'Versenyek beállításai', 'Versenyek', 'manage_options', 'competitions', 'competitions_settings_page_markup', 'dashicons-admin-generic', 100
    );
}

function competitions_settings_page_markup() {
    // Double check user capabilities
    if (!current_user_can('manage_options')) {
        return;
    }
    if (isset($_POST["save_options"])) {
        add_option(SETTING_OPTION1, $_POST["settings_chk_1"], '', 'yes');
        update_option(SETTING_OPTION1, $_POST["settings_chk_1"], 'yes');
    }
    ?>
    <div class="wrap">
        <h1><?php
            esc_html_e(get_admin_page_title());
            $chk_1 = (get_option(SETTING_OPTION1, '') == 'on') ? 'checked' : '';
            ?></h1>
        <p>
        <form method="POST">
            <label>Opcio 1:</label><input type="checkbox" <?php $chk_1 ?>name="settings_chk_1">
            <br>
            <input type="submit" name="save_options" value="Mentés">
        </form>
        <?php
//        esc_html_e($output, 'competitions');
        ?></p>
    </div>
    <?php
}

add_action('admin_menu', 'competitions_settings_page');
