<section>

    <link rel="stylesheet" href="<?php echo base_url() . 'assets/frontend/default/tutor_booking/new/css/vendors/bootstrap.min.css'; ?>">
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/frontend/default/tutor_booking/new/css/vendors/all.min.css'; ?>">
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/frontend/default/tutor_booking/new/css/vendors/slick.css'; ?>">
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/frontend/default/tutor_booking/new/css/style.css'; ?>">

    <link rel="stylesheet" href="<?php echo base_url() . 'assets/frontend/default/tutor_booking/new/css/vendors/select2.min.css'; ?>">
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/frontend/default/tutor_booking/new/css/vendors/swiper-bundle.min.css'; ?>">
    <script src="<?php echo base_url() . 'assets/global/toastr/toastr.min.js'; ?>"></script>
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/global/toastr/toastr.css' ?>">




    <?php $dynamic_date = 0 ?>

    <!-- Start Course Section -->
    <section class="alms-main">
        <div class="container">
            <div class="row justify-content-center">
                <!-- Main content -->
                <div class="col-md-8">
                    <div class="alms-courseDetails">
                        <!-- Tuto -->
                        <div class="tutorDetails">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <div class="tutorImg">
                                        <?php $tutor_details = $this->db->get_where('users', array('id' => $this->session->userdata('tutor_id')))->row_array(); ?>
                                        <img src="<?php echo $this->user_model->get_user_image_url($tutor_details['id']);
                                                    ?>" alt="" class="img-fluid" />
                                    </div>
                                </div>
                                <div class="col-md-6 pe-lg-0">
                                    <div class="tutorInfo">
                                        <div class="alms-post-author d-flex justify-content-start align-items-center flex-wrap">
                                            <div class="item-user2">
                                                <a href="#"><?php echo get_phrase($tutor_details['first_name']). " " . get_phrase($tutor_details['last_name']) ?></a>
                                            </div>
                                            <div class="item-rating">
                                                <i class="fas fa-star"></i>
                                                <p><?= $tutor_rating ?></p>
                                                <span><?= $number_of_rating ?></span>
                                            </div>
                                        </div>
                                        <p class="tutorAbout">
                                           <?php echo get_phrase($tutor_details['biography'])?>
                                        </p>
                                        <ul class="tutorDetail">
                                            <li class="d-flex align-items-center">
                                                <div class="icon">
                                                    <img src="assets/image/clock.svg" alt="" />
                                                </div>
                                                <p class="text"><?= $total_hours_taught ?>+ hours taught</p>
                                            </li>
                                            <li class="d-flex align-items-center">
                                                <div class="icon">
                                                    <img src="assets/image/repeatStudents.svg" alt="" />
                                                </div>
                                                <p class="text"><?= $total_student ?> students</p>
                                            </li>
                                        <?php if($tutor_rating > 4): ?>
                                            <li class="d-flex align-items-center">
                                                <div class="icon">
                                                    <img src="assets/image/quality.svg" alt="" />
                                                </div>
                                                <p class="text">Qualified teacher</p>
                                            </li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Availability -->
                        <?php $next_year = strtotime('+1 year');
                        $current_time = time();
                        $current_time =  strtotime("-1 day", $current_time); ?>

                        <div class="courseAvailability">
                            <h4 class="almsDetailsTitle"><?php echo get_phrase('Availability') ?></h4>
                            <!-- Arrows -->
                            <div class="courseArrow d-flex justify-content-between align-items-center flex-wrap mt-30">
                                <div class="couseSliderArrow position-relative">
                                    <div class="swiper-button-next" onclick="date_change('next')">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="6.027" height="11.729" viewBox="0 0 6.027 11.729">
                                            <path id="path9429" d="M2.685,291.965a.686.686,0,0,0-.638.543.976.976,0,0,0,.2.934l4.069,4.373-4.069,4.371a.944.944,0,0,0-.263.805.8.8,0,0,0,.452.66.574.574,0,0,0,.675-.2l4.659-5a.98.98,0,0,0,0-1.269l-4.659-5.005a.6.6,0,0,0-.426-.21Z" transform="translate(-1.976 -291.965)" fill="#066ac9" />
                                        </svg>
                                    </div>
                                    <div class="swiper-button-prev disabled" onclick="date_change('prev')">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="6.027" height="11.729" viewBox="0 0 6.027 11.729">
                                            <path id="path9429" d="M7.294,291.965a.686.686,0,0,1,.638.543.976.976,0,0,1-.2.934l-4.069,4.373,4.069,4.371a.944.944,0,0,1,.263.805.8.8,0,0,1-.452.66.574.574,0,0,1-.675-.2l-4.659-5a.98.98,0,0,1,0-1.269l4.659-5.005a.6.6,0,0,1,.426-.21Z" transform="translate(-1.976 -291.965)" fill="#066ac9" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="courseAvailabilityDate bg-softblue">
                                    <p id="date_show"> <?= date('d M', strtotime("+1 day", $current_time)) . " - " . date('d M', strtotime("+6 day", $current_time)) . " , " . date('Y', $current_time); ?></p>
                                </div>

                                <p id="week_first" class="d-none"> <?= date('d M Y', strtotime("+1 day", $current_time))  ?></p>
                                <p id="week_last" class="d-none"> <?= date('d M Y', strtotime("+6 day", $current_time))  ?></p>
                                
                            </div>

                            <!--Contert -->
                            <div class="availabilityContent">
                                <div class="swiper carouselControlsOnly">
                                    <div class="swiper-wrapper">

                                        <?php while ($current_time < $next_year) {
                                            $current_time = strtotime('+1 day', $current_time);         ?>
                                            <!-- Single Slide -->
                                            <div class="swiper-slide">
                                                <!-- Single item -->
                                                <div class="availItems d-flex flex-column">
                                                    <div class="header d-flex">
                                                        <div class="availDate">
                                                            <p class="weekDay"><?= date('l', $current_time); ?></p>
                                                            <p class="aDate"><?= date('d', $current_time); ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="body d-flex">
                                                        <div class="availOptions d-flex flex-column">

                                                            <?php $string_current_date = date('m/d/Y', $current_time);

                                                            if ($tutor_schedules->num_rows() > 0) :

                                                                $tutor_schedule = $tutor_schedules->result_array();
                                                                foreach ($tutor_schedule as $schedules) :
                                                                    $string_schedule_date = date('m/d/Y', $schedules['start_time']); ?>
                                                                   

                                                                        <?php if ($string_current_date == $string_schedule_date) :    ?>

                                                                            <?php $booking_details = $this->db->get_where('tutor_booking', array('id' => $schedules['booking_id']))->row_array(); ?>
                                                                            <?php $subject = $this->db->get_where('tutor_category', array('id' => $booking_details['category_id']))->row_array(); ?>

                                                                            <?php
                                                                            if ($booking_details['tution_class_type'] == 1) {
                                                                                $class = "online";
                                                                            } elseif ($booking_details['tution_class_type'] == 2) {
                                                                                $class = "offline";
                                                                            } elseif ($booking_details['tution_class_type'] == 3) {
                                                                                $class = " both online & offline";
                                                                            }


                                                                            $price_type = $booking_details['price_type'];
                                                                            $price = $booking_details['price'];



                                                                            ?>

                                                                            <?php if ($schedules['status'] == 0) : ?>

                                                                                <div onclick="book_schedule('<?= $schedules['id'] ?>','<?= $schedules['start_time'] ?>','<?= $subject['name'] ?>','<?= $booking_details['title'] ?>','<?= $class ?>','<?= $price ?>','<?= $price_type ?>','<?= $string_current_date ?>','<?=date('H:i ', $schedules['start_time'])?>','<?=date('H:i ', $schedules['end_time'])?>','<?= $schedules['end_time'] ?>')"  class="aBox tutorFree" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="<?= $booking_details['title'] . " , class is " . $class . " . Fee is " . $price . "  ( " . $price_type . " )"  ?>">
                                                                                    <p class="aTime"><?= date('H:i ', $schedules['start_time']) . " - " . date('H:i ', $schedules['end_time']); ?></p>
                                                                                    <p class="aClass"><?= $subject['name'] ?></p>
                                                                                </div>



                                                                            <?php elseif ($schedules['status'] == 1) : ?>

                                                                                <div class="aBox tutorBooked" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="This tutor is already
                                                           teaching during this slot">
                                                                                    <p class="aBooked">Booked</p>
                                                                                </div>

                                                                        <?php endif;
                                                                        endif;  ?>


                                                            <?php endforeach;
                                                            endif; ?>



                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        <?php    } ?>


                                    </div>
                                </div>
                            </div>
                            <a href="#" class="availabilityBtn mt-40" data-bs-toggle="modal" data-bs-target="#availabilityModal"><?php echo get_phrase('View_All_Availability')?></a>
                        </div>
                        <!-- Reviews -->
                        <div class="coureseReviews">
                            <div class="reviewHeader d-flex justify-content-between align-items-center flex-wrap">
                                <h4 class="almsDetailsTitle">Reviews <span><?php echo $total_review->num_rows() ?></span></h4>

                                <?php if($if_access_to_write_a_review && $already_wrote_a_review): ?>
                                <a href="#" class="courseReviewBtn" data-bs-toggle="modal" data-bs-target="#writeReviewModal"><?php echo get_phrase('Write_Review')?></a>
                                <?php endif; ?>
                                <?php if(!$already_wrote_a_review): ?>
                                <a href="#" class="courseReviewBtn" data-bs-toggle="modal" data-bs-target="#editReviewModal"><?php echo get_phrase('edit_Review')?></a>
                                <?php endif; ?>
                            </div>
                            <div class="reviewsBody">
                                <div class="row">


                                    <?php
                                    if ($total_review_short->num_rows() > 0 && $total_review_short->num_rows() <= 3) :

                                        $total_review_short = $total_review_short->result_array();
                                        foreach ($total_review_short as  $review_short) : ?>

                                      <?php $user = $this->db->get_where('users', array('id' =>  $review_short['user_id']))->row_array(); ?>


                                            <div class="col-lg-6">
                                                <div class="courseReviewItem">
                                                    <div class="item-rating">
                                                        <i class="fas fa-star"></i>
                                                        <p><?= $review_short['rating'] ?></p>
                                                    </div>
                                                    <p class="reviewContent">
                                                        <?= $review_short['review'] ?>
                                                    </p>
                                                    <div class="reviewAuthor">
                                                        <div >
                                                        <img src="<?php echo $this->user_model->get_user_image_url($review_short['user_id']);
                                                    ?>" alt="" class="img" />
                                                        </div>
                                                        <div class="content">
                                                            <h4><?= $user['first_name'] . " " . $user['last_name'] ?></h4>
                                                            <p><?= date('d M ',  (int)$review_short['date']); ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                    <?php endforeach;
                                    endif; ?>

                                </div>
                            </div>
                            <a href="#" class="allReviewBtn" data-bs-toggle="modal" data-bs-target="#reviewsModal">More Reviews</a>
                        </div>
                    </div>
                </div>
                <!-- Sidebar -->
                <div class="col-md-4">
                    <div class="sidebar-2">

                        <form action="<?php echo site_url('addons/tutor_booking/book_a_schedule'); ?>" method="post" name="tution_form" onsubmit="return validateForm()">
                            <div class="sidebarInputs d-flex flex-column">
                                <div class="current_date">
                                    <label for="almsDateTime" class="eForm-label">Date & Time</label>
                                    <input type="text" class="form-control eForm-control" id="current_date" name="current_date" placeholder="Select date & time" aria-label="Select date & time" data-bs-toggle="modal" data-bs-target="#availabilityModal" />
                                </div>

                                <input type="hidden" name="schedule_id_booking" id="schedule_id_booking">
                                <input type="hidden" name="schedule_start_date" id="schedule_start_date">
                                <input type="hidden" name="amount" id="amount">
                                <input type="hidden" name="booked_date" id="booked_date">
                                <div class="inputGroups">
                                    <label for="subject_book" class="eForm-label">Subject </label>
                                    <input type="text" class="form-control eForm-control" id="subject_book" placeholder="Subject Name" readonly />
                                </div>

                                <div class="inputGroups">
                                    <label for="title_book" class="eForm-label">Title </label>
                                    <input type="text" class="form-control eForm-control" id="title_book" placeholder="Topic title" readonly />
                                </div>

                                <div class="inputGroups">
                                    <label for="classs" class="eForm-label">Class Type </label>
                                    <input type="text" class="form-control eForm-control" id="classs" placeholder="Type of class " readonly />
                                </div>

                                <div class="inputGroups">
                                    <label for="Price" class="eForm-label">price </label>
                                    <input type="text" class="form-control eForm-control" id="Price" placeholder="Price" readonly />
                                </div>
                            </div>
                            <!-- Buttons -->
                            <button type="submit" class="cart-btn rLessonBtn">Request lesson</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Course Section -->

    <!-- Write Review Modal -->
    <div class="modal eModal fade" id="writeReviewModal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="reviewModal">
                        <div class="rm_header d-flex justify-content-between align-items-center">
                            <h4 class="almsDetailsTitle"><?php echo get_phrase('Write_a_Review') ?></h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="rm_body">

                            <form action="<?php echo site_url('addons/tutor_booking/reviewpost/' . $this->session->userdata('tutor_id')); ?>" method="post" enctype="multipart/form-data">
                                <div class="row">



                                    <div class="col-lg-6">

                                        <label for="rating" class="eForm-label eForm-label2">Rating</label>
                                        <select class="nice-select wide form-control eForm-control eForm-control2  " name="rating" id="rating">
                                            <option value="1">1 Star</option>
                                            <option value="2">2 Star</option>
                                            <option value="3">3 Star</option>
                                            <option value="4">4 Star</option>
                                            <option value="5">5 Star</option>
                                        </select>


                                    </div>


                                    <div class="col-12">
                                        <div class="inputGroups">
                                            <label for="eInputTextarea" class="eForm-label eForm-label2">Review</label>
                                            <textarea class="form-control eForm-control eForm-control2" name="review" id="eInputTextarea" placeholder="Type your keyword"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="allReviewBtn mt-40"> Submit Review </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal eModal fade" id="editReviewModal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="reviewModal">
                        <div class="rm_header d-flex justify-content-between align-items-center">
                            <h4 class="almsDetailsTitle"><?php echo get_phrase('edit_Review') ?></h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="rm_body">

                            <form action="<?php echo site_url('addons/tutor_booking/editreviewpost/' . $this->session->userdata('tutor_id').'/'.$this->session->userdata('user_id')); ?>" method="post" enctype="multipart/form-data">

                            <?php if($given_review->num_rows()==1): $already_given_review=$given_review->row_array(); ?>
                                <div class="row">



                                    <div class="col-lg-6">

                                        <label for="rating" class="eForm-label eForm-label2">Rating</label>
                                        <select class="nice-select wide form-control eForm-control eForm-control2  " name="rating" id="rating">
                                            <option value="1" <?php if($already_given_review['rating']==1): echo 'selected'; endif; ?>>1 Star</option>
                                            <option value="2" <?php if($already_given_review['rating']==2): echo 'selected'; endif; ?>>2 Star</option>
                                            <option value="3" <?php if($already_given_review['rating']==3): echo 'selected'; endif; ?>>3 Star</option>
                                            <option value="4" <?php if($already_given_review['rating']==4): echo 'selected'; endif; ?>>4 Star</option>
                                            <option value="5" <?php if($already_given_review['rating']==5): echo 'selected'; endif; ?>>5 Star</option>
                                        </select>


                                    </div>


                                    <div class="col-12">
                                        <div class="inputGroups">
                                            <label for="eInputTextarea" class="eForm-label eForm-label2">Review</label>
                                            <textarea class="form-control eForm-control eForm-control2" name="review" id="eInputTextarea" placeholder="Type your keyword"> <?= $already_given_review['review']?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <button type="submit" class="allReviewBtn mt-40"> update Review </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Reviews Modal -->
    <div class="modal fade" id="reviewsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="reviewModal">
                        <div class="rm_header d-flex justify-content-between align-items-center">
                            <h4 class="almsDetailsTitle">Reviews <span><?php echo $total_review->num_rows() ?></span></h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="rm_body d-flex flex-column">


                            <?php
                            if ($total_review->num_rows() > 0) :
                                $total_review = $total_review->result_array();
                                foreach ($total_review as $review) : ?>

                                    <?php $tutor_details = $this->db->get_where('users', array('id' => $review['user_id']))->row_array(); ?>

                                    <div class="reviewModalItem">
                                        <div class="header d-flex justify-content-between align-items-center">
                                            <div class="reviewAuthor">
                                                <div >

                                                <img src="<?php echo $this->user_model->get_user_image_url($review['user_id']);
                                                    ?>" alt="" class="img" />

                                                </div>
                                                <div class="content">
                                                    <h4><?= $tutor_details['first_name'] . " " . $tutor_details['last_name'] ?></h4>
                                                    <p><?= date('d M ',  (int)$review['date']); ?></p>
                                                </div>
                                            </div>
                                            <div class="item-rating">
                                                <i class="fas fa-star"></i>
                                                <p><?= $review['rating'] ?></p>
                                            </div>
                                        </div>

                                        <p class="reviewContent">
                                            <?= $review['review'] ?>
                                        </p>
                                    </div>

                            <?php endforeach;
                            endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Availability Modal -->
    <div class="modal eModal fade" id="availabilityModal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="reviewModal">
                        <div class="rm_header d-flex justify-content-between align-items-center">
                            <h4 class="almsDetailsTitle">Availability</h4>
                            <button type="button" id="close_modal" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="rm_body d-flex flex-column">
                            <!-- Arrows -->
                            <div class="courseArrow d-flex justify-content-between align-items-center flex-wrap">
                                <div class="couseSliderArrow position-relative">
                                    <div class="swiper-button-next" onclick="date_change('next')">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="6.027" height="11.729" viewBox="0 0 6.027 11.729">
                                            <path id="path9429" d="M2.685,291.965a.686.686,0,0,0-.638.543.976.976,0,0,0,.2.934l4.069,4.373-4.069,4.371a.944.944,0,0,0-.263.805.8.8,0,0,0,.452.66.574.574,0,0,0,.675-.2l4.659-5a.98.98,0,0,0,0-1.269l-4.659-5.005a.6.6,0,0,0-.426-.21Z" transform="translate(-1.976 -291.965)" fill="#066ac9" />
                                        </svg>
                                    </div>
                                    <div class="swiper-button-prev" onclick="date_change('prev')">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="6.027" height="11.729" viewBox="0 0 6.027 11.729">
                                            <path id="path9429" d="M7.294,291.965a.686.686,0,0,1,.638.543.976.976,0,0,1-.2.934l-4.069,4.373,4.069,4.371a.944.944,0,0,1,.263.805.8.8,0,0,1-.452.66.574.574,0,0,1-.675-.2l-4.659-5a.98.98,0,0,1,0-1.269l4.659-5.005a.6.6,0,0,1,.426-.21Z" transform="translate(-1.976 -291.965)" fill="#066ac9" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="courseAvailabilityDate bg-softblue">
                                    <p id="date_show_modal"> <?= date('d M', strtotime("+0 day", $current_time)) . " - " . date('d M', strtotime("+5 day", $current_time)) . " , " . date('Y', strtotime("-1 year", $current_time)); ?></p>

                                    
                                </div>
                            </div>
                            <!-- Contert -->

                            <?php $next_year = strtotime('+1 year');
                            $current_time = time();
                            $current_time =  strtotime("-1 day", $current_time); ?>

                            <div class="availabilityContent">
                                <div class="swiper carouselControlsOnly">
                                    <div class="swiper-wrapper">




                                        <?php while ($current_time < $next_year) {
                                            $current_time = strtotime('+1 day', $current_time);         ?>
                                            <!-- Single Slide -->
                                            <div class="swiper-slide">
                                                <!-- Single item -->
                                                <div class="availItems d-flex flex-column">
                                                    <div class="header d-flex">
                                                        <div class="availDate">
                                                            <p class="weekDay"><?= date('l', $current_time); ?></p>
                                                            <p class="aDate"><?= date('d', $current_time); ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="body d-flex">
                                                        <div class="availOptions d-flex flex-column">

                                                            <?php $string_current_date = date('m/d/Y', $current_time);

                                                            if ($tutor_schedules->num_rows() > 0) :

                                                                $tutor_schedule = $tutor_schedules->result_array();
                                                                foreach ($tutor_schedule as $schedules) :
                                                                    $string_schedule_date = date('m/d/Y', $schedules['start_time']);

                                                                    if ($string_current_date == $string_schedule_date) :   ?>

                                                                        <?php $booking_details = $this->db->get_where('tutor_booking', array('id' => $schedules['booking_id']))->row_array(); ?>
                                                                        <?php $subject = $this->db->get_where('tutor_category', array('id' => $booking_details['category_id']))->row_array(); ?>
                                                                        <?php
                                                                        if ($booking_details['tution_class_type'] == 1) {
                                                                            $class = "online";
                                                                        } elseif ($booking_details['tution_class_type'] == 2) {
                                                                            $class = "offline";
                                                                        } elseif ($booking_details['tution_class_type'] == 3) {
                                                                            $class = " both online & offline";
                                                                        }


                                                                        $price_type = $booking_details['price_type'];
                                                                        $price = $booking_details['price'];



                                                                        ?>

                                                                        <?php if ($schedules['status'] == 0) : ?>

                                                                            <div onclick="book_schedule('<?= $schedules['id'] ?>','<?= $schedules['start_time'] ?>','<?= $subject['name'] ?>','<?= $booking_details['title'] ?>','<?= $class ?>','<?= $price ?>','<?= $price_type ?>','<?= $string_current_date ?>','<?=date('H:i ', $schedules['start_time'])?>','<?=date('H:i ', $schedules['end_time'])?>','<?= $schedules['end_time'] ?>')"  class="aBox tutorFree" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="<?= $booking_details['title'] . " , class is " . $class . " . Fee is " . $price . "  ( " . $price_type . " )"  ?>">
                                                                                <p class="aTime"><?= date('H:i ', $schedules['start_time']) . " - " . date('H:i ', $schedules['end_time']); ?></p>
                                                                                <p class="aClass"><?= $subject['name'] ?></p>
                                                                            </div>



                                                                        <?php elseif ($schedules['status'] == 1) : ?>

                                                                            <div class="aBox tutorBooked" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="This tutor is already
                                                           teaching during this slot">
                                                                                <p class="aBooked"><?php echo get_phrase('booked')?></p>
                                                                            </div>

                                                            <?php endif;
                                                                    endif;
                                                                endforeach;
                                                            endif; ?>



                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        <?php    } ?>




                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->

    <script src="<?php echo base_url(); ?>assets/frontend/default/tutor_booking/new/js/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/frontend/default/tutor_booking/new/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/frontend/default/tutor_booking/new/js/main.js"></script>
    <script src="<?php echo base_url(); ?>assets/frontend/default/tutor_booking/new/js/swiper-bundle.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/frontend/default/tutor_booking/new/js/select2.min.js"></script>
    <script>

     

        function validateForm() {
        let x = document.forms["tution_form"]["current_date"].value;
        if (x == "") {
            toastr.error('select a schedule First');
            return false;
        }
        }
        // Fot tooltips
        const tooltipTriggerList = document.querySelectorAll(
            '[data-bs-toggle="tooltip"]'
        );
        const tooltipList = [...tooltipTriggerList].map(
            (tooltipTriggerEl) => new bootstrap.Tooltip(tooltipTriggerEl)
        );

        // Carousel controls only
        var swiperOnly = new Swiper(".carouselControlsOnly", {
            slidesPerView: 3,
            slidesPerGroup: 3,
            loop: true,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            breakpoints: {
                640: {
                    slidesPerView: 3,
                    slidesPerGroup: 3,
                },
                768: {
                    slidesPerView: 4,
                    slidesPerGroup: 4,
                },
                1024: {
                    slidesPerView: 6,
                    slidesPerGroup: 6,
                },
            },
        });
        // Select2 js
        $(document).ready(function() {
            $(".eChoice-multiple-without-remove").select2({
                placeholder: "Select a state",
            });
        });
        $(document).ready(function() {
            $(".eChoice-multiple-with-remove").select2();
        });







        var count1 = 6;
        var count2 = 6;
        var variable = 1;


        const monthNames = ["Jan", "Febr", "Mar", "Apr", "May", "Jun",
            "Jul", "Aug", "Sept", "Oct", "Nov", "Dec"
        ];

        var date;
        var date2;
        var variable=1;
        var compare_date1;
        var compare_date2;
        var comp;
        var now_time;
        var value;


        $(document).ready(function() {

             date= new Date($("#week_first").text());
             date2= new Date($("#week_last").text());
             now_time=new Date();

              compare_date1 = date.getFullYear()+"-"+(date.getMonth()+1)+"-"+ date.getDate();
              compare_date2 = now_time.getFullYear()+"-"+(now_time.getMonth()+1)+"-"+ now_time.getDate();



             if(compare_date1 == compare_date2) 
             {
        
               $('.swiper-button-prev').addClass("d-none");

             }

            });

    
        function date_change(step) 
        {
           
            

            if(step=='prev')
            {
                date.setDate(date.getDate() - count1 );
                date2.setDate(date2.getDate() - count2 );
                
            }

            if(step=='next')
            {
                date.setDate(date.getDate() + count1 );
                date2.setDate(date2.getDate() + count2 );
                
            }
            var month1 = monthNames[date.getMonth()];
            var month2 = monthNames[date2.getMonth()];
                value = date.getDate() + " " + month1 + " - " + date2.getDate() + " " + month2 + " , " + date.getFullYear();
                comp= date.getFullYear()+"-"+(date.getMonth()+1)+"-"+ date.getDate();
                console.log(comp)
                console.log(compare_date2)

             
                if(compare_date2 != comp)
                {
                    $('.swiper-button-prev').removeClass("d-none");
                }
                else
                {
                    $('.swiper-button-prev').addClass("d-none");
                }
            

         

            $("#date_show").html(value);
            $("#date_show_modal").html(value);




        }


        function book_schedule(id, time, subject, title, classs, price, price_type,current_date,start_time,endtime,time2) {
            $("#schedule_id_booking").val(id);
            var date = new Date(time * 1000);
            $("#schedule_start_date").val(date);
            $("#subject_book").val(subject);
            $("#title_book").val(title);
            $("#classs").val(classs);
            $("#current_date").val(current_date+" "+start_time+" to "+endtime);
            $("#booked_date").val(current_date+" "+start_time+" to "+endtime);
      


      
            var hour;
            var diff1=new Date(parseInt(time));
            var diff2=new Date(parseInt(time2));
            var Difference_In_Time = (diff2.getTime() - diff1.getTime()) / 1 ;
            hour=Difference_In_Time/3600;
         
             console.log(hour)

             if(price_type=='hourly')
             {
                var new_price=price*hour;
                $("#Price").val(new_price + " (" + price_type + ")");

                $("#amount").val(new_price);


             }
             else
             {
                $("#Price").val(price + " (" + price_type + ")");
                $("#amount").val(price);
             }

             $( "#close_modal" ).trigger( "click" );

             toastr.success('schedule has selected');



        
        }

 

 
    </script>