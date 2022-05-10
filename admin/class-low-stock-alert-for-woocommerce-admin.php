<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/racmanuel
 * @since      1.0.0
 *
 * @package    Low_Stock_Alert_For_Woocommerce
 * @subpackage Low_Stock_Alert_For_Woocommerce/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Low_Stock_Alert_For_Woocommerce
 * @subpackage Low_Stock_Alert_For_Woocommerce/admin
 * @author     Manuel Ramirez Coronel <ra_cm@outlook.com>
 */
class Low_Stock_Alert_For_Woocommerce_Admin
{

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of this plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Low_Stock_Alert_For_Woocommerce_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Low_Stock_Alert_For_Woocommerce_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/low-stock-alert-for-woocommerce-admin.css', array(), $this->version, 'all');

    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Low_Stock_Alert_For_Woocommerce_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Low_Stock_Alert_For_Woocommerce_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/low-stock-alert-for-woocommerce-admin.js', array('jquery'), $this->version, false);

    }

    /**
     * Hook in and register a metabox to handle a theme options page and adds a menu item.
     */
    public function lsafw_register_options_metabox()
    {

        /**
         * Registers lsafw options page menu item and form.
         */
        $lsafw_options = new_cmb2_box(array(
            'id' => 'lsafw_options_page',
            'title' => esc_html__('Low Stock Alert for WooCommerce', 'cmb2'),
            'object_types' => array('options-page'),

            /*
             * The following parameters are specific to the options-page box
             * Several of these parameters are passed along to add_menu_page()/add_submenu_page().
             */

            'option_key' => 'lsafw_options', // The option key and admin menu page slug.
            // 'icon_url'        => 'dashicons-palmtree', // Menu icon. Only applicable if 'parent_slug' is left empty.
            'menu_title' => esc_html__('Low Stock Alert', 'cmb2'), // Falls back to 'title' (above).
            'parent_slug' => 'options-general.php', // Make options page a submenu item of the themes menu.
            'capability' => 'manage_options', // Cap required to view options-page.
            // 'position'        => 1, // Menu position. Only applicable if 'parent_slug' is left empty.
            // 'admin_menu_hook' => 'network_admin_menu', // 'network_admin_menu' to add network-level options page.
            // 'display_cb'      => false, // Override the options-page form output (CMB2_Hookup::options_page_output()).
            'save_button' => esc_html__('Guardar', 'cmb2'), // The text for the options-page save button. Defaults to 'Save'.
            // 'disable_settings_errors' => true, // On settings pages (not options-general.php sub-pages), allows disabling.
            // 'message_cb'      => 'yourprefix_options_page_message_callback',
        ));

        /**
         * Options fields ids only need
         * to be unique within this box.
         * Prefix is not needed.
         */
        $lsafw_options->add_field(array(
            'name' => __('Settings of Alert - Title'),
            'desc' => '',
            'type' => 'title',
            'id' => 'lsafw_settings_title',
            'before_row' => 'cmb_after_row_cb',
        ));

        $lsafw_options->add_field(array(
            'name' => 'Titulo',
            'desc' => '',
            'default' => '¡Hey!',
            'id' => 'lsafw_title',
            'type' => 'text',
        ));

        $lsafw_options->add_field(array(
            'name' => 'Llamado a la accion',
            'desc' => '',
            'default' => '¡Que no te lo ganen!😨',
            'id' => 'lsafw_call_to_action',
            'type' => 'text',
        ));

        $lsafw_options->add_field(array(
            'name' => 'Color de llamada a la accion',
            'id' => 'lsafw_color',
            'type' => 'colorpicker',
            'default' => '#ffffff',
        ));

        $lsafw_options->add_field(array(
            'name' => __('Settings of Alert - Description'),
            'desc' => '',
            'type' => 'title',
            'id' => 'lsafw_settings_description',
        ));

        $lsafw_options->add_field(array(
            'name' => __('# Inicial', 'theme-domain'),
            'desc' => __('Inserta el rango inicial del numero aleatorio', 'msft-newscenter'),
            'id' => 'lsafw_random_number_start',
            'type' => 'text',
            'attributes' => array(
                'type' => 'number',
                'pattern' => '\d*',
            ),
            'sanitization_cb' => 'absint',
            'escape_cb' => 'absint',
        ));

        $lsafw_options->add_field(array(
            'name' => __('# Final', 'theme-domain'),
            'desc' => __('Inserta el rango final del numero aleatorio', 'msft-newscenter'),
            'id' => 'lsafw_random_number_finish',
            'type' => 'text',
            'attributes' => array(
                'type' => 'number',
                'pattern' => '\d*',
            ),
            'sanitization_cb' => 'absint',
            'escape_cb' => 'absint',
        ));

        $lsafw_options->add_field(array(
            'name' => __('Settings of Alert - Animations'),
            'desc' => '',
            'type' => 'title',
            'id' => 'lsafw_settings_animations',
        ));

        $lsafw_options->add_field(array(
            'name' => 'Animacion de Titulo',
            'desc' => 'Seleciona una opcion',
            'id' => 'lsafw_animation_title',
            'type' => 'select',
            'show_option_none' => true,
            'default' => 'animate__pulse',
            'options' => array(
                'animate__bounce' => __('bounce', 'cmb2'),
                'animate__flash' => __('flash', 'cmb2'),
                'animate__pulse' => __('pulse', 'cmb2'),
                'animate__rubberBand' => __('rubberBand', 'cmb2'),
                'animate__shakeX' => __('shakeX', 'cmb2'),
                'animate__shakeY' => __('shakeY', 'cmb2'),
                'animate__headShake' => __('headShake', 'cmb2'),
                'animate__swing' => __('swing', 'cmb2'),
                'animate__tada' => __('tada', 'cmb2'),
                'animate__wobble' => __('wobble', 'cmb2'),
                'animate__jello' => __('jello', 'cmb2'),
                'animate__heartBeat' => __('heartBeat', 'cmb2'),
            ),
        ));
        $lsafw_options->add_field(array(
            'name' => 'Animacion de Descripcion',
            'desc' => 'Seleciona una opcion',
            'id' => 'lsafw_animation_description',
            'type' => 'select',
            'show_option_none' => true,
            'default' => 'animate__pulse',
            'options' => array(
                'animate__bounce' => __('bounce', 'cmb2'),
                'animate__flash' => __('flash', 'cmb2'),
                'animate__pulse' => __('pulse', 'cmb2'),
                'animate__rubberBand' => __('rubberBand', 'cmb2'),
                'animate__shakeX' => __('shakeX', 'cmb2'),
                'animate__shakeY' => __('shakeY', 'cmb2'),
                'animate__headShake' => __('headShake', 'cmb2'),
                'animate__swing' => __('swing', 'cmb2'),
                'animate__tada' => __('tada', 'cmb2'),
                'animate__wobble' => __('wobble', 'cmb2'),
                'animate__jello' => __('jello', 'cmb2'),
                'animate__heartBeat' => __('heartBeat', 'cmb2'),
            ),
        ));

        $lsafw_options->add_field(array(
            'name' => __('Settings of Alert - Low Stock Quantity'),
            'desc' => '',
            'type' => 'title',
            'id' => 'lsafw_low_stock_quantity',
        ));

        $lsafw_options->add_field(array(
            'name' => __('Minimo de Stock', 'theme-domain'),
            'desc' => __('Inserta el minimo de Stock que debe tener un producto para mostrar el mensaje.', 'msft-newscenter'),
            'id' => 'lsafw_minimum_stock',
            'type' => 'text',
            'attributes' => array(
                'type' => 'number',
                'pattern' => '\d*',
            ),
            'sanitization_cb' => 'absint',
            'escape_cb' => 'absint',
        ));
    }
}

    /**
    * Add a Message after the Settings in Admin
    */
    function cmb_after_row_cb()
    {
        ?>
    <div class="lsafw_alert">
        <div class="lsafw-alert-title">
            <span>¡Importante!</span>
        </div>
        <div class="lsafw-alert-description">
            <span>
                <?php echo __('Recuerda que para que el plugin funcione correctamente debes de tener todos tus productos configurados para gestionar el stock.', ''); ?>
            </span>
            <div class="lsafw-dev-info">
                <div class="lsafw-row">
                    <div class="lsafw-column">
                        <h3><?php _e('¿Te sirvio el plugin?',''); ?></h3>
                        <p><?php _e('Si te gusta mi plugin no dudes en dar dejar tus comentarios en la pagina principal del plugin, no olvides que el plugin es gratuito.'); ?></p>
                        <a href="#"><?php _e('¡Regalame un Cafe!☕',''); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    }