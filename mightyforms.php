<?php
/*
Plugin Name: MightyForms
Plugin URI: http://страница_с_описанием_плагина_и_его_обновлений
Description: Create online forms and surveys like never before.
Version: 1.0
Author: MightyForm Corp.
Author URI: http://dkrok.com
*/
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('functions.php');
require_once('shortcode.php');
require_once('assets.php');
require_once('settings.php');

// Set plugin label in main WordPress menu
add_action('admin_menu', 'mightyforms_register_admin_settings');

function mightyforms_register_admin_settings()
{
    add_menu_page('MightyForms', 'MightyForms', 'manage_options', 'mightyforms', 'mightyforms_admin_iframe', plugins_url('/images/icon.png', __FILE__), 6);

    add_submenu_page('mightyforms', 'Settings', 'Settings', 'manage_options', 'mightyforms-settings', 'run_mightyforms_settings');
}


function garbage_collector()
{
    delete_option('mightyforms_api_key');
}

register_uninstall_hook(__FILE__, 'garbage_collector');

function mightyforms_admin_iframe()
{
    $redirect_url = get_site_url() . '/wp-admin/admin.php?page=mightyforms-settings';

    $raw_user_forms = RemotePageGet('http://localhost:3000/api/v1/' . get_option('mightyforms_api_key') . '/forms', '', false, '');

    $user_forms = json_decode($raw_user_forms, true);

    ?>

    <div class="container mf-main-block">
        <div class="row logo-section">
            <img src="https://app.mightyforms.com/dist/assets/img/logo.svg">
        </div>
        <div class="row">
            <div class="tabs">
                <div class="application">Builder</div>
                <div class="my-forms active">My forms</div>
            </div>
        </div>

        <div class="forms-box">

            <?php

            if (!$user_forms) {
                echo '<h4>You have not set your API key </h4>';

            } elseif (isset($user_forms['error_code']) && $user_forms['error_code'] === 4) {
                echo '<h4>Looks like your API key is incorrect. Go to <a href="' . $redirect_url . '">settings</a></h4>';
            } elseif (count($user_forms['data']) < 1) {

                echo '<h4>You have not created form yet </h4>';

            } else {
                ?>

                <table id="user_forms" class="display">
                    <thead>
                    <tr>
                        <td>Form name</td>
                        <td>Shortcode</td>
                        <td>Why was latest editor?</td>
                        <td>Last modified</td>
                    </tr>
                    <h3>Your forms and shortcodes.</h3>
                    <p>If you want to show your form in page or post - just copy string in column right, and paste
                        into your visual editor. That's is!</p>
                    </thead>
                    <tbody>

                    <?php

                    foreach ($user_forms['data'] as $forms) {
                        ?>
                        <tr>
                            <td><?= $forms['project_name'] ?></td>
                            <td> [mightyforms id="<?= $forms['project_id'] ?>"]</td>
                            <td> <?= $forms['last_modified_username'] ?></td>
                            <td> <?= $forms['last_modified'] ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tr>
                    </tbody>
                </table>

                <?php
            }
            ?>
        </div>

        <div class="application-box" style="display: none;">
            <iframe id="mf" src="https://app.mightyforms.com" frameborder="0"
                    style="padding-right: 20px; width: 100%;"></iframe>
        </div>

    </div>
    </div>

    <?php
}
