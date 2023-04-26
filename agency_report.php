<?php

    $login = get_page_by_path("agency-account");
    $login_id = $login->ID;
    $login_perma = get_permalink($login_id);

    if(!$_SESSION['email']){
        wp_redirect($login_perma);
    }

    global $wpdb; 
    $table_name = $wpdb->prefix."agency_shifts"; 

    $shift_report = $wpdb->get_results("SELECT * FROM $table_name WHERE Email = '$_SESSION[email]'");
?>


<div class="card cards">
    <div class="card-header" style = "border-top-left-radius: 20px; border-top-right-radius: 20px;">
    <h4>Shifts Report</h4>
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
                        <h6><?php echo $shift->Description; ?></h6>
                        <h6>Service:   <?php echo $shift->Services; ?></h6>
                        <h6>Start Date:   <?php echo $shift->Start; ?></h6>
                        <h6
                        style = "color: <?php if ($shift->Status =="new") {
                        echo "blue";
                        }else if ($shift->Status =="running") {
                            echo "green";

                        }else if ($shift->Status =="closed") {
                            echo "black";

                        }else if ($shift->Status =="pending") {
                            echo "gray";

                        }else if ($shift->Status =="rejected") {
                            echo "red";
                        }
                        ?>" 
                        ><?php echo $shift->Status; ?></h6>
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













































































































