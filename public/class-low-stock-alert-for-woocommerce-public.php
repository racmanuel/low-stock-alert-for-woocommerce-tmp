<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://github.com/racmanuel
 * @since      1.0.0
 *
 * @package    Low_Stock_Alert_For_Woocommerce
 * @subpackage Low_Stock_Alert_For_Woocommerce/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Low_Stock_Alert_For_Woocommerce
 * @subpackage Low_Stock_Alert_For_Woocommerce/public
 * @author     Manuel Ramirez Coronel <ra_cm@outlook.com>
 */
class Low_Stock_Alert_For_Woocommerce_Public
{
	/**
	 * Get the CMB2 Options - Global Variable
 	 */
	private $lsafw_options;

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
     * @param      string    $plugin_name       The name of the plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;
		$this->lsafw_options = get_option('lsafw_options');
    }

    /**
     * Register the stylesheets for the public-facing side of the site.
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

        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/low-stock-alert-for-woocommerce-public.css', array(), $this->version, 'all');
        wp_enqueue_style($this->plugin_name . '-animate-css', plugin_dir_url(__FILE__) . 'css/animate.min.css', array(), $this->version, 'all');
    }

    /**
     * Register the JavaScript for the public-facing side of the site.
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

        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/low-stock-alert-for-woocommerce-public.js', array('jquery'), $this->version, false);

    }

    /*
     * Show a Alert in Single Product when the Product Stock is Low
     */
    public function lsafw_alert_in_single_product()
    {
        if (is_product()) {


            /**
             * WooCommerce Global Variable to access to the product
             */
            global $product;

            /**
             * If is a Simple Product do a code
             */

            if ($product->is_type('simple')) {

                /**
                 * Variable to get a Random Number
                 */
                $number_rand = rand($this->lsafw_options['lsafw_random_number_start'], $this->lsafw_options['lsafw_random_number_finish']);

                /**
                 * Get the actual Product Stock Quantity
                 */
                $Stock_Left = $product->get_stock_quantity();

                /**
                 * Check if the Stock is < than the Options
                 */
                if ($Stock_Left <= $this->lsafw_options['lsafw_minimum_stock']) {
                    /**
                     * HTML Message to Show in Single Product
                     */
                    require_once __DIR__ . '/partials/low-stock-alert-for-woocommerce-public-display.php';
				}
            }
        }
    }

    public function bbloomer_show_stock_shop()
    {
        if (is_shop()) {

            /**
             * Get the Global Prodcut Varaible
             */
            global $product;

            /**
             * If is a Simple Product do a code
             */
            if ($product->is_type('simple')) {

                /**
                 * Get the current Stock Quantity
                 */
                $Stock_Left = $product->get_stock_quantity();

                /**
                 * Check if the Current Stock is minor or the same to the Minimun Value in Settings
                 */
                if ($Stock_Left <= $this->lsafw_options['lsafw_minimum_stock'] or $Stock_Left == $this->lsafw_options['lsafw_minimum_stock'] or $Stock_Left == !$this->lsafw_options['lsafw_minimum_stock']) {
                    /**
                     * HTML Message to Show in Product Loop
                     */
                    ?>
                <div class=" lsafw_title">
                    <span class="lsafw_call_to_action" style="color:<?php echo $this->lsafw_options['lsafw_color']; ?>"><?php echo $this->lsafw_options['lsafw_call_to_action']; ?> quedan
                    <?php echo wc_get_stock_html($product); ?></span>
                </div>
                <?php
				}
            }
        }
    }
}
