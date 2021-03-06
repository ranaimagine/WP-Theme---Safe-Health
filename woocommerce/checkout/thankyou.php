<?php
/**
* Thankyou page
*
* This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
*
* HOWEVER, on occasion WooCommerce will need to update template files and you
* (the theme developer) will need to copy the new files to your theme to
* maintain compatibility. We try to do this as little as possible, but it does
* happen. When this occurs the version of the template file will be bumped and
* the readme will list any important changes.
*
	* @see 	    https://docs.woocommerce.com/document/template-structure/
		* @author 		WooThemes
	* @package 	WooCommerce/Templates
* @version     3.0.0
*/
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="woocommerce-order">
	<?php if ( $order ) : ?>
	<?php if ( $order->has_status( 'failed' ) ) : ?>
	<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed"><?php _e( 'Desværre kan din ordre ikke behandles, da den oprindelige bank / købmand har afvist din transaktion. Prøv venligst dit køb igen.', 'woocommerce' ); ?></p>
	<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
		<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php _e( 'Betale', 'woocommerce' ) ?></a>
		<?php if ( is_user_logged_in() ) : ?>
		<a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="button pay"><?php _e( 'Min konto', 'woocommerce' ); ?></a>
		<?php endif; ?>
	</p>
	<?php else : ?>
	<p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', __( 'Tak. Din ordre er modtaget.', 'woocommerce' ), $order ); ?></p>
	<ul class="woocommerce-order-overview woocommerce-thankyou-order-details order_details">
		<li class="woocommerce-order-overview__order order">
			<?php _e( 'Ordrenummer:', 'woocommerce' ); ?>
			<strong><?php echo $order->get_order_number(); ?></strong>
		</li>
		<li class="woocommerce-order-overview__date date">
			<?php _e( 'Dato:', 'woocommerce' ); ?>
			<strong><?php echo wc_format_datetime( $order->get_date_created() ); ?></strong>
		</li>
		<li class="woocommerce-order-overview__total total">
			<?php _e( 'Total:', 'woocommerce' ); ?>
			<strong><?php echo $order->get_formatted_order_total(); ?></strong>
		</li>
		<?php if ( $order->get_payment_method_title() ) : ?>
		<li class="woocommerce-order-overview__payment-method method">
			<?php _e( 'Betalingsmetode:', 'woocommerce' ); ?>
			<strong><?php echo wp_kses_post( $order->get_payment_method_title() ); ?></strong>
		</li>
		<?php endif; ?>
	</ul>
	<?php endif; ?>
	<?php do_action( 'woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id() ); ?>
	<?php do_action( 'woocommerce_thankyou', $order->get_id() ); ?>
	<?php else : ?>
	<p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', __( 'Tak. Din ordre er modtaget.', 'woocommerce.' ), null ); ?></p>
	<?php endif; ?>
</div>