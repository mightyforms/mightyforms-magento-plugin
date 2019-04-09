<?php

/*
    Plugin Name: MightyForms
    Description: Create online forms and surveys like never before.
    Version: 1.0
    Author: MightyForm Corp.
    Author URI: http://dkrok.com

     Copyright 2019 MightyForm Corp. (email: E-MAIL_АВТОРА)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

require_once('functions.php');
require_once('shortcode.php');
require_once('assets.php');
require_once('views/application.php');
require_once('views/settings.php');
require_once('views/forms.php');

// Set plugin label in main WordPress menu
add_action('admin_menu', 'mightyforms_register_admin_settings');

/**
 * @author DemonIa sanchoclo@gmail.com
 * @function mightyforms_register_admin_settings
 * @description Register menu and submenu items in Wordpress.
 * @param
 * @returns void
 */
function mightyforms_register_admin_settings()
{
    add_menu_page('MightyForms', 'MightyForms', 'manage_options', 'mightyforms', 'run_mightyforms_application', plugins_url('/images/icon.png', __FILE__), 6);

    add_submenu_page('mightyforms', 'My forms', 'My forms', 'manage_options', 'mightyforms-forms', 'run_mightyforms_forms');

    add_submenu_page('mightyforms', 'Settings', 'Settings', 'manage_options', 'mightyforms-settings', 'run_mightyforms_settings');
}

/**
 * @author DemonIa sanchoclo@gmail.com
 * @function garbage_collector
 * @description Remove user api key after plugin was uninstalled.
 * @param
 * @returns void
 */
function garbage_collector()
{
    delete_option('mightyforms_api_key');
}

register_uninstall_hook(__FILE__, 'garbage_collector');

