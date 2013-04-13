<?php
/*
   Plugin Name: HooplaNow Events Tools
   Plugin URI: http://wordpress.org/extend/plugins/hooplanow-events-tools/
   Version: 0.1
   Author: <a href="https://twitter.com/stillatmylinux">StillAtMyLinux</a>
   Description: Add a widget to subscribe to events, shortcode to list events
   Text Domain: hooplanow-events-tools
   License: GPL3
  */

/*
    "WordPress Plugin Template" Copyright (C) 2011 Michael Simpson  (email : michael.d.simpson@gmail.com)

    This following part of this file is part of WordPress Plugin Template for WordPress.

    WordPress Plugin Template is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    WordPress Plugin Template is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with Contact Form to Database Extension.
    If not, see <http://www.gnu.org/licenses/>.
*/

$HooplanowEventsTools_minimalRequiredPhpVersion = '5.0';

/**
 * Check the PHP version and give a useful error message if the user's version is less than the required version
 * @return boolean true if version check passed. If false, triggers an error which WP will handle, by displaying
 * an error message on the Admin page
 */
function HooplanowEventsTools_noticePhpVersionWrong() {
    global $HooplanowEventsTools_minimalRequiredPhpVersion;
    echo '<div class="updated fade">' .
      __('Error: plugin "HooplaNow Events Tools" requires a newer version of PHP to be running.',  'hooplanow-events-tools').
            '<br/>' . __('Minimal version of PHP required: ', 'hooplanow-events-tools') . '<strong>' . $HooplanowEventsTools_minimalRequiredPhpVersion . '</strong>' .
            '<br/>' . __('Your server\'s PHP version: ', 'hooplanow-events-tools') . '<strong>' . phpversion() . '</strong>' .
         '</div>';
}


function HooplanowEventsTools_PhpVersionCheck() {
    global $HooplanowEventsTools_minimalRequiredPhpVersion;
    if (version_compare(phpversion(), $HooplanowEventsTools_minimalRequiredPhpVersion) < 0) {
        add_action('admin_notices', 'HooplanowEventsTools_noticePhpVersionWrong');
        return false;
    }
    return true;
}


/**
 * Initialize internationalization (i18n) for this plugin.
 * References:
 *      http://codex.wordpress.org/I18n_for_WordPress_Developers
 *      http://www.wdmac.com/how-to-create-a-po-language-translation#more-631
 * @return void
 */
function HooplanowEventsTools_i18n_init() {
    $pluginDir = dirname(plugin_basename(__FILE__));
    load_plugin_textdomain('hooplanow-events-tools', false, $pluginDir . '/languages/');
}


//////////////////////////////////
// Run initialization
/////////////////////////////////

// First initialize i18n
HooplanowEventsTools_i18n_init();


// Next, run the version check.
// If it is successful, continue with initialization for this plugin
if (HooplanowEventsTools_PhpVersionCheck()) {
    // Only load and run the init function if we know PHP version can parse it
    include_once('hooplanow-events-tools_init.php');
    HooplanowEventsTools_init(__FILE__);
}
