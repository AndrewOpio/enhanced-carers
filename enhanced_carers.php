<?php
/*
Plugin Name: Enhanced Care Manager
Plugin URI: https://
Description: Enhanced carers.  
Version: 1.1.0
Author: Asterisk
Author URI: https://
License: 
Text Domain: enhanced carers
*/


if(!defined('ABSPATH')){
   exit;
}

register_activation_hook( __FILE__, 'add_pages' );

function add_pages(){ 

    if (get_page_by_title('Agency Account') == NULL) {
        $agency_auth = array(
            'post_title' => __('Agency Account'),
            'post_content' => '[agency_auth]',
            'post_status' => 'publish',
            'post_type' => 'page',
        );
        wp_insert_post($agency_auth);
    }


    if (get_page_by_title('Activate') == NULL) {
        $activate = array(
            'post_title' => __('Activate'),
            'post_content' => '[activate]',
            'post_status' => 'publish',
            'post_type' => 'page',
        );
        wp_insert_post($activate);
    }


    if (get_page_by_title('Caregiver Account') == NULL) {
        $caregiver_auth = array(
            'post_title' => __('Caregiver Account'),
            'post_content' => '[caregiver_auth]',
            'post_status' => 'publish',
            'post_type' => 'page',
        );
        wp_insert_post($caregiver_auth);
    }


    // if (get_page_by_title('Agency Login') == NULL) {
    //     $login = array(
    //         'post_title' => __('Agency Login'),
    //         'post_content' => '[login]',
    //         'post_status' => 'publish',
    //         'post_type' => 'page',
    //     );
    //     wp_insert_post($login);
    // }
    

    // if (get_page_by_title('Agency Registration') == NULL) {
    //     $signup = array(
    //         'post_title' => __('Agency Registration'),
    //         'post_content' => '[register]',
    //         'post_status' => 'publish',
    //         'post_type' => 'page',
    //     );
    //     wp_insert_post($signup);
    // }


    if (get_page_by_title('Assigned Caregiver') == NULL) {
        $agency_caregivers = array(
            'post_title' => __('Assigned Caregiver'),
            'post_content' => '[agency_caregivers]',
            'post_status' => 'publish',
            'post_type' => 'page',
        );
        wp_insert_post($agency_caregivers);
    }


    if (get_page_by_title('Dashboard') == NULL) {
        $dashboard = array(
            'post_title' => __('Dashboard'),
            'post_content' => '[dashboard]',
            'post_status' => 'publish',
            'post_type' => 'page',
        );    
        wp_insert_post($dashboard); 
    }

    if (get_page_by_title('Profile') == NULL) {
        $profile = array(
            'post_title' => __('Profile'),
            'post_content' => '[profile]',
            'post_status' => 'publish',
            'post_type' => 'page',
        );
        wp_insert_post($profile);
    }
 

    if (get_page_by_title('Report') == NULL) {
        $report = array(
            'post_title' => __('Report'),
            'post_content' => '[report]',
            'post_status' => 'publish',
            'post_type' => 'page',
        );
        wp_insert_post($report);
    }

    if (get_page_by_title('Caregiver report') == NULL) {
        $caregiver_report = array(
            'post_title' => __('Caregiver report'),
            'post_content' => '[caregiver-report]',
            'post_status' => 'publish',
            'post_type' => 'page',
        );
        wp_insert_post($caregiver_report);
    }

    if (get_page_by_title('Shifts') == NULL) {
        $shifts = array(
            'post_title' => __('Shifts'),
            'post_content' => '[agency_shifts]',
            'post_status' => 'publish',
            'post_type' => 'page',
        ); 
        wp_insert_post($shifts);
    }

    /*if (get_page_by_title('Caregiver registration') == NULL) {
        $care_registration = array(
            'post_title' => __('Caregiver registration'),
            'post_content' => '[caregiver-registration]',
            'post_status' => 'publish',
            'post_type' => 'page',
        );
        wp_insert_post($care_registration);
    }


    if (get_page_by_title('Caregiver login') == NULL) {
        $care_login = array(
            'post_title' => __('Caregiver login'),
            'post_content' => '[caregiver-login]',
            'post_status' => 'publish',
            'post_type' => 'page',
        );
        wp_insert_post($care_login);
    }*/


    if (get_page_by_title('Caregiver dashboard') == NULL) {
        $care_dashboard = array(
            'post_title' => __('Caregiver dashboard'),
            'post_content' => '[caregiver-dashboard]',
            'post_status' => 'publish',
            'post_type' => 'page',
        );
        wp_insert_post($care_dashboard);
    }


    if (get_page_by_title('Caregiver profile') == NULL) {
        $care_profile = array(
            'post_title' => __('Caregiver profile'),
            'post_content' => '[caregiver-profile]',
            'post_status' => 'publish',
            'post_type' => 'page',
        );
        wp_insert_post($care_profile);
    }


    if (get_page_by_title('Caregiver apply') == NULL) {
        $care_apply = array(
            'post_title' => __('Caregiver apply'),
            'post_content' => '[view-shift]',
            'post_status' => 'publish',
            'post_type' => 'page',
        );
        wp_insert_post($care_apply);
    }
}

 


register_activation_hook( __FILE__, 'add_tables' );

//creating table in wordpress database
function add_tables()
{

    global $wpdb; 
    /*$table_name = $wpdb->prefix."agencies"; 

    $table_name1 = $wpdb->prefix."shifts"; 

    $table_name12 = $wpdb->prefix."agency_shifts"; 

    $table_name13 = $wpdb->prefix."caregiver_apply"; 

    $table_name14 = $wpdb->prefix."caregiver"; 

    $wpdb->query("DROP table $table_name");

    $wpdb->query("DROP table $table_name1");

    $wpdb->query("DROP table $table_name12");

    $wpdb->query("DROP table $table_name13");

    $wpdb->query("DROP table $table_name14");*/


    //$wpdb->query("alter table $table_name drop column approved");

    //$wpdb->query("alter table $table_name add column approved int");


    $charset_collate = $wpdb->get_charset_collate();

    $table_name0 = $wpdb->prefix . "agencies"; 
    $sql0 = "CREATE TABLE IF NOT EXISTS $table_name0 (
     Id int NOT NULL AUTO_INCREMENT,
     Email LONGTEXT NOT NULL,
     Category LONGTEXT NOT NULL,
     Name LONGTEXT NOT NULL,
     Address LONGTEXT NOT NULL,
     Services LONGTEXT NOT NULL,
     Preferences LONGTEXT NOT NULL,
     Password MEDIUMTEXT NOT NULL,
     approved int DEFAULT 5,
     activate int DEFAULT 5,
     PRIMARY KEY  (Id)
   ) $charset_collate";
   require_once( ABSPATH .'wp-admin/includes/upgrade.php' );
   dbDelta( $sql0 );


    $table_name1 = $wpdb->prefix . "shifts"; 
     $sql1 = "CREATE TABLE IF NOT EXISTS $table_name1 (
      Id int NOT NULL AUTO_INCREMENT,
      Shift LONGTEXT NOT NULL,
      Description LONGTEXT NOT NULL,
      PRIMARY KEY  (Id)
    ) $charset_collate";
    require_once( ABSPATH .'wp-admin/includes/upgrade.php' );
    dbDelta( $sql1 );

    $table_name2 = $wpdb->prefix . "categories"; 
     $sql2 = "CREATE TABLE IF NOT EXISTS $table_name2 (
      Id int NOT NULL AUTO_INCREMENT,
      Category LONGTEXT NOT NULL,
      PRIMARY KEY  (Id)
    ) $charset_collate";
    require_once( ABSPATH .'wp-admin/includes/upgrade.php' );
    dbDelta( $sql2 );

    $table_name3 = $wpdb->prefix . "health"; 
     $sql3 = "CREATE TABLE IF NOT EXISTS $table_name3 (
      Id int NOT NULL AUTO_INCREMENT,
      Condtn LONGTEXT NOT NULL,
      Description LONGTEXT NOT NULL,
      PRIMARY KEY  (Id)
    ) $charset_collate";
    require_once( ABSPATH .'wp-admin/includes/upgrade.php' );
    dbDelta( $sql3 );

    $table_name4 = $wpdb->prefix . "services"; 
     $sql4 = "CREATE TABLE IF NOT EXISTS $table_name4 (
      Id int NOT NULL AUTO_INCREMENT,
      Service LONGTEXT NOT NULL,
      PRIMARY KEY  (Id)
    ) $charset_collate";
    require_once( ABSPATH .'wp-admin/includes/upgrade.php' );
    dbDelta( $sql4 );

    $table_name5 = $wpdb->prefix . "languages"; 
     $sql5 = "CREATE TABLE IF NOT EXISTS $table_name5 (
      Id int NOT NULL AUTO_INCREMENT,
      Language LONGTEXT NOT NULL,
      PRIMARY KEY  (Id)
    ) $charset_collate";
    require_once( ABSPATH .'wp-admin/includes/upgrade.php' );
    dbDelta( $sql5 );


    ##### edited #####
    $table_name6 = $wpdb->prefix . "agency_shifts"; 
    $sql6 = "CREATE TABLE IF NOT EXISTS $table_name6 (
      Id int NOT NULL AUTO_INCREMENT,
      Shift text NOT NULL,
      Description LONGTEXT NOT NULL,
      Email text NOT NULL,
      Category text NOT NULL,
      Language LONGTEXT NOT NULL,
      Condtn LONGTEXT NOT NULL,
      Services LONGTEXT NOT NULL,
      Start DATE NOT NULL,
      End DATE NOT NULL,
      Location LONGTEXT NOT NULL,
      Rate LONGTEXT NOT NULL,
      Status text NOT NULL, 
      approved int DEFAULT 5,
      PRIMARY KEY  (Id)
   ) $charset_collate";
   require_once( ABSPATH .'wp-admin/includes/upgrade.php' );
   dbDelta( $sql6 );


   $time = $_SERVER['REQUEST_TIME'];
   $table_name7 = $wpdb->prefix . "caregiver_apply"; 
   $sql7 = "CREATE TABLE IF NOT EXISTS $table_name7 (
     Id int NOT NULL AUTO_INCREMENT,
     caregiver text NOT NULL,
     Shift text NOT NULL,
     Description LONGTEXT NOT NULL,
     starting_date DATE NOT NULL,
     shift_id int NOT  NULL,
     approved int NOT NULL DEFAULT 5,
     email MEDIUMTEXT NOT NULL,
     PRIMARY KEY  (id) 
  ) $charset_collate";
  require_once( ABSPATH .'wp-admin/includes/upgrade.php' );
  dbDelta( $sql7 );

   $table_name8 = $wpdb->prefix . "caregiver"; 
   $sql8 = "CREATE TABLE IF NOT EXISTS $table_name8 (
     Id int NOT NULL AUTO_INCREMENT,
     name text NOT NULL,
     email LONGTEXT NOT NULL,
     DOB DATE NOT NULL,
     gender text NOT NULL,
     address LONGTEXT NOT NULL,
     #gender text NOT NULL,
     ID_type text NOT NULL, 
     ID_number text NOT NULL,
     care_cred text NOT NULL,
     gender_pref text NOT NULL,
     shift_pref text NOT NULL,
     health_pref text NOT NULL,
     languages text NOT NULL,
     services text NOT NULL,
     password text NOT NULL,
     activate int DEFAULT 5,
     PRIMARY KEY  (id)
  ) $charset_collate";
  require_once( ABSPATH .'wp-admin/includes/upgrade.php' );
  dbDelta( $sql8 );

    $table_name9 = $wpdb->prefix . "ID_types"; 
    $sql9 = "CREATE TABLE IF NOT EXISTS $table_name9 (
      Id int NOT NULL AUTO_INCREMENT,
      ID_type LONGTEXT NOT NULL,
      PRIMARY KEY  (Id)
    ) $charset_collate";
    require_once( ABSPATH .'wp-admin/includes/upgrade.php' );
    dbDelta( $sql9 );

}


//Registering agency
add_action('wp_ajax_register', 'register');
add_action( 'wp_ajax_nopriv_register', 'register' );

function register()
{
    global $wpdb; 
    $table_name = $wpdb->prefix."agencies"; 

    $check_user = $wpdb->get_results("SELECT * FROM $table_name WHERE Email = '$_POST[email]'");

    if (!$check_user) {
        $encrypt_password = md5($_POST['password']);
        $user = $wpdb->insert($table_name, array('Email'=>$_POST["email"], 'Category'=> $_POST["category"], 'Name'=> $_POST["name"], 'Address'=> $_POST["address"], 'Services'=> "", 'Password'=> $encrypt_password, 'approved' => 5,'activate' => 0),
        array('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s'));
        
        if($user){
            $user_id = $wpdb->get_row("SELECT * FROM $table_name WHERE Email = '$_POST[email]'");

            $headers = "From: ". get_option( 'admin_email' ) . "\r\n";
            $headers .= "Content-type: text/html; charset=UTF-8"."\r\n";

            $agency_email = $_POST["email"];
            $agency_subject = "Enhanced Carers Registration";
            $agency_message = "<h4>Your account has been created successfully</h4>
                               <h4>Click <a href ='https://www.enhancedcarers.com/activate?id=".$user_id->Id."&type=agency'>HERE</a> to activate your account.</h4>";
            $agency_status = mail($agency_email, $agency_subject, $agency_message, $headers);
    
            $admin_email = get_option( 'admin_email' );
            $admin_subject = "New Agency";
            $admin_message = "A new agency (".$_POST["name"].") has registered on Enhanced Carers";
            $admin_status = mail($admin_email, $admin_subject, $admin_message);
    
            echo "true";
        }else {
            echo "false";
        }

    } else {
        echo "exists";
    }
    
    wp_die(); 
}

 

add_action('wp_ajax_register_caregivers', 'register_caregivers');
add_action( 'wp_ajax_nopriv_register_caregivers', 'register_caregivers' );

function register_caregivers()
{ 
    global $wpdb;  
    $table_name = $wpdb->prefix."caregiver"; 

    $encrytped_password = md5($_POST['password']);
    $email = $_POST['email'];

    // $email_from = "trevodex@gmail.com";
    // $email_subject = "New form submission";
    // $email_body = "Name: $_POST['name'].\n".
    //               "Email: $_POST['email'].\n".
    //               "Date of birth: $_POST['dob'].\n";

    // $to_email = "angulotrevor@gmail.com";
    // $headers = "From: $email_from \r\n";
    // $headers  = "Reply-To: $email\r\n";

    // $secretkey = "6Lfkx9YbAAAAAB3JV9RGymKIp_v7Vju6xSWQWunn";
    // $responseKey = $_POST['g-recaptcha-resonse'];
    // $UserIP = $_SERVER['REMOTE_ADDR'];

    $today = date("Y-m-d");

    if($_POST["dob"] > $today){
         echo "high_age"; 
    }else if(($today - $_POST['dob']) < 18){
        echo "under_age"; 
    }else{
    $wpdb->insert($table_name, array('email'=>$_POST["email"], 'name'=> $_POST["name"], 'DOB'=> $_POST["dob"],
     'ID_type'=> $_POST["id_type"], 'ID_number'=> $_POST["id_num"],'gender_pref'=> $_POST["gender_pref"] ,
     'health_pref'=> $_POST["health_pref"], 'services'=> $_POST["services"], 'shift_pref'=> $_POST["shift_pref"], 
     'gender'=> $_POST["gender"], 'languages'=> $_POST["language"], 'password'=> $encrytped_password, 'address'=> $_POST["address"], 
     'care_cred' => $_POST["care_cred"], 'activate' => 0),    array('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s'));
    $wpdb->show_errors();

    $user_id = $wpdb->get_row("SELECT * FROM $table_name WHERE Email = '$_POST[email]'");

    $headers = "From: ". get_option( 'admin_email' ) . "\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8"."\r\n";

    $caregiver_email = $_POST["email"];
    $caregiver_subject = "Enhanced Carers Registration";
    $caregiver_message = "<h4>Your account has been created successfully</h4>
                          <h4>Click <a href ='https://www.enhancedcarers.com/activate?id =".$user_id->Id."&type=caregiver'>HERE</a> to activate your account.</h4>";
    $caregiver_status = mail($caregiver_email, $caregiver_subject, $caregiver_message, $headers);

    $admin_email = get_option( 'admin_email' );
    $admin_subject = "New Caregiver";
    $admin_message = "A new caregiver (".$_POST["name"].") has registered on Enhanced Carers";
    $admin_status = mail($admin_email, $admin_subject, $admin_message);

    echo "true";
}
    wp_die(); 

}



//login for agency
add_action('wp_ajax_login', 'login');
add_action( 'wp_ajax_nopriv_login', 'login' );

function login()
{
    global $wpdb; 
    $table_name = $wpdb->prefix."agencies"; 
    $email = $_POST['email'];
    $password = md5($_POST['password']);    

    $user = $wpdb->get_row("SELECT * FROM $table_name WHERE Email = '$email' AND Password = '$password'");

    if($user && $user->activate == 1){
        $_SESSION["email"] = $email;
        echo "approved";
        
    } else if($user && $user->activate == 0){
        echo "pending";

    } else {
        echo "false";
    }

    wp_die(); 
}



add_action('wp_ajax_logincare', 'login_care');
add_action( 'wp_ajax_nopriv_logincare', 'login_care' );

function login_care(){ 
    global $wpdb;  
    $table = $wpdb->prefix."caregiver"; 
    $email = $_POST['email'];
    $password = md5($_POST['password']);    
    $user = $wpdb->get_row("SELECT * FROM $table WHERE email = '$email' AND password = '$password'");
 
    if($user && $user->activate == 1){
        $_SESSION["caregiver"] = $email;
        echo "approved";

    }else if($user && $user->activate == 0){
        echo "pending";
    }else{
        echo "false";
    }

    wp_die();

}


//edit agency
add_action('wp_ajax_edit', 'edit');
add_action( 'wp_ajax_nopriv_edit', 'edit' );

function edit()
{
    global $wpdb; 
    $table_name = $wpdb->prefix."agencies"; 

    $wpdb->update($wpdb->prefix."agency_shifts", array("Email" => $_POST["email"]), array("Email" => $_POST["init_email"]));

    $wpdb->update($table_name, array('Email'=>$_POST["email"], 'Category'=> $_POST["category"], 'Name'=> $_POST["name"], 'Address'=> $_POST["address"], 'Services'=> "",),
    array("Email" => $_POST["email"]));
    
    echo "true";
    
    wp_die(); 
}


add_action('wp_ajax_editcaregiver', 'edit_caregivers');
add_action( 'wp_ajax_nopriv_editcaregiver', 'edit_caregivers' );

function edit_caregivers()
{
    global $wpdb; 
    $table_name = $wpdb->prefix."caregiver"; 

    $wpdb->update($table_name, array('email'=>$_POST["email"], 'name'=> $_POST["name"], 'DOB'=> $_POST["dob"],
    'ID_type'=> $_POST["id_type"], 'ID_number'=> $_POST["id_num"],'gender_pref'=> $_POST["gender_pref"] ,
    'health_pref'=> $_POST["health_pref"], 'services'=> $_POST["services"], 'shift_pref'=> $_POST["shift_pref"], 
    'gender'=> $_POST["gender"], 'languages'=> $_POST["language"], 'password'=> md5($_POST["password"]), 'address'=> $_POST["address"]),
    array("email" => $_POST["email"]));
    
    echo "true";
    
    wp_die(); 
}


//managing sessions
add_action('wp_ajax_session', 'session');
add_action( 'wp_ajax_nopriv_session', 'session' );

function session()
{
    if ($_POST["type"] == "set") {
        $_SESSION["id"] = $_POST["id"];
        $_SESSION["name"] = $_POST["name"];
        $_SESSION["status"] = $_POST["status"];
    }else {
      unset($_SESSION['email']);
    }

    wp_die(); 
}


add_action('wp_ajax_caresession', 'logout_caregiver');
add_action( 'wp_ajax_nopriv_caresession', 'logout_caregiver' );
function logout_caregiver(){
    if ($_POST["type"] == "unset"){
       unset($_SESSION['caregiver']);
    }
}


//managing shifts
add_action('wp_ajax_agency_shifts', 'agency_shifts');
add_action( 'wp_ajax_nopriv_agency_shifts', 'agency_shifts' );

function agency_shifts()
{
    global $wpdb; 
    $table_name = $wpdb->prefix.'agency_shifts'; 

    if ($_POST["type"] == "add" ) {
        if($_POST['date'] < $today){
            echo "bad_date";
        } else {
            global $wpdb;
            $table = $wpdb->prefix.'caregiver'; 
            $emails = $wpdb->get_results("SELECT * FROM $table");

            $name = $_POST['name'];
            $date = $_POST['date'];
            $location = $_POST['location'];
            $hour_rate = $_POST['rate'];

            foreach($emails as $email){

                $headers = "From: ". get_option( 'admin_email' ) . "\r\n";
                $headers .= "Content-type: text/html; charset=UTF-8"."\r\n";
            
                $send_email = $email->email;
                $send_name = $email->name;

                $subject = "Shift Posted";
                $message = "<html><body>
                <p>Hello $send_name,<p>
                <p>A new shift, $name has been posted on enhanced carers.<p>
                <p>Location: $location. Hourly rate: $hour_rate.</p>
                <p>Starting date: $date</p>
                </body></html>";
                $status = mail($send_email, $subject, $message, $headers );
    
            }
            if(isset($_POST["email"])){
                $email = $_POST["email"];
                
            }else {
            $email = $_SESSION["email"];
            }
            
            $insert = $wpdb->insert($table_name, array('Shift'=>$_POST["name"], 'Description'=> $_POST["desc"],
            'Email'=> $email, 'Category'=>$_POST["cat"], 'Language'=>$_POST["language"],'Condtn'=>$_POST["health"],
            'Services'=>$_POST["service"], 'Start'=>$_POST["date"], 'Status'=> "pending", 'Location'=>$_POST["location"],
            'Rate'=>$_POST["rate"]),
            array('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s'));

            $header = "From: ". get_option( 'admin_email' ) . "\r\n";
            $header .= "Content-type: text/html; charset=UTF-8"."\r\n";

            $subject = "Shift Addition";
            $message = "Your shift has been added successfully";
            $status = mail($email, $subject, $message, $header);

            if($insert){
                echo "true";

            } else {
                echo "false";
            }
        }

    } else if ($_POST["type"] == "delete" ) {
        $run = $wpdb->delete($table_name, array("Id" => $_POST["id"]));
        
    }else if ($_POST["type"] == "update" ) {
        $run = $wpdb->update($table_name, array("Shift" => $_POST["name"], "Description" => $_POST["desc"], "Category" => $_POST["cat"], 
        'Language'=>$_POST["language"], 'Condtn'=>$_POST["health"], 'Services'=>$_POST["service"],'Start'=>$_POST["date"],
        'Location'=>$_POST["location"], 'Rate'=>$_POST["rate"]), array("Id" => $_POST["id"]));
        
        if(isset($_POST["email"])){
            $email = $_POST["email"];
            
        }else {
           $email = $_SESSION["email"];
        }

        $header = "From: ". get_option( 'admin_email' ) . "\r\n";
        $header .= "Content-type: text/html; charset=UTF-8"."\r\n";

        $subject = "Shift Update";
        $message = "Your shift has been updated successfully";
        $status = mail($email, $subject, $message, $header);

    } else if ($_POST["type"] == "close" ) {
        $date = date("Y-m-d");
        $run = $wpdb->update($table_name, array("Status" => "closed", "End" => $date), array("Id" => $_POST["id"]));
    
   }
    wp_die(); 
}

 


add_action('wp_ajax_processing', 'processing');
add_action( 'wp_ajax_nopriv_processing', 'processing' );

function processing()
{
    global $wpdb; 
    $table_name = $wpdb->prefix.$_POST["table"]; 

    if ($_POST["type"] == "delete" ) {
        $run = $wpdb->delete($table_name, array("Id" => $_POST["id"]));
         
    } else if ($_POST["type"] == "update" ) {

        if ($table_name == $wpdb->prefix.'shifts' ) {
            $wpdb->update($table_name, array("Shift" => $_POST["name"], "Description" => $_POST["desc"]), array("Id" => $_POST["id"]));
        
        } else if ($table_name == $wpdb->prefix."categories" ) {
            $wpdb->update($table_name, array("Category" => $_POST["name"]), array("Id" => $_POST["id"]));
        
        }else if ($table_name == $wpdb->prefix."services" ) {
            $wpdb->update($table_name, array("Service" => $_POST["name"]), array("Id" => $_POST["id"]));
        
        }else if ($table_name == $wpdb->prefix."languages" ) {
            $wpdb->update($table_name, array("Language" => $_POST["name"]), array("Id" => $_POST["id"]));
            
        }else if ($table_name == $wpdb->prefix."health" ) {
            $wpdb->update($table_name, array("Condtn" => $_POST["name"], "Description" => $_POST["desc"]), array("Id" => $_POST["id"]));
        
        } else if ($table_name == $wpdb->prefix."agencies" ) {

            $check_user = $wpdb->get_results("SELECT * FROM $table_name WHERE Email = '$_POST[email]' AND Id != '$_POST[id]'");

            if (!$check_user) {
                $wpdb->update($wpdb->prefix."agency_shifts", array("Email" => $_POST["email"]), array("Email" => $_POST["init_email"]));
            
                $wpdb->update($table_name, array("Name" => $_POST["name"], "Email" => $_POST["email"], "Category" => $_POST["category"],
                "Address" => $_POST["address"], "approved" => $_POST["status"]), array("Id" => $_POST["id"]));

            } else {
                echo "exists";
            }
        } else if ($table_name == $wpdb->prefix."caregiver") {
            $wpdb->update($table_name, array("name" => $_POST["name"], "email" => $_POST["email"], "DOB" => $_POST["dob"], "address" => $_POST["address"], "gender_pref" => $_POST["gender_pref"],"shift_pref" => $_POST["shift_pref"],"languages" => $_POST["language"], "ID_type" => $_POST["id_type"], "ID_number" => $_POST["id_num"],"services" => $_POST["services"], "health_pref" => $_POST["health_pref"], "gender" => $_POST["gender"], "activate" => $_POST['approved']), array("Id" => $_POST["id"]));

        }
    }
    wp_die(); 
}



add_action('wp_ajax_apply', 'apply');
add_action( 'wp_ajax_nopriv_apply', 'apply' );

function apply(){ 
    global $wpdb;  
    $table_name = $wpdb->prefix.'caregiver_apply'; 
    $wpdb->show_errors();
    $run = $wpdb->insert($table_name, array("caregiver" => $_POST["name"],"Description" => $_POST["desc"],"shift_id" => $_POST["id"], "starting_date" => $_POST["date"], "Shift" => $_POST["time"], "email" => $_POST["email"]), array('%s', '%s', '%s'));
  
    wp_die();
}

 

add_action('wp_ajax_approval', 'approval');
add_action( 'wp_ajax_nopriv_approval', 'approval');

function approval(){
    if($_POST["type"] == "approve_care"){
    global $wpdb; 
    $table_name = $wpdb->prefix.'caregiver_apply';  
    $table_name2 = $wpdb->prefix.'agency_shifts';
    $table_name3 = $wpdb->prefix.'caregiver';

    if($_POST["status"] == "approve"){
        $id = $_POST['id']; 
        $shift = $_POST['shift'];
        $run = $wpdb->update($table_name, array("approved" => 1), array("Id" => $_POST["id"]));
        $run = $wpdb->update($table_name2, array("Status" => "running"), array("Id" => $_POST["shift"]));
        $wpdb->query($wpdb->prepare("UPDATE $table_name SET approved = 0 WHERE id != '$id' AND shift_id = $shift")); 
        
        $shift_info = $wpdb->get_row("SELECT * FROM $table_name2 WHERE Id = $shift");
        $user =  $wpdb->get_row("SELECT * FROM $table_name WHERE Id = $id");

        $email = $user->email;

        $info =  $wpdb->get_row("SELECT * FROM $table_name3 WHERE email = $email");

        $headers = "From: ". get_option( 'admin_email' ) . "\r\n";
        $headers .= "Content-type: text/html; charset=UTF-8"."\r\n";

        $user_name = $info->name;
        $subject = "Shift Approval";
        $shift_name = $shift_info->Shift;
        $start = $shift_info->Start;
        $location = $shift_info->Location;
        $rate = $shift_info->Rate;
        $message = "<html><body>
        <p>Hello $user_name,<p>
        <p>A new shift, $shift_name has been posted on enhanced carers.<p>
        <p>Location: $location. Hourly rate: $rate dollars.</p>
        <p>Starting date: $start</p>
        </body></html>";
        $status = mail($email, $subject, $message, $headers);

    }else if($_POST["status"] == "reject"){
        $run = $wpdb->update($table_name, array("approved" => 0), array("Id" => $_POST["id"]));
    }   
    }else if($_POST["type"] == "approve_agency"){
    global $wpdb; 
    $table_name1 = $wpdb->prefix.'agency_shifts'; 
    if($_POST["status"] == "approve"){
        $run = $wpdb->update($table_name1, array("approved" => 1, "Status" => "new"), array("Id" => $_POST["id"]));
    } 
    else if($_POST["status"] == "reject"){
        $run = $wpdb->update($table_name1, array("approved" => 0), array("Id" => $_POST["id"]));
        }
    }
    wp_die();
}
 



add_action('wp_ajax_accept', 'accept');
add_action( 'wp_ajax_nopriv_accept', 'accept');

function accept(){  

    $table_name1 = $wpdb->prefix.'agency_shifts'; 
    if($_POST["status"] == "approve"){
        $run = $wpdb->update($table_name1, array("approved" => 1), array("Id" => $_POST["id"]));
    }
    else if($_POST["status"] == "reject"){
       $run = $wpdb->update($table_name1, array("approved" => 0), array("Id" => $_POST["id"]));
    }
    
    wp_die();
}



add_action('wp_ajax_allow_agent', 'allow');
add_action( 'wp_ajax_nopriv_allow_agent', 'allow');

function allow(){  
    global $wpdb; 
    $table_name1 = $wpdb->prefix.'agencies'; 
    if($_POST["status"] == "approve"){
        $run = $wpdb->update($table_name1, array("approved" => 1), array("Id" => $_POST["id"]));
    }
    else if($_POST["status"] == "reject"){
        $run = $wpdb->update($table_name1, array("approved" => 0), array("Id" => $_POST["id"]));
    }
     
    wp_die();
}



if(!class_exists('EnhancedCarers')){

    class EnhancedCarers{

        public function __construct(){
            //adding css and javascript files.
            add_action('admin_enqueue_scripts', array($this, 'files')); 
            add_action('wp_enqueue_scripts', array($this, 'files')); 

            add_action('admin_menu', array($this, 'admin_menu')); 

            //adding registration shortcode
            add_shortcode('register', array($this, 'registration_shortcode'));

            //adding profile shortcode
            add_shortcode('profile', array($this, 'profile_shortcode'));

            //adding agency_auth shortcode
            add_shortcode('agency_auth', array($this, 'agency_auth_shortcode'));

            //adding caregiver_auth shortcode
            add_shortcode('caregiver_auth', array($this, 'caregiver_auth_shortcode'));

            //adding login shortcode
            add_shortcode('login', array($this, 'login_shortcode'));

            //adding agency shift shortcode
            add_shortcode('agency_shifts', array($this, 'shifts_shortcode'));

            //adding agency dash shortcode
            add_shortcode('dashboard', array($this, 'dash_shortcode'));

            //adding agency report shortcode
            add_shortcode('report', array($this, 'report_shortcode'));

            //adding agency_caregivers shortcode
            add_shortcode('agency_caregivers', array($this, 'caregivers_shortcode'));
            
            add_shortcode('caregiver-registration', array($this, 'caregiver_registration'));

            add_shortcode('view-shift', array($this, 'view_shift'));

            add_shortcode('caregiver-dashboard', array($this, 'care_dash'));

            add_shortcode('caregiver-login', array($this, 'care_login'));

            add_shortcode('caregiver-profile', array($this, 'care_profile'));

            add_shortcode('caregiver-update', array($this, 'care_update'));

            add_shortcode('authentication', array($this, 'auth_shortcode'));

            add_shortcode('caregiver-report', array($this, 'caregiver_report'));

            add_shortcode('activate', array($this, 'activate'));

            add_action('init',  array($this, 'initialize'));

            add_action('wp_head', array($this, 'hide_menu'));
        }
        

        //intiailizing session
        public function initialize()
        {
           ob_start();
           session_start();
        } 
        

        public function hide_menu() 
        { 
            if (isset($_SESSION["email"]) || isset($_SESSION["caregiver"])) {
                $items = array();

                $menu = wp_get_nav_menu_items("Main menu");
                
                foreach($menu as $item){
                   $items[$item->title] = $item->ID; 
                }

                if (isset($_SESSION["email"])){
                   include "exclude_int_agency.php";
                   
                } else {
                   include "exclude_int_caregiver.php";
                }
                
            } else {
                $items = array();

                $menu = wp_get_nav_menu_items("Main menu");
                
                foreach($menu as $item){
                   $items[$item->title] = $item->ID;                    
                }
                
                include "exclude_ext.php";
            }
        }


        //intiailizing session
        public function activate()
        {
            include 'activate.php';
        } 
        
        public function caregiver_report(){
            include 'caregiver_report.php';
        }
          
        public function caregiver_registration(){
            include 'care_registration.php';
        }

        public function registration_shortcode()
        {
            include 'register.php';   
        }
        
        public function agency_auth_shortcode()
        {
            include 'agency_authentication.php';   
        }


        public function caregiver_auth_shortcode()
        {
            include 'caregiver_authentication.php';   
        }


        public function login_shortcode()
        {
            include 'login.php';   
        }

        public function profile_shortcode()
        {
            include 'profile.php';   
        }

        public function care_dash()
        {
            include 'caregiver_dashboard.php';
        }

        public function dash_shortcode()
        {
            include 'dashboard.php';   
        }

         
        public function report_shortcode()
        {
            include 'agency_report.php';   
        }

        public function caregivers_shortcode()
        { 
            include 'agency_caregivers.php';   
        }


        public function view_shift(){
            include 'apply_shift.php';
        }

        public function care_profile(){
            include 'caregiver-profile.php';
        }

        public function care_login(){
            include 'caregiver_login.php';
        }


        public function shifts_shortcode()
        {
            global $wpdb; 
            $table_name = $wpdb->prefix."shifts"; 
            $table_name1 = $wpdb->prefix."agency_shifts"; 
            $table_name2 = $wpdb->prefix."languages"; 
            $table_name3 = $wpdb->prefix."services"; 
            $table_name4 = $wpdb->prefix."health"; 
            ######edited####
            $shifts = $wpdb->get_results("SELECT * FROM $table_name1 WHERE Email = '$_SESSION[email]'");
            $languages = $wpdb->get_results("SELECT * FROM $table_name2");
            $services = $wpdb->get_results("SELECT * FROM $table_name3");
            $health_condition = $wpdb->get_results("SELECT * FROM $table_name4");

            $shift_category = $wpdb->get_results("SELECT * FROM $table_name");

            include 'agency_shifts.php';    
        }



        //Adding menu and submenus in the admin dashboard
        public function admin_menu()
        {
            global $submenu;
            
            add_menu_page('Enhanced Carers', 'Enhanced Carers', 'manage_options', 'enhanced_carers', 'carers_func');

            add_submenu_page('enhanced_carers', 'Agency Categories' , 'Agency Categories' , 'manage_options', 'agency-categories', array($this, 'categories_info'));
            
            add_submenu_page('enhanced_carers', 'Shift Categories' , 'Shift Categories' , 'manage_options', 'shifts', array($this, 'shifts_info'));

            add_submenu_page('enhanced_carers', 'Health Conditions' , 'Health Conditions' , 'manage_options', 'health_conditions', array($this, 'health_conditions'));

            add_submenu_page('enhanced_carers', 'Add shift' , 'Add shift' , 'manage_options', 'add-shift', array($this, 'add_shift'));

            add_submenu_page('enhanced_carers', 'Services' , 'Services' , 'manage_options', 'services', array($this, 'services'));
            
            add_submenu_page('enhanced_carers', 'Languages' , 'Languages' , 'manage_options', 'languages', array($this, 'languages_info'));

            add_submenu_page('enhanced_carers', 'Caregivers' , 'Caregivers' , 'manage_options', 'care-givers', array($this, 'care_givers'));

            add_submenu_page('enhanced_carers', 'Agencies' , 'Agencies' , 'manage_options', 'agencies', array($this, 'agencies'));

            add_submenu_page('enhanced_carers', 'Caregiver shifts' , 'Caregiver shifts' , 'manage_options', 'caregiver', array($this, 'caregiver_page'));

            add_submenu_page('enhanced_carers', 'Agency shifts' , 'Agency shifts' , 'manage_options', 'agency', array($this, 'agency_page'));

            add_submenu_page('enhanced_carers', 'Agency report' , 'Agency report' , 'manage_options', 'agency-report', array($this, 'report_agency'));

            add_submenu_page('enhanced_carers', 'Caregiver report' , 'Caregiver report' , 'manage_options', 'care-report', array($this, 'care_report'));


            add_submenu_page('enhanced_carers', 'ID types' , 'ID types' , 'manage_options', 'id-type', array($this, 'id_type'));


            unset($submenu['enhanced_carers'][0]);
        }
        
        
        public function care_givers(){
            global $wpdb; 
            $table_name = $wpdb->prefix."caregiver";   

            if (isset($_POST["add"])) {
                $wpdb->insert($table_name, array('email'=>$_POST["email"], 'name'=> $_POST["name"], 'DOB'=> $_POST["dob"],
                'ID_type'=> $_POST["id_type"], 'ID_number'=> $_POST["id_number"],'gender_pref'=> $_POST["gender_pref"] ,
                'health_pref'=> $_POST["health_pref"], 'services'=> $_POST["services"], 'shift_pref'=> $_POST["shift_pref"], 
                'gender'=> $_POST["gender"], 'languages'=> $_POST["language"],'address'=> $_POST["address"]),
                array('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s'));
            } 

            $caregivers = $wpdb->get_results("SELECT * FROM $table_name");  

            $cat_table = $wpdb->prefix . "categories"; 
            $categories = $wpdb->get_results("SELECT * FROM $cat_table");
        
            $services_table = $wpdb->prefix . "services"; 
            $services = $wpdb->get_results("SELECT * FROM $services_table");
        
            $language_table = $wpdb->prefix . "languages"; 
            $languages = $wpdb->get_results("SELECT * FROM $language_table");
        
            $health_table = $wpdb->prefix . "health"; 
            $health = $wpdb->get_results("SELECT * FROM $health_table");
        
            $id_table = $wpdb->prefix . "ID_types"; 
            $ids = $wpdb->get_results("SELECT * FROM $id_table");
        
            include 'show_caregivers.php';
        }



        public function agencies(){
            global $wpdb; 
            $status = '';

            $table_name = $wpdb->prefix."agencies";   
            $table_name2 = $wpdb->prefix."categories"; 
            #####edited#####
            if (isset($_POST["add"])) {
                
                $check_user = $wpdb->get_results("SELECT * FROM $table_name WHERE Email = '$_POST[email]'");

                if (!$check_user) {
                    $wpdb->insert($table_name, array('Email'=>$_POST["email"], 'Category'=> $_POST["category"], 'Name'=> $_POST["name"],
                    'Address'=> $_POST["address"], 'Password'=> $_POST["pass1"], 'approved'=> 1),
                    array('%s', '%s', '%s', '%s', '%s', '%s'));
                
                } else {
                    $status = 'exists';
                }
            }

            $agencies = $wpdb->get_results("SELECT * FROM $table_name");  
            $categories = $wpdb->get_results("SELECT * FROM $table_name2");

            include 'show_agencies.php';
        }

        //Managing shifts
        public function shifts_info()
        {
            global $wpdb; 
            $table_name = $wpdb->prefix."shifts"; 

            if (isset($_POST["add"])) {
                $wpdb->insert($table_name, array('Shift'=>$_POST["name"], 'Description'=> $_POST["desc"]),
                array('%s', '%s'));
            }

            $shifts = $wpdb->get_results("SELECT * FROM $table_name");
            include 'shifts.php';
        }


        public function add_shift()
        {
            global $wpdb; 
            $table_name = $wpdb->prefix."shifts"; 
            $table_name1 = $wpdb->prefix."agency_shifts"; 
            $table_name2 = $wpdb->prefix."languages"; 
            $table_name3 = $wpdb->prefix."services"; 
            $table_name4 = $wpdb->prefix."health"; 
            ######edited####
            $shifts = $wpdb->get_results("SELECT * FROM $table_name1 WHERE approved = 1");
            $languages = $wpdb->get_results("SELECT * FROM $table_name2");
            $services = $wpdb->get_results("SELECT * FROM $table_name3");
            $health_condition = $wpdb->get_results("SELECT * FROM $table_name4");

            $shift_category = $wpdb->get_results("SELECT * FROM $table_name");

            include 'admin_add_shift.php';
        }

        //Managing agency categories
        public function categories_info()
        {
            global $wpdb; 
            $table_name = $wpdb->prefix."categories"; 

            if (isset($_POST["add"])) {
                $wpdb->insert($table_name, array('Category'=>$_POST["name"]),
                array('%s'));
            }

            $categories = $wpdb->get_results("SELECT * FROM $table_name");

            include 'categories.php';
        }
 

        //Managing ID types
        public function id_type(){ 
        global $wpdb; 
            $table_name = $wpdb->prefix."ID_types"; 

            if (isset($_POST["add"])) {
                $wpdb->insert($table_name, array('ID_type'=>$_POST["name"]),
                array('%s'));
            
            }

            $types = $wpdb->get_results("SELECT * FROM $table_name");

            include 'id_type.php';  
        }



        //Managing services
        public function services()
        {
            global $wpdb; 
            $table_name = $wpdb->prefix."services"; 

            if (isset($_POST["add"])) {
                $wpdb->insert($table_name, array('Service'=>$_POST["name"]),
                array('%s'));
            }

            $services = $wpdb->get_results("SELECT * FROM $table_name");

            include 'services.php';
        }
        


        //Managing languages
        public function languages_info()
        {
            global $wpdb; 
            $table_name = $wpdb->prefix."languages"; 

            if (isset($_POST["add"])) {
                $wpdb->insert($table_name, array('Language'=>$_POST["name"]),
                array('%s'));
            }

            $languages = $wpdb->get_results("SELECT * FROM $table_name");

            include 'languages.php';
        }        



        //Managing health conditions
        public function health_conditions()
        {
            global $wpdb; 
            $table_name = $wpdb->prefix."health"; 

            if (isset($_POST["add"])) {
                $wpdb->insert($table_name, array('Condtn'=>$_POST["name"], 'Description'=> $_POST["desc"]),
                array('%s'));
            }

            $conditions = $wpdb->get_results("SELECT * FROM $table_name");

            include 'health.php';
        }
        

        //Managing agency shifts
        public function agency_page(){
            global $wpdb; 
            $table_name = $wpdb->prefix."agency_shifts";   

            $agencies = $wpdb->get_results("SELECT * FROM $table_name");
    
            include 'agency.php';
        }


        //Managing caregiver shifts
        public function caregiver_page(){
            global $wpdb; 
            $table_name = $wpdb->prefix."caregiver_apply";   
 
            $caregivers = $wpdb->get_results("SELECT * FROM $table_name");

            include 'caregivers.php';

        }
        

        //Agency report 
        public function report_agency(){
            include 'report_agency.php';
        }
            

        //Care giver report 
        function care_report(){
            include 'care_report.php';
        }
            
        
        //add css and javascript files.
        public function files()
        {
            wp_enqueue_style(
                'bootstrap_css',
                plugin_dir_url( __FILE__ ) . '/css/bootstrap.min.css'
            );

            wp_enqueue_style(
                'app_css',
                plugin_dir_url( __FILE__ ) . '/css/app.min.css'
            );


            wp_enqueue_style(
                'styles',
                plugin_dir_url( __FILE__ ) . '/css/styles.css'
            );


            wp_enqueue_script(
                'javascript',
                plugin_dir_url( __FILE__ ) . '/js/carers.js'
            );
        }        
    }

    $EnhancedCarers = new EnhancedCarers();
}


