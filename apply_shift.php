<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<?php 

//include 'exclude_in.php';
       global $wpdb; 
        $table_name = $wpdb->prefix."agency_shifts"; 
        $shifts = $wpdb->get_results("SELECT * FROM $table_name"); 
        
    $login = get_page_by_path("caregiver-account");
    $login_id = $login->ID;
    $login_perma = get_permalink($login_id);


    if(!$_SESSION['caregiver']){
        wp_redirect($login_perma);
    }

        $hours = array();
        $types = array();

        //this line is to get the different shift types, morning, afternoon and evening, my column names are't consistent, my bad.
        foreach($shifts as $shift){
        $hours[] = $shift->Shift;
        }

        //This is for the shift types, it was in the first user stories, but i think, we can remove it
        foreach($shifts as $shift){
            $types[] = $shift->type;
        }

        $new_hours = array_unique($hours);
        $new_types = array_unique($types);

        $email = $_SESSION['caregiver'];
 
        global $wpdb; 
        $table_name1 = $wpdb->prefix."caregiver_apply"; 
        $apps = $wpdb->get_results("SELECT * FROM $table_name1 WHERE email ='$email'"); 

        global $wpdb; 
        $table = $wpdb->prefix."caregiver_apply"; 
        $filts = $wpdb->get_results("SELECT * FROM $table WHERE email ='$email' AND approved = 0"); 
        $app_id = array();
        $app_id = $wpdb->get_results("SELECT shift_id FROM $table_name1");
        //get the current day so we only have shifts that are in the future
        $today = date('Y-m-d');
        //this array stores the shift ids from caregiver apply in order to filter tht agency shifts
        $comp_id = array();
        $closed = array();

        global $wpdb; 
        $table_name2 = $wpdb->prefix."languages"; 
        $languages = $wpdb->get_results("SELECT * FROM $table_name2"); 

        foreach($apps as $app){
            $comp_id[] = $app->shift_id;
        }

        foreach($filts as $filt){
            $closed[] = $filt->shift_id;
        }

      //filters for the shifts using a hidden form once the dropdowns are selected
        if($_REQUEST['METHOD'] == "POST"){
        if (isset($_POST["id_val"]) && isset($_POST['changes'])) {
            $check = $_POST["id_val"];
            if(($_POST['changes']) == 'shift'){
            global $wpdb; 
            $table_name = $wpdb->prefix."agency_shifts";   
            $shifts = $wpdb->get_results("SELECT * FROM $table_name WHERE Shift='$check' ");
        }else if(($_POST['changes']) == 'all_shifts'){
            global $wpdb;  
            $table_name = $wpdb->prefix."agency_shifts";   
            $shifts = $wpdb->get_results("SELECT * FROM $table_name ");
        }else if(($_POST['changes']) == 'types'){
            global $wpdb; 
            $table_name = $wpdb->prefix."agency_shifts";   
            $shifts = $wpdb->get_results("SELECT * FROM $table_name WHERE type='$check' ");
        }else if(($_POST['changes']) == 'language'){
            global $wpdb; 
            $wpdb->show_errors();
            $table_name = $wpdb->prefix."agency_shifts";   
            $shifts = $wpdb->get_results("SELECT * FROM $table_name WHERE FIND_IN_SET('$check', Language)");
            
        }
      }
    }
?>

<script>

  //function to apply for shift
   function apply(id, date, time, user, email, desc){

    console.log(id);

    document.getElementById('great').style.display = 'block';

    var ajaxurl = '<?php echo admin_url('admin-ajax.php');?>';
 
    var data = {
          action: 'apply',
          type: 'apply',
          id: id,
          name: user,
          date: date,
          desc: desc,
          time: time,
          email: email,
          table: 'caregiver_apply'
      };

      $.post(ajaxurl, data, function(response) {
        location.reload(true);
        
      }); 
   } 
  //submit values into the hidden form to filter out the shifts
function check(new_results, new_value){
    console.log(new_results); 

    var filt_form = document.getElementById("submit_form");
    document.getElementById("filt_val").value = new_results;
    document.getElementById("filt_name").value = new_value;
    filt_form.submit((event) => {
        event.preventDefault();
    }); 

}
</script>
<html>

<body>
<div class="alert alert-success" id="great" role="alert" style='display:none'>You have applied for this shift, await approval.</div>

<form style='display:none' id='submit_form' method='post' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<?php $rand=rand();
   $_SESSION['rand']=$rand; ?>
<input type="hidden" value="<?php echo $rand; ?>" name="randcheck" />
<input type="hidden" id="filt_val" name="id_val" value="">
<input type="hidden" id="filt_name" name="changes" value="">
</form>

<div class="btn-group">
  <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Hours
  </button>
  <ul class="dropdown-menu dropdown-menu-end">
  <?php
  foreach($new_hours as $hour){?>
    <li><a class="dropdown-item" onclick="check('<?php echo $hour; ?>', 'shift')"><?php echo $hour; ?></a></li>
    <?php 
  } 
    ?>
    <li><a class="dropdown-item" onclick="check('All', 'all_shifts')">All</a></li>
  </ul>
</div>


<!-- the dropdowns for filtering -->

<div class="btn-group">
  <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Languages
  </button>
  <ul class="dropdown-menu dropdown-menu-end">
  <?php
  foreach($languages as $language){?>
    <li><a class="dropdown-item" onclick="check('<?php echo $language->Language; ?>', 'language')"><?php echo $language->Language; ?></a></li>
    <?php 
  }
    ?>
    <li><a class="dropdown-item" onclick="check('All', 'all_shifts')">All</a></li>
  </ul>
</div>


<table class="table table-responsive w-auto small">
  <thead> 
    <tr>
      <th scope="col">#</th>
      <th scope="col">Shift</th>
      <th scope="col">Description</th>
      <th scope="col">Starting date</th>
      <th scope="col">Language</th> 
      <th scope="col">Service</th> 
      <th scope="col">Category</th> 
      <th scope="col">Status / Actions</th> 


  
    </tr>
  </thead>
  <?php foreach($shifts as $shift){ 
//only show the shifts approved by the admin
    ?>
  <?php if($shift->Start > $today && $shift->approved == 1 && $shift->Status == 'new'){
 
    // if( !(in_array($shift->Id, $comp_id, TRUE))) { ?>
  <tbody>
    <tr> 
      <th scope="row">1</th>
      <td><?php echo"$shift->Shift";?></td>
      <td><?php echo"$shift->Description";?></td>
      <td><?php echo"$shift->Start";?></td>
      <td><?php echo"$shift->Language";?></td>
      <td><?php echo"$shift->Services";?></td>
      <td><?php echo"$shift->Category";?></td>
      <?php if($shift->status == 'new') {?>
        <td><span class="badge rounded-pill bg-info text-dark">New</span></td>
      <?php } ?> 
  
      <?php 
//allow only logged in caregivers to view the apply button
      if($_SESSION['caregiver'] ){ 
        $email = $_SESSION['caregiver'];
        global $wpdb; 
        $table_name = $wpdb->prefix."caregiver"; 
        $name = $wpdb->get_row("SELECT * FROM $table_name WHERE email = '$email'"); 
        $current_user = $name->name;
        if((in_array($shift->Id, $closed, TRUE))) { 
          ?>  
         <td><span class="badge rounded-pill bg-danger">Rejected</span></td>
      
      <?php } else if(in_array($shift->Id, $comp_id, TRUE)) { ?>
        <td><span class="badge rounded-pill bg-warning text-dark">Pending</span></td>
      <?php } else { ?>
      <td>
        <button type="button" class="btn btn-success" onclick="apply(<?php echo $shift->Id;?>, '<?php echo $shift->Start;?>', '<?php echo $shift->Shift;?>', '<?php echo $current_user;?>', '<?php echo $email;?>', '<?php echo $shift->Desciption;?>')" id="<?php echo $shift->Id;?>">Apply</button>
        </td>
      <?php } } else { ?>
      <td></td>
      <?php } ?>
    
    </tr>
    
    
  </tbody>
  <?php   } } ?>
</table>



<body>
</html>