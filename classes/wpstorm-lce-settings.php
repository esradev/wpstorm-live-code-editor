<?php
/**
 * Class Wpstorm_Lce_Settings
 * Handles the settings page for Wpstorm Live Code Editor.
 */
class Wpstorm_Lce_Settings {
    /**
     * Instance
     *
     * @access private
     * @var object Class object.
     * @since 1.0.0
     */
    private static $instance;

    /**
     * Initiator
     *
     * @return object Initialized object of class.
     * @since 1.0.0
     */
    public static function get_instance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function __construct()
    {
        add_action('admin_menu', [$this, 'init_menu']);
        add_action('admin_enqueue_scripts', [$this, 'admin_enqueue_scripts']);
        add_action('admin_enqueue_scripts', [$this, 'admin_enqueue_styles']);
    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since 1.0.0
     */
    public function admin_enqueue_styles()
    {
        wp_enqueue_style('wpstorm-lce-style', WPSTORM_TK_URL . 'build/index.css', [], WPSTORM_TK_VERSION);
    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since 1.0.0
     */
    public function admin_enqueue_scripts($hook)
    {
        wp_enqueue_script(
            'wpstorm-lce-script',
            WPSTORM_TK_URL . 'build/index.js',
            [
                'wp-element',
                'wp-i18n',
            ],
            WPSTORM_TK_VERSION,
            true
        );

        /**
         * Add a localization object ,The base rest api url and a security nonce
         * @see https://since1979.dev/snippet-014-setup-axios-for-the-wordpress-rest-api/
         * */
        wp_localize_script(
            'wpstorm-lce-script',
            'wpstormTKJsObject',
            [
                'rootapiurl'        => esc_url_raw(rest_url()),
                'nonce'             => wp_create_nonce('wp_rest'),
            ]
        );

    }

    /**
     * Add submenu page for the plugin settings.
     */
    public function init_menu()
    {
        add_menu_page(
            __('Wpstorm Live Code Editor Settings', 'wpstorm-lce'),
            __('Wpstorm Live Code Editor', 'wpstorm-lce'),
            'manage_options',
            WPSTORM_LCE_SLUG,
            [
                $this,
                'render_settings_page',
            ],
            'dashicons-media-code',
            100
        );
        add_submenu_page(
            WPSTORM_LCE_SLUG,
            __('Wpstorm Live Code Editor Settings', 'wpstorm-lce'),
            __('Settings', 'wpstorm-lce'),
            'manage_options',
            WPSTORM_LCE_SLUG,
            [
                $this,
                'render_settings_page',
            ]
        );
    }


    /**
     * Render the settings page content.
     */
    public function render_settings_page() {
        ?>
        <div id="wpstorm-lce-admin"></div>
        <?php
    }

}

Wpstorm_Lce_Settings::get_instance();