<?php

    $login = get_page_by_path("caregiver-account");
    $login_id = $login->ID;
    $login_perma = get_permalink($login_id);

    if(!$_SESSION['caregiver']){
        wp_redirect($login_perma);
    }

    global $wpdb; 
    $table_name = $wpdb->prefix."caregiver_apply"; 

    $shift_report = $wpdb->get_results("SELECT * FROM $table_name WHERE email = '$_SESSION[caregiver]'");
?>
  
  
<div class="card">
    <div class="card-header" style = "border-top-left-radius: 20px; border-top-right-radius: 20px;">
    <h4>Caregiver report</h4>
    </div>
    <div class="card-body">
        <ul class="list-unstyled"> 
            <?php
               if($shift_report){
                 foreach ($shift_report as $shift){
            ?>
                <li class="media">
                    <img width = "70" height ="70" class="mr-3" src="<?php echo plugin_dir_url( __FILE__ ) . '/images/enhanced_carers.png'?>" alt="Generic placeholder image">
                    <div class="media-body">
                        <h5 class="mt-0 mb-1"><?php echo $shift->Shift; ?></h5>
                        <h6>Description: <?php echo $shift->Description; ?></h6>
                        <h6>Start Date:   <?php echo $shift->starting_date; ?></h6>
                        <h6 
                        style = "color: <?php if ($shift->approved ==1) {
                            echo "green";
 
                        }else if ($shift->approved ==0) {
                            echo "red";

                        }else if ($shift->approved ==5) {
                            echo "gray";

                        }
                        ?>" 
                        ><?php if($shift->approved == 0){
                            echo "Rejected";
                        }else if($shift->approved == 1){
                            echo "Approved";
                        }else{
                            echo "Pending";
                        }
                        ?></h6>
                    </div>
                </li>
                <hr>
                <?php
                }
            }else {?>
                <h6 style = "text-align: center;">No data to show</h6>
            <?php
            }
            ?>
        </ul>
    </div>
</div>













































































































