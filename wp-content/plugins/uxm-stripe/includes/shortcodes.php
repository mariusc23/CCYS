<?php

function pippin_stripe_payment_form($atts, $content = null) {
	
	extract( shortcode_atts( array(
		'amount' => '',
		'askchild' => ''
	), $atts ) );
	
	global $stripe_options;
	

	if(isset($_GET['payment']) && $_GET['payment'] == 'paid') {
		echo '<p class="success">' . __('Thank you for your payment.', 'pippin_stripe') . '</p>';
	} else { ?>
		<form action="" method="POST" id="stripe-payment-form" class="wpcf7">
			<ol>
				<li class="form-row">
					<label><?php _e('Name', 'pippin_stripe'); ?></label>
					<span class="wpcf7-form-control-wrap">
						<input type="text" size="20" autocomplete="off" class="customer-name"/>
					</span>
				</li>
				<?php if($askchild != NULL) {
					$child_label = __('Child Name', 'pippin_stripe');
					echo '<li class="form-row">
					<label>' . $child_label . '</label>
					<span class="wpcf7-form-control-wrap">
						<input type="text" size="20" autocomplete="off" name="child-name" class="child-name"/>
					</span>
				</li>'; }
				?>
				<li class="form-row">
					<label><?php _e('Card Number', 'pippin_stripe'); ?></label>
					<span class="wpcf7-form-control-wrap">
						<input type="text" size="20" autocomplete="off" class="card-number"/>
					</span>
				</li>
				<li class="form-row">
					<label><?php _e('CVC', 'pippin_stripe'); ?></label>
					<span class="wpcf7-form-control-wrap">
						<input type="text" size="4" autocomplete="off" class="card-cvc"/>
					</span>
				</li>
				<li class="form-row">
					<label><?php _e('Expiration (MM/YYYY)', 'pippin_stripe'); ?></label><br />
					<input type="text" size="2" class="inline-input card-expiry-month" placeholder="MM"/>
					<span> / </span>
					<input type="text" size="4" class="inline-input card-expiry-year" placeholder="YYYY"/>
				</li>
				<?php if(isset($stripe_options['recurring'])) { ?>
				<li class="form-row">
					<label><?php _e('Payment Type:', 'pippin_stripe'); ?></label>
					<input type="radio" name="recurring" value="no" checked="checked"/><span><?php _e('One time payment', 'pippin_stripe'); ?></span>
					<input type="radio" name="recurring" value="yes"/><span><?php _e('Recurring monthly payment', 'pippin_stripe'); ?></span>
				</li>
				<?php }; ?>
				
			</ol>
			<input type="hidden" name="action" value="stripe"/>
			<input type="hidden" name="redirect" value="<?php echo get_permalink(); ?>"/>
			<input type="hidden" name="amount" value="<?php echo base64_encode($amount); ?>"/>
			<input type="hidden" name="stripe_nonce" value="<?php echo wp_create_nonce('stripe-nonce'); ?>"/>
			<button type="submit" id="stripe-submit" class="button green submit"><?php _e('Submit Payment', 'pippin_stripe'); ?> - $<?php echo $amount; ?></button>
			<small class="stripe-providers">We accept all major credit card providers.</small>
			<div class="payment-errors wpcf7-response-output wpcf7-not-valid-tip"></div>
		</form>
		
		<?php
		
	}
}
function stripe_shortcodeize($atts, $content = NULL) {
	ob_start();
	pippin_stripe_payment_form($atts);
	$output_string=ob_get_contents();
	ob_end_clean();
	
	return $output_string;
}
add_shortcode('stripe', 'stripe_shortcodeize');

