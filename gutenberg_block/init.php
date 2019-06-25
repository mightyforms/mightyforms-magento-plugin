<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/**
 * @author DemonIa sanchoclo@gmail.com
 * @function mightyforms_register_block
 * @description Needed for including .js and .css files of Gutenberg plugin
 * @param
 * @return void
 */

function mightyforms_register_block()
{
    wp_register_script(
        'mightyforms_script_editor',
        plugins_url() . '/mightyforms/gutenberg_block/mightyforms_block/blocks.build.js',
//        plugins_url() . '/mightyforms/gutenberg_source_code/dist/blocks.build.js',
        array('wp-blocks', 'wp-element', 'wp-components')
    );

    wp_register_style(
        'mightyforms_style_editor',
        plugins_url() . '/mightyforms/gutenberg_block/mightyforms_block/style_editor.css',
        array('wp-edit-blocks')
    );

    register_block_type('mf/form-block', array(
        'editor_script' => 'mightyforms_script_editor',
        'editor_style' => 'mightyforms_style_editor',
        'style' => 'mightyforms_style'
    ));
}

add_action('init', 'mightyforms_register_block');

/**
 * @author DemonIa sanchoclo@gmail.com
 * @function pass_params_to_wp_admin
 * @description In this way, I've pass variables from php to js.
 * @param
 * @return void
 */
function pass_params_to_wp_admin(){

    wp_localize_script('mightyforms_script_editor', 'backendData', [
        'gutenbergPluginRootFolder' => plugin_dir_url(__DIR__) . 'images/gutenberg_icon.png',
        'mightyformsApiKey' => get_option('mightyforms_api_key') ? get_option('mightyforms_api_key') : null,
        'settingPageUrl' => get_admin_url(null, 'admin.php?page=mightyforms-settings')
    ]);

}

add_action('admin_print_scripts', 'pass_params_to_wp_admin');