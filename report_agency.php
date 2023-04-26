<?php
    global $wpdb; 
    $table_name = $wpdb->prefix."agency_shifts"; 

    $agency_report = $wpdb->get_results("SELECT * FROM $table_name WHERE Status = 'closed'");
?>

 
<div class="card">
    <div class="card-header" style = "border-top-left-radius: 20px; border-top-right-radius: 20px;">
    <h4>Agency Report</h4>
    </div>
    <div class="card-body">
        <ul class="list-unstyled"> 
            <?php
               foreach ($agency_report as $agency){
            ?>
            <li class="media">
                <img width = "70" height ="70" class="mr-3" src="<?php echo plugin_dir_url( __FILE__ ) . '/images/enhanced_carers.png'?>" alt="Generic placeholder image">
                <div class="media-body">
                    <h5
                     style = "color: green" class="mt-0 mb-1"><?php echo $agency->Shift; ?></h5>
                    <h6><?php echo $agency->Description; ?></h6>
                    <h6><?php echo $agency->Start; ?></h6>
                </div>
            </li>
            <hr>
            <?php
            }
            ?>
        </ul>
    </div>
</div>
<button class = "button" style = "margin-top: 15px">Download pdf</button>












































































































