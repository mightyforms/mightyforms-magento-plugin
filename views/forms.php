<?php
/**
 * Created by PhpStorm.
 * User: Sanchoss
 * Date: 2019-04-08
 * Time: 20:22
 */

function run_mightyforms_forms()
{


    $redirect_url = get_admin_url(null, 'admin.php?page=mightyforms-settings');

    $raw_user_forms = RemotePageGet('https://dev.mightyforms.com/api/v1/' . get_option('mightyforms_api_key') . '/forms', '', false, '');

    $user_forms = json_decode($raw_user_forms, true);

    ?>

    <div class="mf-main-block">
        <div class="row mf-header">
            <div class="container">
                <img src="https://dev.mightyforms.com/dist/assets/img/logo.svg">
            </div>
        </div>

        <div class="forms-box container">

        <?php

        if (!$user_forms['success']) {

            echo '<h4>You have not set your API key or your key is incorrect. Go to <a href="' . $redirect_url . '">settings</a></h4>';

        } elseif (isset($user_forms) && $user_forms['success'] && count($user_forms['data']) < 1) {

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
                        <td> <?= isset($forms['last_modified_username']) ? $forms['last_modified_username'] : '' ?></td>
                        <td> <?= isset($forms['last_modified']) ? $forms['last_modified'] : '' ?></td>
                    </tr>
                    <?php
                } ?>

                </tbody>
            </table>
            </div>
        </div>

        <?php
    }
}