<?php
/**
 * Created by PhpStorm.
 * User: Sanchoss
 * Date: 3/13/19
 * Time: 16:33
 */

include ('gutenberg_block/init.php');

/**
 * @author DemonIa sanchoclo@gmail.com
 * @function admin_load_assets
 * @description Needed for include plugin .js and .css files.
 * @param
 * @returns void
 */
function admin_load_assets()
{
    wp_enqueue_script('datatables_js', 'https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js');
    wp_enqueue_script('mightyforms_js', plugins_url('/js/script.js', __FILE__), array('jquery'));


    wp_enqueue_style('datatables_css', 'https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css');
    wp_enqueue_style('mightyforms_css', plugins_url('/css/style.css', __FILE__));
}

add_action('admin_enqueue_scripts', 'admin_load_assets');