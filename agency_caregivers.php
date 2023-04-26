<?php
    $login = get_page_by_path("agency-account");
    $login_id = $login->ID;
    $login_perma = get_permalink($login_id);

    if(!$_SESSION['email']){
        wp_redirect($login_perma);
    }

    global $wpdb; 
    $table_name = $wpdb->prefix."caregiver_apply"; 
    $id = $_SESSION["id"];
    $care = $wpdb->get_row("SELECT * FROM $table_name WHERE shift_id = $id AND approved = 1");
?>

 
<div class="card">  
    <div class="card-header" style = "border-top-left-radius: 20px; border-top-right-radius: 20px;">
    <h4><?php echo $_SESSION["name"];?></h4>
    </div>

    <div class="card-body">
    </div>
    <div class="card-body">
        <ul class="list-unstyled">
        <?php if($care){?>
           <li class="media">
                <img width = "50" height ="50" class="mr-3" src="<?php echo plugin_dir_url( __FILE__ ) . '/images/avatar.png'?>" alt="Generic placeholder image">
                <div class="media-body">
                    <a href ="#"><h5 style = "color: green;" class="mt-0 mb-1"><?php echo $care->caregiver; ?></h5></a>
                    <h6><?php echo $care->starting_date; ?></h6>
                    <h6><?php echo $care->Description; ?></h6>
                </div>
            </li>
        <?php } else {?>
            <p style = "text-align: center;">No approved caregivers</p>
        <?php } ?>
        </ul>
    </div>
</div>













































































































