<?php

if (!function_exists('discussion_woocommerce_products_per_page')) {
	/**
	 * Function that sets number of products per page. Default is 12
	 * @return int number of products to be shown per page
	 */
	function discussion_woocommerce_products_per_page() {

		$products_per_page = 12;

		if (discussion_options()->getOptionValue('mkd_woo_products_per_page')) {
			$products_per_page = discussion_options()->getOptionValue('mkd_woo_products_per_page');
		}

		return $products_per_page;
	}
}

if (!function_exists('discussion_woocommerce_related_products_args')) {
	/**
	 * Function that sets number of displayed related products. Hooks to woocommerce_output_related_products_args filter
	 * @param $args array array of args for the query
	 * @return mixed array of changed args
	 */
	function discussion_woocommerce_related_products_args($args) {

		if (discussion_options()->getOptionValue('mkd_woo_product_list_columns')) {

			$related = discussion_options()->getOptionValue('mkd_woo_product_list_columns');
			switch ($related) {
				case 'mkd-woocommerce-columns-4':
					$args['posts_per_page'] = 4;
					break;
				case 'mkd-woocommerce-columns-3':
					$args['posts_per_page'] = 3;
					break;
				default:
					$args['posts_per_page'] = 3;
			}

		} else {
			$args['posts_per_page'] = 3;
		}

		return $args;
	}
}

if (!function_exists('discussion_woocommerce_template_loop_product_title')) {
	/**
	 * Function for overriding product title template in Product List Loop
	 */
	function discussion_woocommerce_template_loop_product_title() {

		$tag = discussion_options()->getOptionValue('mkd_products_list_title_tag');
		if($tag === '') {
			$tag = 'h4';
		}
		the_title('<' . $tag . ' class="mkd-product-list-product-title"><a href="'.get_the_permalink().'">', '</a></' . $tag . '>');
	}
}

if (!function_exists('discussion_woocommerce_template_single_title')) {
	/**
	 * Function for overriding product title template in Single Product template
	 */
	function discussion_woocommerce_template_single_title() {

		$tag = discussion_options()->getOptionValue('mkd_single_product_title_tag');
		if($tag === '') {
			$tag = 'h1';
		}
		the_title('<' . $tag . '  itemprop="name" class="mkd-single-product-title">', '</' . $tag . '>');
	}
}

if (!function_exists('discussion_woocommerce_sale_flash')) {
	/**
	 * Function for overriding Sale Flash Template
	 *
	 * @return string
	 */
	function discussion_woocommerce_sale_flash() {
		global $product;
		$html = '';

		if ($product->is_on_sale()){
			$html = '<span class="mkd-onsale">' . esc_html__('Sale', 'discussionwp') . '</span>';
		}
		elseif (!$product->is_in_stock()){
			$html = '<span class="mkd-out-of-stock">' . esc_html__('Out of stock', 'discussionwp') . '</span>';
		}
		return $html;
	}
}

if (!function_exists('discussion_woocommerce_loop_add_to_cart_link')) {
	/**
	 * Function that overrides default woocommerce add to cart button on product list
	 * Uses HTML from mkd_button
	 *
	 * @return mixed|string
	 */
	function discussion_woocommerce_loop_add_to_cart_link() {

		global $product;

		$button_url = $product->add_to_cart_url();
		$button_classes = sprintf('%s product_type_%s ajax_add_to_cart button',
			$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
			esc_attr( $product->product_type )
		);
		$button_text = $product->add_to_cart_text();
		$button_attrs = array(
			'rel' => 'nofollow',
			'data-product_id' => esc_attr( $product->id ),
			'data-product_sku' => esc_attr( $product->get_sku() ),
			'data-quantity' => esc_attr( isset( $quantity ) ? $quantity : 1 )
		);

		$icon_classes = array();
		if ($product->is_purchasable() && $product->is_in_stock()){
			$icon_classes['icon_pack'] = 'ion_icons';
			$icon_classes['ion_icon'] = 'ion-ios-cart';
		}


		$add_to_cart_button = discussion_get_button_html(array_merge(
			array(
				'link'			=> $button_url,
				'custom_class'	=> $button_classes,
				'text'			=> $button_text,
				'size'			=> 'huge',
				'type'			=> 'outline',
				'color'			=> '#171717',
				'border_color'	=> 'transparent',
				'custom_attrs'	=> $button_attrs
			),$icon_classes
		));

		return $add_to_cart_button;
	}
}

if (!function_exists('discussion_woocommerce_rating_html')) {
	/**
	 * Function that overrides default woocommerce rating html
	 *
	 * @return string
	 */
	function discussion_woocommerce_rating_html($rating) {
		$rating_html = '';

		if ($rating == ''){
			$rating_html .= '<div class="star-rating" title="' . sprintf( __( 'Not rated', 'discussionwp' ), $rating ) . '"></div>';
		}
		else{
			$rating_html = $rating;
		}

		return $rating_html;
	}
}