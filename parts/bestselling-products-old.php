<?php
echo '<div class="row">';
	echo '<div class="small-12 columns">';

$bestSellingProducts	 = get_field( "best-selling_products" );

if( $bestSellingProducts ) {  
	echo '<h3 class="section-title text-center"><b></b><span class="section-title-main">' . $bestSellingProducts . '</span><b></b></h3>';
}

		
	echo '</div>';
	echo '<div class="small-up-1 medium-up-3 large-up-4" data-equalizer data-equalize-on="medium" id="bestProductGrid" style="display: none;">';
		$posts_per_page = 100;
		$meta_query = WC()->query->get_meta_query();
		$atts = array(
		'orderby' => 'title',
		'order'   => 'rand');
		$args = array(
		'post_type'           => 'product',
		'post_status'         => 'publish',
		'ignore_sticky_posts' => 1,
		'posts_per_page'      => $posts_per_page,
		'meta_key'            => 'total_sales',
		'orderby'             => 'meta_value_num',
		'meta_query'          => $meta_query
		);
		$products = new WP_Query(apply_filters('woocommerce_shortcode_products_query', $args, $atts));
		while ( $products->have_posts() ) : $products->the_post();
		global $product;
		$post_class = implode(" ", get_post_class( ));
		echo '<div class="bestSelling gridItem column column-block text-center ' . $post_class . '">';
			echo '<div data-equalizer-watch>';
				edit_post_link('[rediger]', '<em class="edit-link">', '</em>');
				$productLink = get_permalink( $loop->post->ID );
				$productTitle = esc_attr($loop->post->post_title ? $loop->post->post_title : $loop->post->ID);
				$productImage = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
				echo '<a class="product-image crossFade" href="' . $productLink .'" title="' . $productTitle . '" style="background-image: url(' . $productImage . ')">';
				woocommerce_show_product_sale_flash( $post, $product );
					#woocommerce_get_availability( $post, $product );
					echo '<div style="background-image: url(' . wp_get_attachment_url( get_post_thumbnail_id($post->ID) ) .' )"></div>';
					$attachment_ids = $product->get_gallery_attachment_ids();
					foreach( $attachment_ids as $attachment_id ) {
					$image_link = wp_get_attachment_url( $attachment_id );
					echo '<div style="background-image: url(' . $image_link .' )"></div>';
					}
				echo '</a>';
				echo '<a href="' . $productLink .'" title="' . $productTitle . '">';
					the_title('<h2 class="woocommerce-loop-product__title">', '</h2>');
				echo '</a>';
				echo '<div class="front-grid-price">';
					get_template_part( 'parts/content', 'price' );
				echo '</div>';
			echo '</div>';
			woocommerce_template_loop_add_to_cart( $loop->post, $product );
		echo '</div>';
		endwhile;
		wp_reset_query();
	echo '</div>';
	echo '<div class="small-12 columns text-center">';
		echo '<a href="#" id="loadMore">Indlæs mere</a>';
	echo '</div>';
echo '</div>';
?>