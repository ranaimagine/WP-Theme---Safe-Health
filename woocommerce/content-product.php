<?php
/**
* The template for displaying product content within loops
*
* This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
*
* HOWEVER, on occasion WooCommerce will need to update template files and you
* (the theme developer) will need to copy the new files to your theme to
* maintain compatibility. We try to do this as little as possible, but it does
* happen. When this occurs the version of the template file will be bumped and
* the readme will list any important changes.
*
* @see     https://docs.woocommerce.com/document/template-structure/
* @author  WooThemes
* @package WooCommerce/Templates
* @version 3.0.0
*/
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $product;
// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>
<div <?php post_class( 'gridItem column column-block text-center' ); ?>>
	<div data-equalizer-watch>
		<?php
			/**
			* woocommerce_before_shop_loop_item hook.
			*
			* @hooked woocommerce_template_loop_product_link_open - 10
			*/
 			edit_post_link('[rediger]', '<em class="edit-link">', '</em>');
			do_action( 'woocommerce_before_shop_loop_item' );
			/**
			* woocommerce_before_shop_loop_item_title hook.
			*
			* @hooked woocommerce_show_product_loop_sale_flash - 10
			* @hooked woocommerce_template_loop_product_thumbnail - 10
			*/
				$productLink = get_permalink( $loop->post->ID );
				$productTitle = get_the_title();
				$productImage = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
				echo '<a class="product-image crossFade" href="' . $productLink .'" title="' . $productTitle . '" style="background-image: url(' . $productImage . ')">';
				woocommerce_show_product_sale_flash( $post, $product );
				echo '<div style="background-image: url(' . wp_get_attachment_url( get_post_thumbnail_id($post->ID) ) .' )"></div>';
					$attachment_ids = $product->get_gallery_attachment_ids();
					foreach( $attachment_ids as $attachment_id ) {
					$image_link = wp_get_attachment_url( $attachment_id );
					echo '<div style="background-image: url(' . $image_link .' )"></div>';
					}
				echo '</a>';
			#do_action( 'woocommerce_before_shop_loop_item_title' );
			/**
			* woocommerce_shop_loop_item_title hook.
			*
			* @hooked woocommerce_template_loop_product_title - 10
			*/
			do_action( 'woocommerce_shop_loop_item_title' );
			/**
			* woocommerce_after_shop_loop_item_title hook.
			*
			* @hooked woocommerce_template_loop_rating - 5
			* @hooked woocommerce_template_loop_price - 10
			*/
			do_action( 'woocommerce_after_shop_loop_item_title' );
			/**
			* woocommerce_after_shop_loop_item hook.
			*
			* @hooked woocommerce_template_loop_product_link_close - 5
			* @hooked woocommerce_template_loop_add_to_cart - 10
			*/
		?>
	</div>
	<?php
	do_action( 'woocommerce_after_shop_loop_item' );
	?>
</div>