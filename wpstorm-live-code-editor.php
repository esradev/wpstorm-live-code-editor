<?php
/**
 * Plugin Name: Wpstorm Live Code Editor
 * Plugin URI:  https://wpstorm.ir/wpstorm-lce
 * Description: This plugin adds A live code editor everywhere you want.
 * Version:     1.0.0
 * Author:      Wpstorm Genius
 * Author URI:  https://wpstorm.ir
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: wpstorm-lcs
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * The main class for the Wpstorm Persian Toolkit plugin.
 */
class Wpstorm_Live_Code_Editor {

    /**
     * Initialize the plugin.
     */
    public function __construct() {
        $this->define_constants();
        $this->load_dependencies();
    }

    /**
     * Define plugin constants.
     */
    private function define_constants() {
        define('WPSTORM_LCE_FILE', __FILE__);
        define('WPSTORM_LCE_DIR', plugin_dir_path(WPSTORM_LCE_FILE));
        define('WPSTORM_LCE_URL', plugin_dir_url(WPSTORM_LCE_FILE));
        define('WPSTORM_LCE_VERSION', '1.0.0');
        define('WPSTORM_LCE_SLUG', 'wpstorm_lce_settings');
    }

    /**
     * Load plugin dependencies.
     */
    private function load_dependencies() {
        // Include additional files or classes here if needed.
        require_once WPSTORM_LCE_DIR . 'classes/wpstorm-lce-settings.php';
    }
}

/**
 * Initialize the Wpstorm Persian Toolkit plugin.
 */
function Wpstorm_Lce_init() {
    $Wpstorm_Lce_plugin = new Wpstorm_Live_Code_Editor();
}

add_action('plugins_loaded', 'Wpstorm_Lce_init');
