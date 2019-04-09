<?php

/**
 * @author DemonIa sanchoclo@gmail.com
 * @function update_user_api_key
 * @description Needed for set user api key in database
 * @param
 * @returns void
 */
function set_user_api_key($api_key)
{
    global $wpdb;
    $wp_options = $wpdb->prefix . 'options';
    $wpdb->insert($wp_options, ['option_name' => 'mightyforms_api_key', 'option_value' => esc_sql($api_key)]);
}

/**
 * @author DemonIa sanchoclo@gmail.com
 * @function update_user_api_key
 * @description Needed for updating user api key in database
 * @param
 * @returns void
 */

function update_user_api_key($new_api_key)
{
    global $wpdb;
    $wp_options = $wpdb->prefix . 'options';
    $wpdb->update($wp_options, ['option_value' => esc_sql($new_api_key)], ['option_name' => 'mightyforms_api_key']);

}

/**
 * @author DemonIa sanchoclo@gmail.com
 * @function run_mightyforms_settings
 * @description <Fire when user go to "/settings" page>
 * @param
 * @returns void
 */

function run_mightyforms_settings()
{
    $new_key = isset($_POST['key']) ? $_POST['key'] : null;

    $get_user_api_key = get_option('mightyforms_api_key');

    if ($new_key !== null && strlen($new_key) > 0) {
        if ($get_user_api_key) {
            update_user_api_key($new_key);
        } else {
            set_user_api_key($new_key);
        }
        $get_user_api_key = $new_key;
    }
    ?>

    <div class="mf-main-block">
        <div class="row mf-header">
            <div class="container">
                <img src="https://dev.mightyforms.com/dist/assets/img/logo.svg">
            </div>
        </div>
        <div class="settings-page container">

            <?php

            if ($get_user_api_key) {
                ?>

                <form action="" method="post">
                    <div>This is your API key. If you reset your key on website - please, don't forget to paste here
                        your new key.
                    </div>
                    <input type="text" name="key" value="<?= $get_user_api_key ?>">
                    <input type="submit" value="Update key">
                </form>

                <?php
            } else {
                ?>

                <form action="" method="post">
                    <div>Before you start, you need to paste here your API key.</div>
                    <input type="text" name="key" value="<?= $new_key ?>">
                    <input type="submit" value="Save key">
                </form>

                <?php
            }
            ?>
        </div>
    </div>
    <?php

}