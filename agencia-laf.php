<?php

/**
 * Plugin Name:     Agência LAF
 * Plugin URI:      https://agencialaf.com
 * Description:     Este plugin é parte integrante do site da Agência LAF
 * Author:          Ingo Stramm
 * Author URI:      https://agencialaf.com
 * Text Domain:     agencia-laf
 * Domain Path:     /languages
 * Version:         0.1.1
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

add_filter('the_title', 'al_remove_link_dos_membros', 10, 2);

function al_remove_link_dos_membros($title, $id = null)
{
    if (!$id || is_admin()) return $title;

    $post_type = get_post_type($id);
    if($post_type == 'digeco_team')
        al_debug($title);

    return $title;
}

require 'plugin-update-checker-4.10/plugin-update-checker.php';
$updateChecker = Puc_v4_Factory::buildUpdateChecker(
    'https://raw.githubusercontent.com/IngoStramm/agencia-laf/master/info.json',
    __FILE__,
    'agencia-laf'
);