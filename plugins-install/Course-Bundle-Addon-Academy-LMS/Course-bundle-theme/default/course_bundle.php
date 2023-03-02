<section class="category-header-area bg-dark">
    <div class="container-lg breadcrumb-container" style="padding-bottom: 50px; padding-top: 50px;">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item display-6 fw-bold">
                <a href="<?php echo site_url('course_bundles'); ?>">
                    <?php echo site_phrase('Bundles'); ?>
                </a>
            </li>
            <li class="breadcrumb-item active text-light display-6 fw-bold">
                <?php echo site_phrase('course_bundles'); ?>
            </li>
          </ol>
        </nav>
    </div>
</section>

<section class="bg-white py-3">
    <div class="container-lg">
        <div class="row">
            <div class="col-md-6 py-2">
                <?php if(isset($search_string)): ?>
                    <span><?php echo site_phrase('found_number_of_bundles'); ?> : <?php echo count($course_bundles->result_array()); ?></span>
                <?php else: ?>
                    <span><?php echo site_phrase('showing_on_this_page'); ?> : <?php echo count($course_bundles->result_array()); ?></span>
                <?php endif; ?>
            </div>
            <div class="col-md-6">
                <div class="home-banner-wrap">
                    <form class="border rounded" action="<?= site_url('course_bundles/search/query'); ?>" method="get">
                        <div class="input-group">
                            <input type="text" class="form-control" name="string" value="<?php if(isset($search_string)) echo $search_string; ?>" placeholder="<?php echo site_phrase('search_for_bundle'); ?>">
                            <div class="input-group-append p-6px bg-white">
                                <button class="btn" type="submit"><?php echo site_phrase('search'); ?> <i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="category-course-list-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="category-course-list">

                    <div class="row justify-content-center">
                        <?php foreach($course_bundles->result_array() as $bundle):
                            $instructor_details = $this->user_model->get_all_user($bundle['user_id'])->row_array();
                            $course_ids = json_decode($bundle['course_ids']);
                            sort($course_ids);
                        ?>
                        <div class="col-md-8 col-lg-6 col-xl-4 mb-3">
                            <div class="course-box-wrap">
                                <div class="course-box border">
                                    <div class="course">
                                        <!--Bundle images-->
                                    </div>
                                    <a href="<?= site_url('bundle_details/'.$bundle['id'].'/'.slugify($bundle['title'])); ?>">
                                        <div class="card-header course-bundle-header pt-3">
                                            <h5 class="fw-bold"><?= $bundle['title']; ?></h5>
                                            <small class="text-muted text-13px"><?= count($course_ids).' '.site_phrase('courses'); ?></small>
                                        </div>
                                    </a>
                                    <div class="card-body">
                                        <div class="row course_bundle_box">
                                            <!--total price corses on this bundle-->
                                            <?php $total_courses_price = 0; ?>
                                            <?php foreach($course_ids as $key => $course_id):
                                                ++$key;
                                                $this->db->where('id', $course_id);
                                                $this->db->where('status', 'active');
                                                $course_details = $this->db->get('course')->row_array();

                                                if ($course_details['is_free_course'] != 1):
                                                    if ($course_details['discount_flag'] != 1): ?>
                                                        <?php $total_courses_price += $course_details['price'];
                                                    else:
                                                        $total_courses_price += $course_details['discounted_price'];
                                                    endif;
                                                endif;
                                                if($key <= 3): ?>
                                                    <div class="col-md-12 mb-2">
                                                        <div class="accordion" id="<?= 'example_'.$bundle['id'].$course_details['id']; ?>">
                                                            <a href="<?php echo site_url('home/course/'.rawurlencode(slugify($course_details['title'])).'/'.$course_details['id']); ?>" target="_blank">
                                                                <div class="card">
                                                                    <div class="card-header collapsed p-0" type="button" data-bs-toggle="collapse" data-target="#<?= 'course_'.$bundle['id'].$course_details['id']; ?>" aria-expanded="false" aria-controls="<?= 'course_'.$bundle['id'].$course_details['id']; ?>">
                                                                        <img src="<?php echo $this->crud_model->get_course_thumbnail_url($course_details['id']); ?>" alt="" class="img-fluid float-start min-height-50" width="60px;">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <p class="text-muted m-0 cursor-pointer text-15px">
                                                                                    <?= $course_details['title']; ?>

                                                                                    <?php if ($course_details['is_free_course'] == 1): ?>
                                                                                        <b><span class="float-end d-block"><?php echo site_phrase('free'); ?></span></b>
                                                                                    <?php else: ?>
                                                                                        <?php if ($course_details['discount_flag'] != 1): ?>
                                                                                            <b><span class="float-end d-block"><?php echo currency($course_details['price']); ?></span></b>
                                                                                        <?php else: ?>
                                                                                            <b><span class="float-end d-block"><?php echo currency($course_details['discounted_price']); ?></span></b>
                                                                                        <?php endif; ?>
                                                                                    <?php endif; ?>
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </div>
                                        <div class="row bundle-arrow-down text-center box-shadow-0 cursor-pointer" id="bundle_arrow_down_<?= $bundle['id']; ?>" onclick="toggleBundleCourses('<?= $bundle['id']; ?>', '<?= count($course_ids); ?>')">
                                            <div class="col-12 p-1"><i class="fas fa-angle-down"></i></div>
                                        </div>
                                        <div class="row bundle-slider closed" id="gif_loader_<?= $bundle['id']; ?>"></div>

                                        <!--Here is load more bundle-->
                                        <div class="row bundle-slider closed" id="course_of_bundle_<?= $bundle['id']; ?>"></div>
                                        <hr class="mt-1">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="w-50 float-start text-start text-muted text-12">
                                                    <?php //Bundle Rating
                                                        $ratings = $this->course_bundle_model->get_bundle_wise_ratings($bundle['id']);
                                                        $bundle_total_rating = $this->course_bundle_model->sum_of_bundle_rating($bundle['id']);
                                                        if ($ratings->num_rows() > 0) {
                                                            $bundle_average_ceil_rating = ceil($bundle_total_rating / $ratings->num_rows());
                                                        }else {
                                                            $bundle_average_ceil_rating = 0;
                                                        }
                                                    ?>
                                                    <div class="rating-row">
                                                        <?php for($i = 1; $i <= 5; $i++):?>
                                                            <?php if ($i <= $bundle_average_ceil_rating): ?>
                                                                <i class="fas fa-star filled text-warning"></i>
                                                            <?php else: ?>
                                                                <i class="fas fa-star text-ccc"></i>
                                                            <?php endif; ?>
                                                        <?php endfor; ?>
                                                        <br>
                                                        <span class="enrolled-num text-13px">
                                                            (<?php echo $ratings->num_rows().' '.site_phrase('students'); ?>)
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="w-50 float-end text-end text-muted">
                                                    <strike class="text-12"><?= currency($total_courses_price); ?></strike>
                                                    <span class="text-dark fw-bold"><?= currency($bundle['price']); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                        <div class="col-md-12 text-center">
                            <?php if($course_bundles->num_rows() <= 0):
                                echo site_phrase('no_result_found').' !';
                            endif; ?>
                        </div>
                    </div>
                </div>
                <nav>
                    <?= $this->pagination->create_links(); ?>
                </nav>
            </div>
        </div>
    </div>
</section>
<?php include "course_bundle_scripts.php"; ?>