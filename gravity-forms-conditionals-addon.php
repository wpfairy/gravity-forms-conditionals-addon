<?php
/**
 * @package wpf-frontpage-admin
 * @version 1.0
 */
/*
Plugin Name: Gravity Forms Conditionals Addon
Plugin URI: https://wordpress.org/plugins/wpf-gf-conditionals-addon/
Description: Schedule your WordPress home page, so that it switches automatically according to your campaigns. You are able to cycle the home page one a certain date, daily, monthly, or yearly. Create different home pages, and then let Front Page Admin do the rest!
Version: 20170215
Author: wpfairy
Author URI: https://wpfairy.com/plugins/wpf-gf-conditionals-addon
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: gf-conditionals-addon
Domain Path: /languages
Tags: multisite, multi-lingual, front page, home, schedule
*/

//include( './admin/index.php' );

$current = get_page_by_title( 'Front Page' );

function wpf_after_setup_theme() {
 $site_type = get_option('show_on_front');
if ( $current && is_page($current))
{
    update_option( 'page_on_front', $homepage->ID );
    update_option( 'show_on_front', 'page' );
}
}
//add_action( 'wp', 'wpf_after_setup_theme' );

?>