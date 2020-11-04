<?php

/**
 * Plugin Name:     Agência LAF
 * Plugin URI:      https://agencialaf.com
 * Description:     Este plugin é parte integrante do site da Agência LAF
 * Author:          Ingo Stramm
 * Author URI:      https://agencialaf.com
 * Text Domain:     agencia-laf
 * Domain Path:     /languages
 * Version:         0.1.6
 *
 * @package         Agencia_Laf
 */

defined('ABSPATH') or die('No script kiddies please!');

define('AL_DIR', plugin_dir_path(__FILE__));
define('AL_URL', plugin_dir_url(__FILE__));

function al_debug($debug)
{
    echo '<pre>';
    var_dump($debug);
    echo '</pre>';
}

add_filter('clean_url', 'al_defer_parsing_of_js', 11, 1);

function al_defer_parsing_of_js($url)
{
    if (FALSE === strpos($url, '.js')) return $url;
    if (strpos($url, 'jquery.js')) return $url;
    return "$url' defer ";
}
add_action('wp_enqueue_scripts', 'al_frontend_scripts');

function al_frontend_scripts()
{

    if (in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1', '10.0.0.3'))) :
        wp_enqueue_script('al-livereload', 'http://localhost:35729/livereload.js?snipver=1', array(), null, true);
    endif;

    $min = (in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1', '10.0.0.3'))) ? '' : '.min';

    // wp_enqueue_style( 'al-style', AL_URL . 'assets/css/style.css', array(), false, 'all' );

    // wp_enqueue_script( 'jquery-mask', AL_URL . 'assets/lib/jquery.mask' . $min . '.js', array( 'jquery' ), '1.14.16', true );

    wp_register_script('agencia-laf-script', AL_URL . 'assets/js/agencia-laf' . $min . '.js', array('jquery'), '1.0.1', true);

    wp_enqueue_script('agencia-laf-script');

    wp_localize_script('agencia-laf-script', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
}

require 'plugin-update-checker-4.10/plugin-update-checker.php';
$updateChecker = Puc_v4_Factory::buildUpdateChecker(
    'https://raw.githubusercontent.com/IngoStramm/agencia-laf/master/info.json',
    __FILE__,
    'agencia-laf'
);