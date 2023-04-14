<script src="<?php echo base_url() . 'assets/global/toastr/toastr.min.js'; ?>"></script>
<link rel="stylesheet" href="<?php echo base_url() . 'assets/global/toastr/toastr.css' ?>">

<?php include "profile_menus.php"; ?>

<style>
    .btn-outline-info {
    color: #ec5252;
    border-color: #ec5252;
}

.btn-outline-info:hover {
    color: #000;
    background-color: #ec5252;
    border-color: #ec5252;
}
.nav-link {
    display: block;
    padding: 0.5rem 1rem;
    color: #ec5252;
    text-decoration: none;
    transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out;
}
</style>


<section class="user-dashboard-area">
    <div class="container">

        <ul class="nav nav-tabs nav-bordered mb-3" id="myTab" role="tablist">

            <li class="nav-item" role="presentation">

                <a href="" class="nav-link active" id="upcoming-tab" data-toggle="tab" data-target="#upcomingtable" role="tab" aria-controls="upcomingtable" aria-selected="false">

                    <?php echo get_phrase('upcoming '); ?><p class="badge bg-success ">
                        <?php echo $schedules->num_rows(); ?>
                    </p>


                </a>
            </li>


            <li class="nav-item" role="presentation">
                <a href="" class="nav-link" id="achieve-tab" data-bs-toggle="tab" data-bs-target="#achievetable" role="tab" aria-controls="achievetable" aria-selected="false">
                    <?php echo get_phrase('archive '); ?><p class="">
                    </p>
                    <span></span>
                </a>
            </li>

            <li class="nav-item" role="presentation">
                <a href="" class="nav-link" id="payment-tab" data-bs-toggle="tab" data-bs-target="#paymenttable" role="tab" aria-controls="paymenttable" aria-selected="false">
                    <?php echo get_phrase('payment '); ?><p class="">
                    </p>
                    <span></span>
                </a>
            </li>

        </ul>


        <div class="tab-content pb-2" id="nav-tabContent">
            <div class="tab-pane fade show active" id="upcomingtable" role="tabpanel" aria-labelledby="upcoming-tab">
                <?php if ($schedules->num_rows() > 0) : ?>


                    <table id="basic-datatable" class="table ">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><?php echo get_phrase('Title'); ?></th>
                                <th><?php echo get_phrase('Category'); ?></th>
                                <th><?php echo get_phrase('Class Type'); ?></th>
                                <th><?php echo get_phrase('price_type'); ?></th>
                                <th><?php echo get_phrase('price'); ?></th>
                                <th><?php echo get_phrase('tutor'); ?></th>
                                <th><?php echo get_phrase('Date'); ?></th>
                                <th><?php echo get_phrase('Join Class'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            foreach ($schedules->result_array() as $key => $schedule) : ?>

                                <?php $booking = $this->db->get_where('tutor_booking', array('id' => $schedule['booking_id']))->row_array(); ?>


                                <tr>
                                    <td><?php echo $key + 1; ?></td>

                                    <td><?php echo get_phrase($booking['title']); ?></td>

                                    <?php
                                    if ($booking['category_id'] != 0) :
                                        $category_name = $this->db->get_where('tutor_category', array('id' => $booking['category_id']))->row_array(); ?>
                                        <td><?php echo get_phrase($category_name['name']); ?>

                                        <?php else :  ?>

                                        <td><?php echo get_phrase('no category') ?>


                                        <?php endif;
                                    if ($booking['sub_category_id'] != 0) :

                                        $sub_category_name = $this->db->get_where('tutor_category', array('id' => $booking['sub_category_id']))->row_array();  ?>
                                            <small>
                                                <p><span><?php echo get_phrase($sub_category_name['name']); ?></span></p>
                                            </small>


                                        </td>

                                    <?php else :  ?>
                                        <small>
                                            <p><span><?php echo get_phrase('no sub_category') ?></span></p>
                                        </small>
                                        </td>


                                    <?php endif;  ?>

                                    <?php if ($booking['tution_class_type'] == 1)
                                        $c_type = "online";
                                    elseif ($booking['tution_class_type'] == 2)
                                        $c_type = "in person";
                                    elseif ($booking['tution_class_type'] == 3)
                                        $c_type = "online / offline";
                                    ?>



                                    <td><?php echo  get_phrase($c_type); ?></td>

                                    <td><?php echo get_phrase($booking['price_type']); ?></td>

                                    <td><?php echo currency($booking['price']); ?></td>

                                    <?php
                                    $user_details = $this->db->get_where('users', array('id' => $booking['tutor_id']))->row_array(); ?>

                                    <td><?php echo get_phrase($user_details['first_name'] . " " . $user_details['last_name']); ?></td>

                                    <td>
                                        <?php echo  date('m-d-Y', (int)$schedule['start_time']); ?>
                                        <small>
                                            <p><?php echo get_phrase('Time '); ?>: <span><?php echo  date('h:i A', (int)$schedule['start_time']) . " - " . date('h:i A', (int)$schedule['end_time']); ?></span></p>
                                        </small>


                                    </td>

                                    <?php
      
                                    if (($booking['tution_class_type'] == 1 || $booking['tution_class_type'] == 3)) :  ?>

                                        <td><a  class="btn btn-outline-info" href="<?php echo site_url('addons/tutor_booking/join/' . $schedule['id']) ?>" > <i class="fa fa-video"></i> <?php echo get_phrase('Join Class'); ?> </a></td>

                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; ?>



                        </tbody>
                    </table>


                <?php else : ?>
                <?php
                    echo   get_phrase('No data found');
                endif; ?>
            </div>

            <div class="tab-pane fade show " id="achievetable" role="tabpanel" aria-labelledby="achieve-tab">
                <?php if ($archieve_schedules->num_rows() > 0) : ?>


                    <table id="basic-datatable" class="table ">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><?php echo get_phrase('Title'); ?></th>
                                <th><?php echo get_phrase('Category'); ?></th>
                                <th><?php echo get_phrase('Class Type'); ?></th>
                                <th><?php echo get_phrase('price_type'); ?></th>
                                <th><?php echo get_phrase('price'); ?></th>
                                <th><?php echo get_phrase('tutor'); ?></th>
                                <th><?php echo get_phrase('Date'); ?></th>
                                <th><?php echo get_phrase('Join'); ?></th>


                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            foreach ($archieve_schedules->result_array() as $key => $schedule) : ?>

                                <?php $booking = $this->db->get_where('tutor_booking', array('id' => $schedule['booking_id']))->row_array(); ?>


                                <tr>
                                    <td><?php echo $key + 1; ?></td>

                                    <td><?php echo get_phrase($booking['title']); ?></td>

                                    <?php
                                    if ($booking['category_id'] != 0) :
                                        $category_name = $this->db->get_where('tutor_category', array('id' => $booking['category_id']))->row_array(); ?>
                                        <td><?php echo get_phrase($category_name['name']); ?>

                                        <?php else :  ?>

                                        <td><?php echo get_phrase('no category') ?>


                                        <?php endif;
                                    if ($booking['sub_category_id'] != 0) :

                                        $sub_category_name = $this->db->get_where('tutor_category', array('id' => $booking['sub_category_id']))->row_array();  ?>
                                            <small>
                                                <p><span><?php echo get_phrase($sub_category_name['name']); ?></span></p>
                                            </small>


                                        </td>

                                    <?php else :  ?>
                                        <small>
                                            <p><span><?php echo get_phrase('no sub_category') ?></span></p>
                                        </small>
                                        </td>


                                    <?php endif;  ?>

                                    <?php if ($booking['tution_class_type'] == 1)
                                        $c_type = "online";
                                    elseif ($booking['tution_class_type'] == 2)
                                        $c_type = "in person";
                                    elseif ($booking['tution_class_type'] == 3)
                                        $c_type = "online / offline";
                                    ?>



                                    <td><?php echo  get_phrase($c_type); ?></td>

                                    <td><?php echo get_phrase($booking['price_type']); ?></td>

                                    <td><?php echo  currency($booking['price']); ?></td>

                                    <?php
                                    $user_details = $this->db->get_where('users', array('id' => $booking['tutor_id']))->row_array(); ?>

                                    <td><?php echo get_phrase($user_details['first_name'] . " " . $user_details['last_name']); ?></td>

                                    <td>
                                        <?php echo  date('m-d-Y', (int)$schedule['start_time']); ?>
                                        <small>
                                            <p><?php echo get_phrase('Time '); ?>: <span><?php echo  date('h:i A', (int)$schedule['start_time']) . " - " . date('h:i A', (int)$schedule['end_time']); ?></span></p>
                                        </small>


                                    </td>

                                    <?php
                                    if (($booking['tution_class_type'] == 1 || $booking['tution_class_type'] == 3)) :  ?>

                                        <td><a href="<?php echo site_url('addons/tutor_booking/join/' . $schedule['id']) ?>" class="button"> <i class="mdi mdi-video"></i> <?php echo get_phrase('Join Class '); ?> </a></td>

                                    <?php endif; ?>

                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>


                <?php else : ?>
                <?php
                    echo   get_phrase('No data found');
                endif; ?>
            </div>

            <div class="tab-pane fade show " id="paymenttable" role="tabpanel" aria-labelledby="payment-tab">



                <?php if ($student_payments->num_rows() > 0) : ?>


                    <table id="basic-datatable" class="table ">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><?php echo get_phrase('Title'); ?></th>
                                <th><?php echo get_phrase('Tuition_date'); ?></th>
                                <th><?php echo get_phrase('amount'); ?></th>
                                <th><?php echo get_phrase('payment_type'); ?></th>
                                <th><?php echo get_phrase('payment_date'); ?></th>
                                <th><?php echo get_phrase('tutor'); ?></th>
                 


                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            foreach ($student_payments->result_array() as $key => $schedule) : ?>

                                <?php $booking = $this->db->get_where('tutor_booking', array('id' => $schedule['booking_id']))->row_array(); ?>


                                <tr>
                                    <td><?php echo $key + 1; ?></td>

                                    <?php $tuition = $this->db->get_where('tutor_schedule', array('id' => $schedule['schedule_id']))->row_array(); ?>

                                    <td><?php echo get_phrase($booking['title']); ?></td>

                                    <td>
                                        <?php echo  date('m-d-Y', (int)$tuition['start_time']); ?>
                                        <small>
                                            <p><?php echo get_phrase('Time '); ?>: <span><?php echo  date('h:i A', (int)$tuition['start_time']) . " - " . date('h:i A', (int)$tuition['end_time']); ?></span></p>
                                        </small>

                                    </td>
                                    <td><?php echo currency($schedule['amount']); ?></td>

                                    <td>
                                        <?php echo  get_phrase($schedule['payment_type']); ?>

                                    </td>

                                    <td>
                                    <?php echo   get_phrase(date('m-d-Y', (int)$schedule['date_added'])); ?>
                                    </td>



                                    <?php
                                    $user_details = $this->db->get_where('users', array('id' => $schedule['tutor_id']))->row_array(); ?>

                                    <td><?php echo get_phrase($user_details['first_name'] . " " . $user_details['last_name']); ?></td>

                                </tr>
                            <?php endforeach; ?>



                        </tbody>
                    </table>


                <?php else : ?>
                <?php
                    echo   get_phrase('No data found');
                endif; ?>
            </div>

        </div>


    </div>
</section>