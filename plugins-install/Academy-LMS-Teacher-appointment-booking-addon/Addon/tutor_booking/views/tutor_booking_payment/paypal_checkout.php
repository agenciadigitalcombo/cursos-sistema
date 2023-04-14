
  <?php

  $purchesed_schedule_id=$_POST['purchesed_schedule_id'];
  $purchesed_booking_id=$_POST['purchesed_booking_id'];
  
  
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Paypal | <?php echo get_settings('system_name');?></title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="<?php echo base_url('assets/payment/css/stripe.css');?>"
  rel="stylesheet">
  <link name="favicon" type="image/x-icon" href="<?php echo base_url('uploads/system/'.get_frontend_settings('favicon'));?>" rel="shortcut icon" />

  <style type="text/css">
    .pay-loader{
      position: fixed; display: none; width: 100%; height: 100%; top: 0; left: 0; right: 0; bottom: 0; background-color: #42477077; z-index: 1000; color: #fff; text-align: center; padding-top: 100px;
    }
  </style>
</head>
<body>
  <?php
  $paypal_keys = get_settings('paypal');
  $paypal = json_decode($paypal_keys);
  ?>

  <div class="package-details">
    <strong><?php echo site_phrase('student_name');?> | <?php echo $user_details['first_name'].' '.$user_details['last_name'];?></strong> <br>
    <strong><?php echo site_phrase('amount_to_pay');?> | <?php echo $booking_amount;?></strong> <br>

   
    <div id="paypal-button" class="mt-20px"></div><br>
  </div>

<script src="<?php echo base_url('assets/backend/js/jquery-3.3.1.min.js'); ?>" charset="utf-8"></script>
  <script src="https://www.paypalobjects.com/api/checkout.js"></script>

  <script>
  paypal.Button.render({
    env: '<?php echo $paypal[0]->mode;?>', // 'sandbox' or 'production'
    style: {
      label: 'paypal',
      size:  'medium',    // small | medium | large | responsive
      shape: 'rect',     // pill | rect
      color: 'blue',     // gold | blue | silver | black
      tagline: false
    },
    client: {
      sandbox:    '<?php echo $paypal[0]->sandbox_client_id;?>',
      production: '<?php echo $paypal[0]->production_client_id;?>'
    },

    commit: true, // Show a 'Pay Now' button

    payment: function(data, actions) {
      return actions.payment.create({
        payment: {
          transactions: [
            {
              amount: { total: '<?php echo $booking_amount;?>', currency: '<?php echo get_settings('paypal_currency'); ?>' }
            }
          ]
        }
      });
    },

    onAuthorize: function(data, actions) {
      // executes the payment
      return actions.payment.execute().then(function() {
        // PASSING TO CONTROLLER FOR CHECKING
        var redirectUrl = '<?php echo site_url('addons/tutor_booking/paypal_payment/'.$purchesed_schedule_id.'/'.$purchesed_booking_id.'/'.$user_details['id'].'/'.$booking_amount);?>'+'/'+data.paymentID+'/'+data.paymentToken+'/'+data.payerID;
        $('#loader_modal').fadeIn(50);
        <?php if($payment_request == 'true'){ ?>
          window.location = redirectUrl+'/true';
        <?php }else{ ?>
          window.location = redirectUrl;
        <?php } ?>
      });
    }

  }, '#paypal-button');
</script>

<div id="loader_modal" class="pay-loader">Please wait....</div>
</body>
</html>
