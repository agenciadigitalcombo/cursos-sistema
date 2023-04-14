<section>

    <link rel="stylesheet" href="<?php echo base_url() . 'assets/frontend/default/tutor_booking/new/css/vendors/bootstrap.min.css'; ?>">
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/frontend/default/tutor_booking/new/css/vendors/all.min.css'; ?>">
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/frontend/default/tutor_booking/new/css/vendors/slick.css'; ?>">
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/frontend/default/tutor_booking/new/css/style.css'; ?>">
    <script src="<?php echo base_url() . 'assets/global/toastr/toastr.min.js'; ?>"></script>
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/global/toastr/toastr.css' ?>">

    <?php
    isset($searched_word) ? "" : $searched_word = "";
    isset($searched_main_category) ? "" : $searched_main_category = array();
    isset($searched_sub_category) ? "" : $searched_sub_category = array();
    isset($searched_price_type) ? "" : $searched_price_type = array();
    isset($searched_tution_class_type) ? "" : $searched_tution_class_type = array();
    isset($searched_tutors) ? "" : $searched_tutors = array();
    isset($searched_duration) ? "" : $searched_duration = array();
    isset($searched_price) ? "" : $searched_price = "";
    isset($highest_price) ? "" : $highest_price = 100;
    isset($price_min) ? "" : $price_min = 1;
    isset($price_max) ? "" : $price_max = $highest_price;

    isset($price_range_style_left) ? "" : $price_range_style_left = "0%";
    isset($price_range_style_right) ? "" : $price_range_style_right = "0%";

    ?>

    <style>
        .slider .progress {
            height: 100%;
            left: <?= $price_range_style_left ?>;
            right: <?= $price_range_style_right ?>;
            position: absolute;
            border-radius: 5px;
            background: #ec5252;
        }
    </style>

    <section class="alms-main">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-3 col-md-4">
                    <div class="sidebar">
                        <div class="lms-sidebarHeader d-flex justify-content-between align-items-center">
                            <h4 class="title">Filters</h4>
                            <div class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18.663" height="18.663" viewBox="0 0 18.663 18.663">
                                    <path id="primary" d="M4.851,3V15.96m0,0A1.851,1.851,0,1,0,6.7,17.812,1.851,1.851,0,0,0,4.851,15.96ZM11.331,6.7v12.96M11.331,3a1.851,1.851,0,1,0,1.851,1.851A1.851,1.851,0,0,0,11.331,3Zm6.48,10.183v6.48m0-10.183V3m0,6.48a1.851,1.851,0,1,0,1.851,1.851A1.851,1.851,0,0,0,17.812,9.48Z" transform="translate(20.663 -2) rotate(90)" fill="none" stroke="#0b162d" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                                </svg>
                            </div>
                        </div>
                        <div class="lms-sidebarBody">
                            <div class="sidebar-search">
                                <form id="filter_data_search" action="<?php echo site_url('tutor/filter'); ?>" method="get">

                                    <?php $value = "";
                                    if ($searched_word != "") {
                                        $value = $searched_word;
                                    } ?>
                                    <input type="search" name="searched_word" placeholder="" value="<?= $value ?>">

                                    <?php if (!empty($searched_main_category)) :
                                        foreach ($searched_main_category as  $main_categories) : ?>

                                            <input type="hidden" name="searched_main_category[]" value="<?= $main_categories ?>">
                                    <?php endforeach;
                                    endif; ?>

                                    <?php if (!empty($searched_sub_category)) :
                                        foreach ($searched_sub_category as  $sub_categories) : ?>

                                            <input type="hidden" name="searched_sub_category[]" value="<?= $sub_categories ?>">
                                    <?php endforeach;
                                    endif; ?>

                                    <?php if (!empty($searched_price_type)) :
                                        foreach ($searched_price_type as  $price) : ?>

                                            <input type="hidden" name="searched_price_type[]" value="<?= $price ?>">
                                    <?php endforeach;
                                    endif; ?>

                                    <?php if (!empty($searched_tution_class_type)) :
                                        foreach ($searched_tution_class_type as  $tution_class_type) : ?>

                                            <input type="hidden" name="searched_tution_class_type[]" value="<?= $tution_class_type ?>">
                                    <?php endforeach;
                                    endif; ?>

                                    <?php if (!empty($searched_tutors)) :
                                        foreach ($searched_tutors as  $tutor) : ?>

                                            <input type="hidden" name="searched_searched_tutors[]" value="<?= $tutor ?>">
                                    <?php endforeach;
                                    endif; ?>

                                    <?php if (!empty($searched_duration)) :
                                        foreach ($searched_duration as  $duration) : ?>

                                            <input type="hidden" name="searched_searched_duration[]" value="<?= $duration ?>">
                                    <?php endforeach;
                                    endif; ?>
                                    <img src="<?php echo base_url("assets/frontend/default/tutor_booking/new/image/search-icon-2.png"); ?>" alt="" class="img-fluid" />
                                </form>
                            </div>


                            <form id="filter_data" action="<?php echo site_url('tutor/filter'); ?>" method="get">
                                <input type="hidden" name="searched_word" value="<?= $searched_word ?>" placeholder="Search Tution">

                                <div class="sidebar-content-2">
                                    <h3 class="sidebar-title"><?= get_phrase('tution_type') ?></h3>
                                    <div class="alms-checkbox">
                                        <div class="form-check">

                                            <input id="online" name="searched_tution_class_type[]" class="form-check-input" type="checkbox" onchange="document.getElementById('filter_data').submit()" value="1" <?php if (in_array(1, $searched_tution_class_type)) echo 'checked' ?>>
                                            <div class="form-check-content">
                                                <label class="form-check-label" for="online">
                                                    <?= get_phrase('online') ?>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-check">
                                            <input id="in_Person" name="searched_tution_class_type[]" class="form-check-input" type="checkbox" onchange="document.getElementById('filter_data').submit()" value="2" <?php if (in_array(2, $searched_tution_class_type)) echo 'checked' ?>> <label for="in_Person">
                                                <div class="form-check-content">
                                                    <label class="form-check-label" for="in_Person">
                                                        <?= get_phrase('In Perosn') ?>
                                                    </label>
                                                </div>
                                        </div>
                                    </div>
                                </div>



                                <div class="sidebar-content-2">
                                    <h3 class="sidebar-title"><?= get_phrase('Main Category') ?></h3>
                                    <div class="alms-checkbox">
                                        <?php

                                        if ($data_base_main_category->num_rows() > 0) :
                                            $data_base_main_category = $data_base_main_category->result_array();
                                            $main_cat_counter = 0;
                                            foreach ($data_base_main_category as $category) :
                                                $unique_main = "main_cat_" . $category['id'];

                                        ?>

                                                <div class="form-check">

                                                    <input id="<?= $unique_main ?>" class="form-check-input" value="<?= $category['id'] ?>" <?php if (in_array($category['id'], $searched_main_category)) echo 'checked'; ?> name="searched_main_category[]" onchange="document.getElementById('filter_data').submit()" type="checkbox">
                                                    <div class="form-check-content">
                                                        <label class="form-check-label" for="<?= $unique_main ?>">
                                                            <?= get_phrase($category['name']) ?>
                                                        </label>
                                                    </div>
                                                </div>

                                        <?php endforeach;
                                        endif; ?>

                                    </div>
                                </div>


                                <div class="sidebar-content-2">
                                    <h3 class="sidebar-title"><?= get_phrase('Sub Category') ?></h3>
                                    <div class="alms-checkbox">


                                        <?php
                                        if ($data_base_sub_category->num_rows() > 0) :
                                            $data_base_sub_category = $data_base_sub_category->result_array();
                                            $sun_cat_counter = 0;
                                            foreach ($data_base_sub_category as $category) :
                                                $unique_sub = "sub_cat_" . $category['id'];

                                        ?>

                                                <div class="form-check">

                                                    <input id="<?= $unique_sub ?>" class="form-check-input" value="<?= $category['id'] ?>" name="searched_sub_category[]" <?php if (in_array($category['id'], $searched_sub_category)) echo 'checked'; ?> onchange="document.getElementById('filter_data').submit()" type="checkbox"> <label for="<?= $unique_sub ?>">
                                                        <div class="form-check-content">
                                                            <label class="form-check-label" for="<?= $unique_sub ?>">
                                                                <?= get_phrase($category['name']) ?>
                                                            </label>
                                                        </div>
                                                </div>

                                        <?php $sun_cat_counter++;
                                            endforeach;
                                        endif; ?>

                                    </div>
                                </div>
                                <div class="sidebar-content-2">
                                    <h3 class="sidebar-title"><?= get_phrase('By Price') ?></h3>
                                    <div class="priceRange">
                                        <div class="slider">
                                            <div class="progress"></div>
                                        </div>
                                        <div class="range-input">
                                            <input type="range" class="range-min" name='price_min' min="1" onchange="document.getElementById('filter_data').submit()" max="<?= $highest_price + 10 ?>" value="<?= $price_min ?>" step="1" />
                                            <input type="range" class="range-max" name='price_max' min="1" onchange="document.getElementById('filter_data').submit()" max="<?= $highest_price + 10 ?>" value="<?= $price_max ?>" step="1" />

                                            <input type="hidden" name="price_range_style_left" id="price_range_style_left" />
                                            <input type="hidden" name="price_range_style_right" id="price_range_style_right" />
                                        </div>
                                        <div class="price-input">
                                            <p><?= get_phrase('Price: $') ?></p>
                                            <div class="field">
                                                <input type="number" class="input-min" value="<?= (int)$price_min ?>" />
                                            </div>
                                            <div class="separator">-</div>
                                            <div class="field">
                                                <input type="number" class="input-max" value="<?= (int)$price_max ?>" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="sidebar-content-2">
                                    <h3 class="sidebar-title"><?= get_phrase('Price type') ?></h3>
                                    <div class="alms-checkbox">



                                        <div class="form-check">

                                            <input id="hourly" class="form-check-input" name="searched_price_type[]" type="checkbox" onchange="document.getElementById('filter_data').submit()" value="hourly" <?php if (in_array('hourly', $searched_price_type)) echo 'checked' ?>>
                                            <div class="form-check-content">
                                                <label class="form-check-label" for="hourly">
                                                    <?= get_phrase('hourly') ?>
                                                </label>
                                            </div>
                                        </div>


                                        <div class="form-check">

                                            <input id="fixed" class="form-check-input" name="searched_price_type[]" type="checkbox" onchange="document.getElementById('filter_data').submit()" value="fixed" <?php if (in_array('fixed', $searched_price_type)) echo 'checked' ?>>
                                            <div class="form-check-content">
                                                <label class="form-check-label" for="fixed">
                                                    <?= get_phrase('fixed') ?>
                                                </label>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                                <div class="sidebar-content-2">
                                    <h3 class="sidebar-title"><?= get_phrase('Tutors') ?></h3>
                                    <div class="alms-checkbox">


                                        <?php
                                        if (!empty($tutors)) :
                                            $tutor_count = 0;
                                            foreach ($tutors as $tutor) :
                                                $tutor = $this->db->get_where('users', array('id' => $tutor))->row_array();

                                                $unique_id = "tutor_" . $tutor['id'];
                                        ?>

                                                <div class="form-check">

                                                    <input id="<?= $unique_id ?>" class="form-check-input" name="searched_tutors[]" <?php if (in_array($tutor['id'], $searched_tutors)) echo 'checked' ?> onchange="document.getElementById('filter_data').submit()" value="<?= $tutor['id'] ?>" type="checkbox">
                                                    <div class="form-check-content">
                                                        <label class="form-check-label" for="<?= $unique_id ?>">
                                                            <?= get_phrase($tutor['first_name'] . " " . get_phrase($tutor['last_name']))     ?>
                                                        </label>
                                                    </div>
                                                </div>

                                        <?php $tutor_count++;
                                            endforeach;
                                        endif; ?>

                                    </div>
                                </div>


                                <div class="sidebar-content-2">
                                    <h3 class="sidebar-title"><?= get_phrase('Tution availability') ?></h3>
                                    <div class="alms-checkbox">



                                        <div class="form-check">

                                            <input id="single_time" class="form-check-input" name="searched_duration[]" onchange="document.getElementById('filter_data').submit()" value="1" type="checkbox" <?php if (in_array("1", $searched_duration)) echo 'checked' ?>>
                                            <div class="form-check-content">
                                                <label class="form-check-label" for="single_time">
                                                    <?= get_phrase('Single Time') ?>
                                                </label>
                                            </div>
                                        </div>


                                        <div class="form-check">
                                            <input id="selected_days" class="form-check-input" name="searched_duration[]" onchange="document.getElementById('filter_data').submit()" value="0" type="checkbox" <?php if (in_array("0", $searched_duration)) echo 'checked' ?>>
                                            <div class="form-check-content">
                                                <label class="form-check-label" for="selected_days">
                                                    <?= get_phrase('Selected Days ') ?>
                                                </label>
                                            </div>
                                        </div>



                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>


                <div class="col-lg-9 col-md-8">



                    <?php
                    if ($up_coming_schedules->num_rows() > 0) :
                        $up_coming_schedules = $up_coming_schedules->result_array();
                        foreach ($up_coming_schedules as $schedule) :

                            $total_review = $this->tutor_booking_model->get_tutor_review($schedule['tutor_id']);
                            $number_of_rating = $total_review->num_rows();
                            $tutor_rating = 0;

                            if ($total_review->num_rows() > 0) {
                                $rating_count = $total_review->result_array();

                                foreach ($rating_count as $rating) {
                                    $tutor_rating += $rating['rating'];
                                }

                                $tutor_rating = $tutor_rating / $number_of_rating;
                                $tutor_rating = round($tutor_rating, 1);
                            }
                    ?>




                            <div class="alms-post-wrap">

                                <div class="alms-box-2">

                                    <!-- Image -->
                                    <?php $tutor = $this->db->get_where('users', array('id' => $schedule['tutor_id']))->row_array(); ?>
                                    <div class="alms-box-img-grid">
                                        <img src="<?php echo $this->user_model->get_user_image_url($tutor['id']);
                                                    ?>" alt="" class="img-fluid" />
                                    </div>

                                    <div class="alms-box-content-grid">
                                        <!-- User & Price -->

                                        <div class="alms-post-author d-flex justify-content-between align-items-center flex-wrap">
                                            <div class="item-user">
                                                <a href="#"><?= get_phrase($tutor['first_name'] . " " . get_phrase($tutor['last_name']))     ?></a>
                                            </div>
                                            <div class="alms-price">
                                                <p class="alms-offer-price"><?= currency($schedule['price']) ?></p>
                                                <p class="price-time"><?= get_phrase($schedule['price_type'])  ?></p>
                                            </div>
                                        </div>

                                        <!-- Title -->
                                        <div class="alms-post-content">
                                            <a class="alms-box-title"><?= get_phrase($schedule['title']) ?></a>
                                        </div>
                                        <!-- Tag -->
                                        <?php if ($schedule['tution_class_type'] == 1)
                                            $c_type = "online";
                                        elseif ($schedule['tution_class_type'] == 2)
                                            $c_type = "in person";
                                        elseif ($schedule['tution_class_type'] == 3)
                                            $c_type = "online & offline";
                                        ?>
                                        <?php $category_name = $this->db->get_where('tutor_category', array('id' => $schedule['category_id']))->row('name'); ?>
                                        <?php $sub_category_name = $this->db->get_where('tutor_category', array('id' => $schedule['sub_category_id']))->row('name'); ?>
                                        <div class="tag-favourite">
                                            <a href="#" class="item-tag"><?= get_phrase($category_name) ?></a>
                                            <a href="#" class="item-tag"><?= get_phrase($sub_category_name) ?></a>
                                            <a href="#" class="item-tag"><?= get_phrase($c_type) ?></a>
                                        </div>
                                        <div class="seperate"></div>
                                        <!-- Rating & Button -->
                                        <div class="lms-rating-btn">
                                            <div class="item-rating">
                                                <i class="fas fa-star"></i>
                                                <p><?= get_phrase($tutor_rating) ?></p>
                                                <span><? get_phrase($number_of_rating) ?></span>
                                            </div>
                                            <?php
                                            $date_for_search_schedule = strtotime(Date('Y-m-d\TH:i'));
                                            $this->db->where('start_time > ', $date_for_search_schedule);
                                            $this->db->where('booking_id', $schedule['id']);
                                            $this->db->where('status', 0);
                                            $schedule_count = $this->db->get('tutor_schedule')->num_rows();

                                            ?>
                                            <div class="button">
                                                <a href="<?php echo site_url('schedules_bookings/' . $schedule['tutor_id']); ?>" class="cart-btn"><?= get_phrase('available_schedules') ?> : <?= get_phrase($schedule_count + 1) ?> </a>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>


                        <?php endforeach;
                        ?>
                    <?php else : ?>
                        <div class=" text-center mt-5">
                            <img class="mb-3 mt-5 " width="180px" src="<?php echo base_url("assets/frontend/default/tutor_booking/new/image/no_result_found.png"); ?>" />
                           

                            <br>
                            <span class="">
                              <?= get_phrase('No_result_found')?>
                            </span>
                        </div>

                    <?php endif; ?>

                </div>
            </div>
            <?= $this->pagination->create_links(); ?>
        </div>
    </section>
    <!-- End Course Section -->

    <script src="<?php echo base_url(); ?>assets/frontend/default/tutor_booking/new/js/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/frontend/default/tutor_booking/new/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/frontend/default/tutor_booking/new/js/main.js"></script>
    <script>
        "use strict";
        $(document).ready(function() {
            $("#filter_data").on("change", "input:checkbox", function() {
                $("#filter_data").submit();
            });
        });

        const rangeInput = document.querySelectorAll(".range-input input"),
            priceInput = document.querySelectorAll(".price-input input"),
            range = document.querySelector(".slider .progress");
        let priceGap = 2;

        priceInput.forEach((input) => {
            input.addEventListener("input", (e) => {
                let minPrice = parseInt(priceInput[0].value),
                    maxPrice = parseInt(priceInput[1].value);



                if (
                    maxPrice - minPrice >= priceGap &&
                    maxPrice <= rangeInput[1].max
                ) {
                    if (e.target.className === "input-min") {
                        rangeInput[0].value = minPrice;
                        range.style.left = (minPrice / rangeInput[0].max) * 100 + "%";
                    } else {
                        rangeInput[1].value = maxPrice;
                        range.style.right =
                            100 - (maxPrice / rangeInput[1].max) * 100 + "%";

                        $('#price_range_style_left').val(range.style.left);
                        $('#price_range_style_right').val(range.style.right);
                    }
                }
            });
        });

        rangeInput.forEach((input) => {
            input.addEventListener("input", (e) => {
                let minVal = parseInt(rangeInput[0].value),
                    maxVal = parseInt(rangeInput[1].value);



                if (maxVal - minVal < priceGap) {
                    if (e.target.className === "range-min") {
                        rangeInput[0].value = maxVal - priceGap;
                    } else {
                        rangeInput[1].value = minVal + priceGap;
                    }
                } else {
                    priceInput[0].value = minVal;
                    priceInput[1].value = maxVal;


                    range.style.left = (minVal / rangeInput[0].max) * 100 + "%";
                    range.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + "%";

                    $('#price_range_style_left').val(range.style.left);
                    $('#price_range_style_right').val(range.style.right);


                }
            });
        });
    </script>
</section>