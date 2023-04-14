<?php

$CI    = &get_instance();
$CI->load->model('addons/affiliate_course_model');



$user_id = $this->session->userdata('user_id');
$course_affiliation_tableinfo = $this->affiliate_course_model->get_affiliate_course_table_info_by_user($user_id);
$count = 0;
$te = 0;


if ($course_affiliation_tableinfo->num_rows() > 0) {
  foreach ($course_affiliation_tableinfo->result_array() as $total_earning_history) {
    $te = $te + $total_earning_history['amount'];
  }
}



//get info for withdrawl

$w = $this->affiliate_course_model->get_withdrawl_request_info_for_referral_course_amount($user_id);
$total_withdraw_amount = 0;
$pending = 0;
$p_id = 0;



if ($w->num_rows() > 0) {
  foreach ($w->result_array() as $withdrale_history) {
    $total_withdraw_amount = $total_withdraw_amount + $withdrale_history['amount'];

    if ($withdrale_history['status'] == "pending") {
      $pending = $withdrale_history['amount'];
      $p_id = $withdrale_history['user_id'];
    }
  }
}


?>

<script src="<?php echo base_url();?>/assets/affiliate_css/html2canvas.min.js"></script>
<script src="<?php echo base_url();?>/assets/affiliate_css/pdfmake.min.js"></script>



<?php include "profile_menus.php"; ?>


<style>
  .borderexample {
    border-style: solid;
    border-color: #287EC7;
    color: #19619ced;
    line-height: 2.5;
  }
  .table_cap{
    caption-side: top;

  }
  .clr{
    color:#19619ced ;  

  }
  .imp{
    padding-bottom: 25px;

  }
  .bn{
    float: right; margin-top: -21px;
  }
  </style>




<section class="purchase-history-list-area">

  <div class="container">

    <div class="row justify-content-center">



      <div class="col-lg-4 py-4 pull-right">
        <div class="card text-white bg-secondary">
          <div class="card-body">
            <div class="float-right bg-white">
              <i class="mdi mdi-currency-usd widget-icon text-secondary"></i>
            </div>
            <h5 class="text-white font-weight-normal mt-0" title="<?php echo get_phrase('Total Affiliate Earnings :');
                                                                  ?>"><?php echo get_phrase('Total Affiliate Earnings :');
                                                                      ?></h5>
            <h3 class="mt-3 mb-3">
              <span class="text-white"><i class="mdi mdi-arrow-down-bold"></i></span>
              <?php echo currency($te);
              ?>
            </h3>
          </div> <!-- end card-body-->
        </div> <!-- end card-->
      </div> <!-- end col-->

      <div class="col-lg-4 py-4 pull-right">
        <div class="card text-white bg-success">
          <div class="card-body">
            <div class="float-right bg-white">
              <i class="mdi mdi-currency-usd widget-icon text-success"></i>
            </div>
            <h5 class="text-white font-weight-normal mt-0" title="<?php echo get_phrase('Available balance to withdrawal');
                                                                  ?>"><?php echo get_phrase('Available balance to withdrawal');
                                                                      ?></h5>
            <?php
            $view = $te - $total_withdraw_amount;
            if ($view > 0) :
            ?>
              <h3 class="mt-3"><span class="text-white"><i class="mdi mdi-arrow-down-bold"></i></span> <?php echo currency($view);
                                                                                                        ?></h3>

              <button type="button" class="btn btn-customwith bn" data-bs-toggle="modal" data-bs-target="#exampleModal"> Request a withdrawal </button>

            <?php else :
            ?>
              <h3 class="mt-3 mb-3"><span class="text-white"><i class="mdi mdi-arrow-down-bold"></i></span> <?php echo currency("0");
                                                                                                            ?></h3>
            <?php endif;
            ?>
          </div> <!-- end card-body-->
        </div> <!-- end card-->
      </div> <!-- end col-->
    </div>

    <ul class="purchase-history-list">
      <?php if ($course_affiliation_tableinfo->num_rows() > 0) : ?>

        <table class="table" id="Affiliate_Earning_History">

          <caption class="table_cap">
            <h4>Affiliate Earning History :</h4>
          </caption>



          <thead>
            <tr>
              <th scope="col">Date</th>
              <th scope="col">Course name</th>
              <th scope="col">Actual Amount </th>
              <th scope="col">Earned Amount </th>
              <th scope="col">Note </th>
              <th scope="col">Commission Percentage </th>
              <th scope="col">Bought by </th>
            </tr>
          </thead>
        <?php endif; ?>

        <tbody>
          <?php if ($course_affiliation_tableinfo->num_rows() > 0) :

            foreach ($course_affiliation_tableinfo->result_array() as $each_history) : ?>






              <?php
              $user_name = $this->db->get_where('users', array('id' => $each_history['buyer_id']))->row_array();
              $course_name = $this->db->get_where('course', array('id' => $each_history['course_id']))->row_array();

              ?>

              <tr>
                <td scope="row"> <?php echo date('m/d/Y', $each_history['date_added']) ?></td>
                <td><?php echo $course_name['title'] ?></td>
                <td><?php echo $each_history['actual_amount'] ?></td>
                <td><?php echo $each_history['amount'] ?></td>
                <td><?php echo $each_history['note'] ?></td>
                <td><?php echo $each_history['percentage'] ?></td>
                <td><?php echo $user_name['first_name'] ?></td>

              </tr>

              <?php $count = $count + $each_history['amount']; ?>








            <?php endforeach; ?>
        </tbody>

        </table>

        <span  class="clr" ><b>Export</b></span>
        <button class="btn btn-custom" id="download-button">CSV</button>
        <button class="btn btn-custom" onclick="Export()">PDF </button>



      <?php else : ?>
        <li>
          <div class="row">

            <div class="col-md-12 text-center">
              <img class="imp" src="<?php echo base_url('assets/image/no_data_found.png'); ?>" alt="<?php echo site_phrase('no_records_found'); ?>" width="400px" >


            </div>
          </div>
        </li>
      <?php endif; ?>


    </ul>

  </div>







  <br> <br>


  <div class="container">


    <?php if ($w->num_rows() > 0) : ?>
      <table class="table" id="Withdrawal_History">
        <caption class="table_cap">
          <h4> Withdrawal History :</h4>
        </caption>

        <thead>
          <tr>
            <th scope="col">Date</th>
            <th scope="col">Amount</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>

          </tr>
        </thead>
        <tbody>

          <?php foreach ($w->result_array() as $withdrale_history) : ?>

            <tr>

              <td><?php echo date("Y-m-d", (int)$withdrale_history['date']); ?></td>
              <td><?php echo $withdrale_history['amount'] ?></td>
              <td><?php echo $withdrale_history['status'] ?></td>
              <?php if ($withdrale_history['status'] == "pending") : ?>


                <td><a href="#" onclick="confirm_modal('cancel_user_pending_course/?userid=<?php echo $withdrale_history['user_id'] ?>');" type="button" class="btn btn-danger">
                    <i class="fa fa-times"></i>


                  </a></td>
              <?php else : ?>

                <td><?php echo "" ?></td>
              <?php endif; ?>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

      <span class="clr"><b>Export</b></span>
      <button class="btn btn-custom" id="download_csv">CSV</button>
      <button class="btn btn-custom" onclick="Export1()">PDF </button>
    <?php else : ?>
      <ul class="purchase-history-list">
        <li>
          <div class="row" class="text-center">
            <?php echo site_phrase(''); ?>
          </div>
        </li>
      </ul>
    <?php endif; ?>



  </div>

  <style>


  </style>

</section>






<!--modal  for payment status table  request Modal -->




<!-- modal for withdrawl request Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Withdrawal Available Earning</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <form action="<?php echo site_url('addons/affiliate_course/withdrawl_request_for_course_amount'); ?>" method="post" id="withdrawl">

          <div class="form-group">
            <label for="withdrawlv"><?php echo site_phrase('Request Withdrawl'); ?> <span id="check_mobile_response_else" class=text-success> </span><span id="check_mobile_response_if" class=text-danger> </span> </label>
            <div class="input-group">
              <span class="input-group-text bg-white" for="withdrawl_reff"> <i class="fas fa-dollar-sign"></i> </span>
              <input type="number" step="any" name="withdrawl_reff" max=<?= $view ?> class="form-control" placeholder="<?php echo site_phrase('Enter Withdrawl Amount'); ?>" id="withdrawl_reff" required>

            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-custom">Send Withdrawl Request</button>
          </div>

        </form>
      </div>

    </div>
  </div>
</div>
<style>
  .btn-customwith {
    color: #fff;
    background-color: #19619c;

    padding: 7.5px 10px;
    border-radius: 10px !important;
    line-height: 0.8;
    font-weight: 600;
    margin-left: 5px !important;
  }

  .btn-custom {
    color: #fff;
    background-color: #19619c;

    padding: 7.5px 10px;
    border-radius: 10px !important;
    line-height: 1.35135;
    font-weight: 600;
    margin-left: 5px !important;
  }

  .btn-custom:hover {
    background-color: #c33333;
    color: white;
  }

  .btn-customwith:hover {
    background-color: #c33333;
    color: white;
  }
</style>

<script type="text/javascript">

"use strict";

function Export() {
      html2canvas(document.getElementById('Affiliate_Earning_History'), {
        onrendered: function(canvas) {
          var data = canvas.toDataURL();
          var docDefinition = {
            content: [{
              image: data,
              width: 500
            }]
          };
          pdfMake.createPdf(docDefinition).download("Affiliate_Earning_History.pdf");
        }
      });
    }

function Export1() {
    html2canvas(document.getElementById('Withdrawal_History'), {
      onrendered: function(canvas) {
        var data = canvas.toDataURL();
        var docDefinition = {
          content: [

            {
              image: data,
              width: 800
            }
          ]

        };
        pdfMake.createPdf(docDefinition).download("Withdrawal_History.pdf");
      }
    });
  }

  function downloadCSVFile(csv, filename) {
    var csv_file, download_link;

    csv_file = new Blob([csv], {
      type: "text/csv"
    });

    download_link = document.createElement("a");

    download_link.download = filename;

    download_link.href = window.URL.createObjectURL(csv_file);

    download_link.style.display = "none";

    document.body.appendChild(download_link);

    download_link.click();
  }

  document.getElementById("download-button").addEventListener("click", function() {
    var html = document.querySelector("#Affiliate_Earning_History").outerHTML;
    htmlToCSV(html, "Affiliate_Earning_History.csv");
  });





  function htmlToCSV(html, filename) {
    var data = [];
    var rows = document.querySelectorAll("#Affiliate_Earning_History tr");

    for (var i = 0; i < rows.length; i++) {
      var row = [],
        cols = rows[i].querySelectorAll("td, th");

      for (var j = 0; j < cols.length; j++) {
        row.push(cols[j].innerText);
      }

      data.push(row.join(","));
    }



    downloadCSVFile(data.join("\n"), filename);
  }


  document.getElementById("download_csv").addEventListener("click", function() {
    var html = document.querySelector("#Withdrawal_History").outerHTML;
    htmlToCSV2(html, "Withdrawal_History.csv");
  });


  function htmlToCSV2(html, filename) {
    var data = [];
    var rows = document.querySelectorAll("#Withdrawal_History tr");

    for (var i = 0; i < rows.length; i++) {
      var row = [],
        cols = rows[i].querySelectorAll("td, th");

      for (var j = 0; j < cols.length - 1; j++) {
        row.push(cols[j].innerText);
      }

      data.push(row.join(","));
    }

   

    downloadCSVFile(data.join("\n"), filename);
  }
</script>