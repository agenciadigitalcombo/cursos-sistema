<?php
	if(file_exists('uploads/course_bundle/banner/'.$bundle_details['banner'])):
		$bundle_banner = base_url('uploads/course_bundle/banner/'.$bundle_details['banner']);
	else:
		$bundle_banner = base_url('uploads/course_bundle/banner/thumbnail.png');
	endif;

	//Bundle Rating
	$ratings = $this->course_bundle_model->get_bundle_wise_ratings($bundle_details['id']);
	$bundle_total_rating = $this->course_bundle_model->sum_of_bundle_rating($bundle_details['id']);
	if ($ratings->num_rows() > 0) {
		$bundle_average_ceil_rating = ceil($bundle_total_rating / $ratings->num_rows());
	}else {
		$bundle_average_ceil_rating = 0;
	}
?>

<section class="course-header-area bundle-bg-image py-5" style="background-image: url('<?= $bundle_banner; ?>');">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-9 col-lg-10 p-1 position-sticky">
				<div class="course-bundle-details-header">
					<p class="title fw-bolder"><?php echo $bundle_details['title']; ?></p>

					<p class="created-by">
						<?php echo site_phrase('created_by'); ?>
						<a class="by-name" href="<?php echo site_url('home/instructor_page/'.$bundle_details['user_id']); ?>">
							<span class="badge bg-info p-2"><?php echo $instructor_details['first_name'].' '.$instructor_details['last_name']; ?></span>
						</a>
						<span class="last-updated-date"><?php echo date('D, d-M-Y', $bundle_details['date_added']); ?></span>
					</p>
				</div>

				<div class="rating-row my-3">
					<?php for($i = 1; $i <= 5; $i++):?>
						<?php if ($i <= $bundle_average_ceil_rating): ?>
							<i class="fas fa-star filled text-warning"></i>
						<?php else: ?>
							<i class="fas fa-star"></i>
						<?php endif; ?>
					<?php endfor; ?>
					<span class="enrolled-num">
						(<?php echo $ratings->num_rows().' '.site_phrase('students'); ?>)
					</span>
				</div>

				<p class="w-100"><?= site_phrase('total').' <b>'.count(json_decode($bundle_details['course_ids'])).'</b> '.site_phrase('courses_included'); ?></p>
			</div>
			<div class="col-md-3 col-lg-2 p-1">
				<div href="javascript:;" class="bundle-buy-button text-center py-4">
					<p class="text-15 text-dark"><?= site_phrase('subscription'); ?> <?= $bundle_details['subscription_limit']; ?> <?= site_phrase('days'); ?></p>
					<hr class="m-1">
					<?php if(get_bundle_validity($bundle_details['id'], $this->session->userdata('user_id')) == 'invalid'): ?>
						<a href="<?= site_url('course_bundles/buy/'.$bundle_details['id']); ?>" class="btn btn-danger rounded"><?= currency($bundle_details['price']); ?> | <?= site_phrase('buy'); ?></a>
					<?php elseif(get_bundle_validity($bundle_details['id'], $this->session->userdata('user_id')) == 'expire'): ?>
						<a href="<?= site_url('course_bundles/buy/'.$bundle_details['id']); ?>" class="btn btn-danger rounded"><?= currency($bundle_details['price']); ?> | <?= site_phrase('renew'); ?></a>
					<?php else: ?>
						<a href="<?= site_url('home/my_bundles'); ?>" class="btn btn-secondary rounded"><?= site_phrase('purchased'); ?></a>
					<?php endif; ?>
				</div>
			</div>
		</div>
			
	</div>
</section>


<section class="course-content-area">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-9">
				<h3 class="my-3 pt-3"><?= site_phrase('included_courses'); ?></h3>
				<div class="row justify-content-center">
					<?php foreach(json_decode($bundle_details['course_ids']) as $key => $course_id):
					$this->db->where('id', $course_id);
	                $this->db->where('status', 'active');
	                $course = $this->db->get('course')->row_array();
		                
	                $instructor_details = $this->user_model->get_all_user($course['user_id'])->row_array();
			        $course_duration = $this->crud_model->get_total_duration_of_lesson_by_course_id($course['id']);
			        $lessons = $this->crud_model->get_lessons('course', $course['id']);
	                if($course == null) continue;
	                ?>

					<div class="col-md-6 col-lg-4 p-0">
						<div class="course-box-wrap">
			                <a target="_blank" href="<?php echo site_url('home/course/' . rawurlencode(slugify($course['title'])) . '/' . $course['id']); ?>" class="has-popover">
			                    <div class="course-box">
			                        <div class="course-image">
			                        	<?php if ($course['is_free_course'] == 1) : ?>
		                                    <p class="price text-right d-inline-block float-end"><?php echo site_phrase('free'); ?></p>
		                                <?php else : ?>
		                                    <?php if ($course['discount_flag'] == 1) : ?>
		                                        <p class="price text-right d-inline-block float-end"><small><del><?php echo currency($course['price']); ?></del></small><?php echo currency($course['discounted_price']); ?></p>
		                                    <?php else : ?>
		                                        <p class="price text-right d-inline-block float-end"><?php echo currency($course['price']); ?></p>
		                                    <?php endif; ?>
		                                <?php endif; ?>

			                            <img src="<?php echo $this->crud_model->get_course_thumbnail_url($course['id']); ?>" alt="" class="img-fluid">
			                        </div>
			                        <div class="course-details">
			                        	<div class="row mb-3">
			                                <div class="col-12">
			                                    <span class="badge badge-primary text-11px"><?php echo site_phrase($course['level']); ?></span>
			                                </div>
			                            </div>

			                            <h5 class="title"><?php echo $course['title']; ?></h5>
			                            <div class="rating">
			                                <?php
			                                $total_rating =  $this->crud_model->get_ratings('course', $course['id'], true)->row()->rating;
			                                $number_of_ratings = $this->crud_model->get_ratings('course', $course['id'])->num_rows();
			                                if ($number_of_ratings > 0) {
			                                    $average_ceil_rating = ceil($total_rating / $number_of_ratings);
			                                } else {
			                                    $average_ceil_rating = 0;
			                                }

			                                for ($i = 1; $i < 6; $i++) : ?>
			                                    <?php if ($i <= $average_ceil_rating) : ?>
			                                        <i class="fas fa-star filled"></i>
			                                    <?php else : ?>
			                                        <i class="fas fa-star"></i>
			                                    <?php endif; ?>
			                                <?php endfor; ?>
			                                <div class="d-inline-block">
			                                    <span class="text-dark ms-1 text-12px">(<?php echo $average_ceil_rating; ?>)</span>
			                                    <span class="text-dark text-12px text-muted ms-2">(<?php echo $number_of_ratings.' '.site_phrase('reviews'); ?>)</span>
			                                </div>
			                            </div>

			                            <div class="row">
				                            <div class="col">
				                                <div class="floating-user d-inline-block">
				                                    <?php if ($course['multi_instructor']):
				                                        $instructor_details = $this->user_model->get_multi_instructor_details_with_csv($course['user_id']);
				                                        $margin = 0;
				                                        foreach ($instructor_details as $key => $instructor_detail) { ?>
				                                            <img style="margin-left: <?php echo $margin; ?>px;" class="position-absolute" src="<?php echo $this->user_model->get_user_image_url($instructor_detail['id']); ?>" width="30px" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo $instructor_detail['first_name'].' '.$instructor_detail['last_name']; ?>" onclick="event.stopPropagation(); $(location).attr('href', '<?php echo site_url('home/instructor_page/'.$instructor_detail['id']); ?>');">
				                                            <?php $margin = $margin+17; ?>
				                                        <?php } ?>
				                                    <?php else: ?>
				                                        <?php $user_details = $this->user_model->get_all_user($course['user_id'])->row_array(); ?>
				                                        <img src="<?php echo $this->user_model->get_user_image_url($user_details['id']); ?>" width="30px" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo $user_details['first_name'].' '.$user_details['last_name']; ?>" onclick="event.stopPropagation(); $(location).attr('href', '<?php echo site_url('home/instructor_page/'.$user_details['id']); ?>');">
				                                    <?php endif; ?>
				                                </div>
				                            </div>
				                            <div class="col">
				                            	<button class="btn-compare-sm float-end" onclick="event.stopPropagation(); $(location).attr('href', '<?php echo site_url('home/compare?course-1=' . rawurlencode(slugify($course['title'])) . '&&course-id-1=' . $course['id']); ?>');"><i class="fas fa-retweet"></i> <?php echo site_phrase('compare'); ?></button>
				                            </div>
				                        </div>

			                            <div class="w-100 d-flex text-dark border-top py-1">
			                                <div class="">
			                                    <i class="text-danger far fa-clock text-14px"></i>
			                                    <span class="text-muted text-12px"><?php echo $course_duration; ?></span>
			                                </div>
			                                <div class="ms-auto">
			                                    <i class="text-primary far fa-list-alt text-14px"></i>
			                                    <span class="text-muted text-12px"><?php echo $lessons->num_rows().' '.site_phrase('lectures'); ?></span>
			                                </div>
			                            </div>
			                        </div>
			                    </div>
			                </a>
			            </div>
					</div>
					<?php endforeach; ?>
				</div>
				<div class="description-box view-more-parent w-100">
					<div class="view-more" onclick="viewMore(this,'hide')">+ <?php echo site_phrase('view_more'); ?></div>
					<h3><?php echo site_phrase('description'); ?></h3>
					<div class="description-content-wrap">
						<div class="description-content">
							<?php echo $bundle_details['bundle_details']; ?>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-9">
				<div class="student-feedback-box">
					<div class="row">
						<div class="col-lg-3" style="text-align: -webkit-center;">
							<div class="average-rating mb-4">
								<div class="num">
									<?= $bundle_average_ceil_rating; ?>
								</div>
								<div class="rating">
									<?php for($i = 1; $i <= 5; $i++):?>
										<?php if ($i <= $bundle_average_ceil_rating): ?>
											<i class="fas fa-star filled text-warning"></i>
										<?php else: ?>
											<i class="fas fa-star"></i>
										<?php endif; ?>
									<?php endfor; ?>
								</div>
								<div class="title mb-3"><?php echo site_phrase('average_rating'); ?></div>
							</div>
						</div>
						<div class="col-lg-9">
							<div class="individual-rating">
								<ul>
									<?php for($i = 1; $i <= 5; $i++): ?>
										<?php $percentage_of_rating = $this->course_bundle_model->get_bundle_percentage_of_specific_rating($bundle_details['id'], $i); ?>
									<li>
										<div class="progress">
											<div class="progress-bar" style="width: <?= $percentage_of_rating; ?>%"></div>
											</div>
										<div style="min-width: 150px !important;">
											<span class="rating">
												<?php for($j = 1; $j <= (5-$i); $j++): ?>
													<i class="fas fa-star"></i>
												<?php endfor; ?>
												<?php for($j = 1; $j <= $i; $j++): ?>
													<i class="fas fa-star filled"></i>
												<?php endfor; ?>
											</span>
											<span><?php echo $percentage_of_rating; ?>%</span>
										</div>
									</li>
									<?php endfor; ?>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-9">
				<?php if(count($ratings->result_array()) > 0): ?>
					<h3><?= site_phrase('reviews'); ?></h3>
				<?php endif; ?>
				<?php foreach($ratings->result_array() as $rating):?>
					<hr class="">
					<div class="row mb-4">
						<div class="col-1">
							<img width="50" class="rounded-circle" src="<?php echo $this->user_model->get_user_image_url($rating['user_id']); ?>" alt="">
						</div>
						<div class="col-md-11">
							<p class="text-muted m-0">
								<?php $user_details = $this->user_model->get_user($rating['user_id'])->row_array();
								echo $user_details['first_name'].' '.$user_details['last_name']; ?>
							</p>
							<small class="text-muted"><?php echo date('D, d-M-Y', $rating['date_added']); ?></small>
							<div class="review-details float-end">
								<div class="rating">
									<?php for($i = 1; $i <= 5; $i++):?>
										<?php if ($i <= $rating['rating']): ?>
											<i class="fas fa-star filled text-warning"></i>
										<?php else: ?>
											<i class="fas fa-star"></i>
										<?php endif; ?>
									<?php endfor; ?>
								</div>
							</div>
							<p class="text-muted mt-2">
								<?php echo $rating['comment']; ?>
							</p>
						</div>
					</div>
				<?php endforeach; ?>
				
			</div>
		</div>
	</div>
</section>