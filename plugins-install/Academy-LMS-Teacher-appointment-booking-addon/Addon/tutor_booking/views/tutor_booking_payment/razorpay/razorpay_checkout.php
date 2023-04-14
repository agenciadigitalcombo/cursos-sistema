<?php

$purchesed_schedule_id=$_POST['purchesed_schedule_id'];
$purchesed_booking_id=$_POST['purchesed_booking_id'];
$booking_amount=$_POST['booking_amount'];


?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Razorpay | <?php echo get_settings('system_name');?></title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<link href="<?php echo base_url('assets/payment/css/stripe.css');?>" rel="stylesheet">
		<link name="favicon" type="image/x-icon" href="<?php echo base_url('uploads/system/'.get_settings('favicon'));?>" rel="shortcut icon" />

		<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

		<style type="text/css">
			.package-details{
				width: 100%;
				float: left;
			}
			.pb-25px{
				padding-bottom: 25px;
			}
			.rzp-button1{
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
	</head>
	<body>

	
		<?php $razorpay_keys = json_decode(get_settings('razorpay_keys')); ?>

		<div class="package-details">

			<strong>
				<img class="pb-25px" src="<?php echo base_url('assets/payment/razorpay.png'); ?>" width="150">
			</strong>
			<br>
			<strong><?php echo site_phrase('customer_name');?> | <?php echo $user_details['first_name'].' '.$user_details['last_name'];?></strong> <br>
			<strong><?php echo site_phrase('amount_to_pay');?> | <?php echo $booking_amount.' '.get_settings('razorpay_currency');?></strong> <br>

			<button id="rzp-button1" class="rzp-button1"><?php echo get_phrase('pay'); ?></button>
		</div>
		<?php $preparedData = $this->payment_model->razorpayPrepareData($user_details['id']); ?>

		

		<script>
			var options = {
			"key": "<?php echo $preparedData['key']; ?>", // Enter the Key ID generated from the Dashboard
			"amount": "<?php echo $preparedData['amount']; ?>", // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
			"currency": "<?php echo get_settings('razorpay_currency'); ?>",
			"name": "<?= $preparedData['name']; ?>",
			"order_id": "<?= $preparedData['order_id']; ?>", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
			"handler": function (response){

		        var redirectUrl = "<?php echo site_url('addons/tutor_booking/razorpay_payment/'.$payment_request.'?user_id='.$user_details['id'].'&purchesed_schedule_id='.$purchesed_schedule_id.'&purchesed_booking_id='.$purchesed_booking_id.'&amount='.$booking_amount.'&razorpay_order_id='); ?>" + response.razorpay_order_id + "&payment_id=" + response.razorpay_payment_id + "&signature=" + response.razorpay_signature;
		        window.location = redirectUrl;
			},
			"prefill": {
				"name": "<?= $preparedData['prefill']['name']; ?>",
				"email": "<?= $preparedData['prefill']['email']; ?>"
			},
			"theme": {
				"color": "<?= $preparedData['theme']['color']; ?>"
			}};
			
			var rzp1 = new Razorpay(options);
			rzp1.on('payment.failed', function (response){

			});

			document.getElementById('rzp-button1').onclick = function(e){
				rzp1.open();
				e.preventDefault();
			}
		</script>
	</body>
</html>