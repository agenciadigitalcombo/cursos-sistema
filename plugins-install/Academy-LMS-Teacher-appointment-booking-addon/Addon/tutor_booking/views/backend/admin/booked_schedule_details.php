
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-3 header-title"><?php echo get_phrase('booked_schedule'); ?></h4>
                <div class="table-responsive-sm mt-4">
                    <table id="basic-datatable" class="table table-striped table-centered mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><?php echo get_phrase('Date'); ?></th>
                                <th><?php echo get_phrase('Title'); ?></th>
                                <th><?php echo get_phrase('Category'); ?></th>
                                <th><?php echo get_phrase('Class Type'); ?></th>
                                <th><?php echo get_phrase('price_type'); ?></th>
                                <th><?php echo get_phrase('price'); ?></th>
                                <th><?php echo get_phrase('tutor'); ?></th>

                                <th><?php echo get_phrase('Tution type'); ?></th>
                                <th><?php echo get_phrase('Selected days'); ?></th>
                                <th><?php echo get_phrase('Booked By'); ?></th>
                            
                              
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if($schedules->num_rows()>0):
                            foreach ($schedules->result_array() as $key => $schedule) : ?>

                               <?php $booking = $this->db->get_where('tutor_booking', array('id' => $schedule['booking_id']))->row_array();?>

                
                                <tr>
                                    <td><?php echo $key + 1; ?></td>

                                         <td>
                                            <?php echo  date('m-d-Y', (int)$schedule['start_time']); ?>
                                            <small>
                                                <p><?php echo get_phrase('Time '); ?>: <span ><?php echo  date('h:i A', (int)$schedule['start_time'])." - ".date('h:i A', (int)$schedule['end_time']) ; ?></span></p>
                                            </small>
                                    
                                    
                                        </td>
                               
                                    <td><?php echo get_phrase($booking['title']); ?></td>

                                    <?php
                                    if($booking['category_id']!=0):
                                     $category_name = $this->db->get_where('tutor_category', array('id' => $booking['category_id']))->row_array(); ?>
                                      <td><?php echo get_phrase($category_name['name']); ?>

                                      <?php else :  ?>

                                        <td><?php echo get_phrase('no category')?>


                                     <?php endif;  if($booking['sub_category_id']!=0): 

                                         $sub_category_name = $this->db->get_where('tutor_category', array('id' => $booking['sub_category_id']))->row_array();  ?>  
                                         <small>
                                                <p><span><?php  echo get_phrase($sub_category_name['name']); ?></span></p>
                                          </small>
                                            
                                            
                                            </td>

                                               <?php else :  ?>
                                        <small>
                                                <p><span><?php  echo get_phrase('no sub_category') ?></span></p>
                                          </small>
                                    </td>


                                     <?php endif;  ?>  

                                     <?php if($booking['tution_class_type']==1)
                                               $c_type="online";
                                           elseif($booking['tution_class_type']==2)   
                                                $c_type="in person";
                                            elseif($booking['tution_class_type']==3)   
                                                 $c_type="online / offline";
                                      ?> 

                                     

                                     <td><?php echo  get_phrase($c_type); ?></td>
                                     
                                     <td><?php echo get_phrase($booking['price_type']); ?></td>

                                     <td><?php echo currency($booking['price']); ?></td>

                                     <?php 
                                      $user_details = $this->db->get_where('users', array('id' => $booking['tutor_id']))->row_array();?>

                                     <td><?php echo get_phrase($user_details['first_name']." ".$user_details['last_name']); ?></td>

                       

                                    <?php if($schedule['tuition_type']==1): ?> 
                                    <td><?php echo get_phrase('one time') ?></td>
                                    <?php elseif($schedule['tuition_type']==7): ?> 
                                    <td><?php echo get_phrase('everyday') ?></td>
                                    <?php elseif($schedule['tuition_type']==0): ?> 
                                    <td><?php echo get_phrase('selected_days') ?></td>
                                    <?php endif; ?> 

                                    <?php if($schedule['tuition_type']==0):
                                    $days=json_decode($schedule['selected_days']);  ?> 
                                    <td>
                                       <?php foreach ($days as $day) {  ?>
                                       <?php echo get_phrase($day.",") ?>
                                     <?php } ?>
                                     </td>
                                    <?php else: ?> 
                                    <td><?php echo get_phrase('N').get_phrase('A') ?></td>
                                    <?php endif; ?> 

                                    <?php 
                                      $user_details = $this->db->get_where('users', array('id' => $schedule['student_id']))->row_array();?>

                                      <td><?php echo get_phrase($user_details['first_name']." ".$user_details['last_name']); ?></td>

                                     
                                

                                </tr>
                            <?php endforeach; endif; ?>
                            
                        </tbody>
                    </table>
                </div>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>