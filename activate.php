<?php

    global $wpdb; 

    if ($_GET['type'] == 'agency') {
        $login = get_page_by_path("agency-account");
        $login_id = $login->ID;
        $login_perma = get_permalink($login_id);

        $table_name = $wpdb->prefix."agencies"; 
        $user = $wpdb->get_row("SELECT * FROM $table_name WHERE  Id = '$_GET[id]'");
    
    } else if ($_GET['type'] == 'caregiver') {
        $login = get_page_by_path("caregiver-account");
        $login_id = $login->ID;
        $login_perma = get_permalink($login_id);

        $table_name = $wpdb->prefix."caregiver"; 
        $user = $wpdb->get_row("SELECT * FROM $table_name WHERE Id = '$_GET[id]'");
    }
    
    
    if ($user->activate == 0) {
    ?>
      <div style = "margin: auto;">
        <h5>Activating...</h5>
      </div>
    <?php

        if ($_GET['type'] == 'agency') {
            $run = $wpdb->update($table_name, array("activate" => 1), array("Id" => $_GET["id"]));
            if($run){
                wp_redirect($login_perma);
            }

        }else if ($_GET['type'] == 'caregiver') {
            $run = $wpdb->update($table_name, array("activate" => 1), array("Id" => $_GET["id"]));
            if($run){
                wp_redirect($login_perma);
            }
        }


    } else if ($user->activate == 1){
        if ($_GET['type'] == 'agency') {
            wp_redirect($login_perma);

        }else if ($_GET['type'] == 'caregiver') {
            wp_redirect($login_perma);
        }
    } 
    