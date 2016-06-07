<?php
class DiscussionWoocommerceDropdownCart extends WP_Widget {
	public function __construct() {
		parent::__construct(
			'mkd_woocommerce_dropdown_cart', // Base ID
			'Mikado Woocommerce Dropdown Cart', // Name
			array( 'description' => esc_html__( 'Mikado Woocommerce Dropdown Cart', 'discussionwp' ), ) // Args
		);
	}

	public function widget( $args, $instance ) {
		extract( $args );
		global $woocommerce;

		?>
        <?php print $args['before_widget']; ?>
		<div class="mkd-shopping-cart-outer">
			<div class="mkd-shopping-cart-inner">
				<div class="mkd-shopping-cart-header">
					<a class="mkd-header-cart" href="<?php echo esc_url($woocommerce->cart->get_cart_url()); ?>">
						<i class="ion-bag"></i>
					</a>
					<div class="mkd-shopping-cart-dropdown">
						<?php
						$cart_is_empty = sizeof( $woocommerce->cart->get_cart() ) <= 0;
						?>
						<ul>

							<?php if ( !$cart_is_empty ) : ?>

								<?php foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $cart_item ) :

									$_product = $cart_item['data'];

									// Only display if allowed
									if ( ! $_product->exists() || $cart_item['quantity'] == 0 ) {
										continue;
									}

									// Get price
									$product_price = get_option( 'woocommerce_tax_display_cart' ) == 'excl' ? $_product->get_price_excluding_tax() : $_product->get_price_including_tax();
									?>


									<li>
										<div class="mkd-item-image-holder">
											<a href="<?php echo esc_url(get_permalink( $cart_item['product_id'] )); ?>">
												<?php echo wp_kses($_product->get_image(), array(
													'img' => array(
														'src' => true,
														'width' => true,
														'height' => true,
														'class' => true,
														'alt' => true,
														'title' => true,
														'id' => true
													)
												)); ?>
											</a>
										</div>
										<div class="mkd-item-info-holder">
											<div class="mkd-item-left">
												<h6>
													<a href="<?php echo esc_url(get_permalink( $cart_item['product_id'])); ?>">
														<?php echo apply_filters('woocommerce_widget_cart_product_title', $_product->get_title(), $_product ); ?>
													</a>
												</h6>
												<?php echo apply_filters( 'woocommerce_cart_item_price_html', wc_price( $product_price ), $cart_item, $cart_item_key ); ?>
												<span class="mkd-quantity"><?php esc_html_e('Quantity: ','discussionwp'); echo esc_html($cart_item['quantity']); ?></span>
											</div>
											<div class="mkd-item-right">
												<?php echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="remove" title="%s"><span class="ion-close-round"></span></a>', esc_url( $woocommerce->cart->get_remove_url( $cart_item_key ) ), esc_html__('Remove this item', 'discussionwp') ), $cart_item_key ); ?>

											</div>
										</div>
									</li>

								<?php endforeach; ?>
								<div class="mkd-cart-bottom">
									<div class="mkd-subtotal-holder clearfix">
										<span class="mkd-total"><?php esc_html_e( 'Total', 'discussionwp' ); ?>:</span>
										<span class="mkd-total-amount">
											<?php echo wp_kses($woocommerce->cart->get_cart_subtotal(), array(
												'span' => array(
													'class' => true,
													'id' => true
												)
											)); ?>
										</span>
									</div>
									<div class="mkd-btns-holder clearfix">
										<a href="<?php echo esc_url($woocommerce->cart->get_cart_url()); ?>" class="mkd-btn mkd-btn-solid mkd-btn-large view-cart"><?php esc_html_e( 'Shopping Bag', 'discussionwp' ); ?></a>
										<a href="<?php echo esc_url( $woocommerce->cart->get_checkout_url() ); ?>" class="mkd-btn mkd-btn-solid mkd-btn-large checkout"><?php esc_html_e( 'Checkout', 'discussionwp' ); ?></a>
									</div>
								</div>
							<?php else : ?>

								<li class="mkd-empty-cart"><?php esc_html_e( 'No products in the cart.', 'discussionwp' ); ?></li>

							<?php endif; ?>

						</ul>
						<?php if ( sizeof( $woocommerce->cart->get_cart() ) <= 0 ) : ?>

						<?php endif; ?>
						

						<?php if ( sizeof( $woocommerce->cart->get_cart() ) <= 0 ) : ?>

						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
        <?php print $args['after_widget']; ?>
		<?php
	}

}
add_action( 'widgets_init', create_function( '', 'register_widget( "DiscussionWoocommerceDropdownCart" );' ) );
?>
<?php
add_filter('add_to_cart_fragments', 'discussion_woocommerce_header_add_to_cart_fragment');
function discussion_woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;

	ob_start();
	?>

	<div class="mkd-shopping-cart-header">
		<a class="mkd-header-cart" href="<?php echo esc_url($woocommerce->cart->get_cart_url()); ?>">
			<i class="ion-bag"></i>
		</a>		
		<div class="mkd-shopping-cart-dropdown">
			<?php
			$cart_is_empty = sizeof( $woocommerce->cart->get_cart() ) <= 0;
			?>
			<ul>

				<?php if ( !$cart_is_empty ) : ?>

					<?php foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $cart_item ) :

						$_product = $cart_item['data'];

						// Only display if allowed
						if ( ! $_product->exists() || $cart_item['quantity'] == 0 ) {
							continue;
						}

						// Get price
						$product_price = get_option( 'woocommerce_tax_display_cart' ) == 'excl' ? $_product->get_price_excluding_tax() : $_product->get_price_including_tax();
						?>

						<li>
							<div class="mkd-item-image-holder">
								<?php echo wp_kses($_product->get_image(), array(
									'img' => array(
										'src' => true,
										'width' => true,
										'height' => true,
										'class' => true,
										'alt' => true,
										'title' => true,
										'id' => true
									)
								)); ?>
							</div>
							<div class="mkd-item-info-holder">
								<div class="mkd-item-left">
									<h6>
										<a href="<?php echo esc_url(get_permalink( $cart_item['product_id'] )); ?>">
											<?php echo apply_filters('woocommerce_widget_cart_product_title', $_product->get_title(), $_product ); ?>
										</a>
									</h6>
									<?php echo apply_filters( 'woocommerce_cart_item_price_html', wc_price( $product_price ), $cart_item, $cart_item_key ); ?>
									<span class="mkd-quantity"><?php esc_html_e('Quantity: ','discussionwp'); echo esc_html($cart_item['quantity']); ?></span>
								</div>
								<div class="mkd-item-right">
									<?php echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="remove" title="%s"><span class="ion-close-round"></span></a>', esc_url( $woocommerce->cart->get_remove_url( $cart_item_key ) ), esc_html__('Remove this item', 'discussionwp') ), $cart_item_key ); ?>

								</div>
							</div>
						</li>

					<?php endforeach; ?>
						<div class="mkd-cart-bottom">
							<div class="mkd-subtotal-holder clearfix">
								<span class="mkd-total"><?php esc_html_e( 'Total', 'discussionwp' ); ?>:</span>
								<span class="mkd-total-amount">
									<?php echo wp_kses($woocommerce->cart->get_cart_subtotal(), array(
										'span' => array(
											'class' => true,
											'id' => true
										)
									)); ?>
								</span>
							</div>
							<div class="mkd-btns-holder clearfix">
								<a href="<?php echo esc_url($woocommerce->cart->get_cart_url()); ?>" class="mkd-btn mkd-btn-solid mkd-btn-large view-cart">
									<?php esc_html_e( 'Shopping Bag', 'discussionwp' ); ?>
								</a>
								<a href="<?php echo esc_url( $woocommerce->cart->get_checkout_url() ); ?>" class="mkd-btn mkd-btn-solid mkd-btn-large checkout">
									<?php esc_html_e( 'Checkout', 'discussionwp' ); ?>
								</a>
							</div>
						</div>
				<?php else : ?>

					<li class="mkd-empty-cart"><?php esc_html_e( 'No products in the cart.', 'discussionwp' ); ?></li>

				<?php endif; ?>

			</ul>
			<?php if ( sizeof( $woocommerce->cart->get_cart() ) <= 0 ) : ?>

			<?php endif; ?>
			

			<?php if ( sizeof( $woocommerce->cart->get_cart() ) <= 0 ) : ?>

			<?php endif; ?>
		</div>
	</div>

	<?php
	$fragments['div.mkd-shopping-cart-header'] = ob_get_clean();
	return $fragments;
}
?>