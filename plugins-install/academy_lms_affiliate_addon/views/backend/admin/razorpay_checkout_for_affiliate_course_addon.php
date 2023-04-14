<!DOCTYPE html>
<style>
	.pk {
		width: 100%;
		float: left;
	}

	.bd {
		background-color: #fff !important;
	}

	.im {
		padding-bottom: 25px;
	}

	.rz_btn {
		padding: 5px;
		float: none !important;
		cursor: pointer;
		background-color: rgb(43, 131, 234);
		margin-left: auto !important;
		margin-right: auto !important;
		width: 200px;
		padding: 0px;
		height: 35px;
		line-height: 35px;
	}
</style>
<html lang="en">

<head>
	<title>Razorpay | <?php echo get_settings('system_name'); ?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link href="<?php echo base_url('assets/payment/css/stripe.css'); ?>" rel="stylesheet">
	<link name="favicon" type="image/x-icon" href="<?php echo base_url('uploads/system/' . get_settings('favicon')); ?>" rel="shortcut icon" />

	<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
</head>

<body class="bd">

	<div class="package-details pk">

		<strong>
			<img class="im" src="<?php echo base_url('assets/payment/razorpay.png'); ?>" width="150">
		</strong>
		<br>
		<strong><?php echo site_phrase('customer_name'); ?> | <?php echo $user_details['first_name'] . ' ' . $user_details['last_name']; ?></strong> <br>
		<strong><?php echo site_phrase('amount_to_pay'); ?> | <?php echo $amount_to_pay . ' ' . get_settings('razorpay_currency'); ?></strong> <br>

		<button id="rzp-button1" class="rz_btn"><?php echo get_phrase('pay'); ?></button>
	</div>
	<?php $preparedData = $this->payment_model->razorpayPrepareData($user_details['id'], true, $amount_to_pay); ?>

	<script>
		"use strict";
		var options = {
			"key": "<?php echo $preparedData['key']; ?>", // Enter the Key ID generated from the Dashboard
			"amount": "<?php echo $preparedData['amount']; ?>", // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
			"currency": "<?php echo get_settings('razorpay_currency'); ?>",
			"name": "<?= $preparedData['name']; ?>",
			"order_id": "<?= $preparedData['order_id']; ?>", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
			"handler": function(response) {


				var redirectUrl = "<?php echo site_url('addons/affiliate_course/razorpay_checkout_for_affiliate_course_addon/' . $user_details['id'] . '/' . $payout_id . '/paid/'); ?>" + response.razorpay_order_id + "/" + response.razorpay_payment_id + "/<?php echo $preparedData['amount']; ?>" + "/" + response.razorpay_signature;
				window.location = redirectUrl;

			},
			"prefill": {
				"name": "<?= $preparedData['prefill']['name']; ?>",
				"email": "<?= $preparedData['prefill']['email']; ?>"
			},
			"theme": {
				"color": "<?= $preparedData['theme']['color']; ?>"
			}
		};

		var rzp1 = new Razorpay(options);
		rzp1.on('payment.failed', function(response) {

		});

		document.getElementById('rzp-button1').onclick = function(e) {
			rzp1.open();
			e.preventDefault();
		}
	</script>
</body>

</html>