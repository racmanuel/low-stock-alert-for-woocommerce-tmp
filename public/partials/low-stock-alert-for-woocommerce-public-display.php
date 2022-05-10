<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://github.com/racmanuel
 * @since      1.0.0
 *
 * @package    Low_Stock_Alert_For_Woocommerce
 * @subpackage Low_Stock_Alert_For_Woocommerce/public/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div id="lsafw_alert">
    <div class="lsafw_alert_single_product">
        <div class="lsafw_title">
            <p class="animate__animated <?php echo $this->lsafw_options['lsafw_animation_title']; ?> animate__infinite">
                <?php echo $this->lsafw_options['lsafw_title']; ?> <span class="lsafw_call_to_action"
                    style="color:<?php echo $this->lsafw_options['lsafw_color']; ?>"><?php echo $this->lsafw_options['lsafw_call_to_action']; ?></span>
            </p>
        </div>
        <div class="lsafw_description animate__animated <?php echo $this->lsafw_options['lsafw_animation_description']; ?> animate__infinite"">
            <?php if ($number_rand >= 2): ?>
                <span><?php echo $number_rand; ?> <?php echo __('personas estan viendo el producto.'); ?></span>
            <?php else: ?>
                <span><?php echo $number_rand; ?> <?php echo __('persona esta viendo el producto.'); ?> </span>
            <?php endif;?>
        </div>
    </div>
</div>