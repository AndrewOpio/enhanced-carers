<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<?php          

  //include 'exclude_in.php';

    $login = get_page_by_path("caregiver-account");
    $login_id = $login->ID;
    $login_perma = get_permalink($login_id);


    if(!$_SESSION['caregiver']){
        wp_redirect($login_perma);
    }
    $current_user = $_SESSION['caregiver'];

    $open = array();
 
    global $wpdb; 
    $table_name = $wpdb->prefix."caregiver_apply"; 
    $shifts = $wpdb->get_results("SELECT * FROM $table_name WHERE email = '$current_user'"); 
    // foreach($shifts as $shift){
    //   $open[] = $shift;

    $closed_shifts = $wpdb->get_results("SELECT * FROM $table_name WHERE email = '$current_user' AND approved = 1"); 
 

    global $wpdb; 
    $table_name2 = $wpdb->prefix."agency_shifts"; 
    $agency_shifts = $wpdb->get_results("SELECT * FROM $table_name2"); 

    $closed = array();
    foreach($closed_shifts as $shift){
    $closed[] = $shift->shift_id;
        } 
    $approved = 0;
    $pending = 0;
    $rejected = 0;

    foreach ($shifts as $shift) {
      if($shift->approved == 1){
        $approved ++;
 
      }else if($shift->approved == 0) {
        $rejected ++;
      }
      else{
        $pending++;
      }
    }
?>

<!-- Main Content -->
<div class="row ">
    <div class="col-md-6">
      <div class="card" style = "height: 150px;">
        <div class="row ">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pl-4 pt-3 pr-4">
            <div class="card-content">
              <h5 class="font-15" style = "color: gray;">Pending Applications</h5>
              <h6>Applications not approved</h6>
              <h2 class="mb-3 font-18"><?php echo $pending;?></h2>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card" style = "height: 150px;">
          <div class="row ">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pl-4 pt-3 pr-4">
              <div class="card-content">
                <h5 class="font-15" style = "color: green;">Approved Applications</h5>
                <h6>Applications that were approved</h6>
                <h2 class="mb-3 font-18"><?php echo $approved;?></h2>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
<div class="row ">
      <div class="col-md-6">
      <div class="card" style = "height: 150px;">
          <div class="row ">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pl-4 pt-3 pr-4">
              <div class="card-content">
                <h5 class="font-15" style = "color: red;">Rejected Applications</h5>
                <h6>Applications that were rejected</h6>
                <h2 class="mb-3 font-18"><?php echo $rejected;?></h2>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>


<div class="row">
  <div class="col-md-12">
      <div class="card" style = "margin: auto; margin-top: 20px;">
        <div class="card-header" style = "border-top-left-radius: 0px; border-top-right-radius: 0px;">
          <h4>Shifts applied for</h4>
        </div>
        <div class="card-body">
          <?php
      global $wpdb; 
            foreach ($shifts as $shift) {
    $shift_id = $shift->shift_id;
    $table3 = $wpdb->prefix."agency_shifts"; 
    $agency_shift = $wpdb->get_row("SELECT * FROM $table3 WHERE Id=$shift_id"); 
          ?>

              <div id="<?php echo $shift->Id."more"; ?>" class="modal fade" role="dialog">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">More details</h4>
                      </div>

                     
                        <div class="input">
                        <div class="row">
                          <div class="form-group col-md-6">
                            <label for="name"><b>Shift</b></label>
                            <p><?php echo "$agency_shift->Shift";?></p>
                          </div>
                          <div class="form-group col-6">
                            <label for="address"><b>Description</b></label>
                            <p><?php echo "$agency_shift->Description";?></p>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="email"><b>Email</b></label>
                          <p><?php echo "$agency_shift->Email";?></p>
                          <div class="invalid-feedback">
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="dob"><b>Starting date</b></label>
                          <p><?php echo "$agency_shift->Start";?></p>
                        </div>

                        <div class="row">
                          <div class="form-group col-md-6">
                              <label for="frist_name"><b>Language</b></label>
                              <p><?php echo "$agency_shift->Language";?></p>
                            </div>
                            <div class="form-group col-6">
                              <label for="id_number"><b>Condition</b></label>
                              <p><?php echo "$agency_shift->Condtn";?></p>
                            </div>
                          </div>

                          <div class="row">
                            <div class="form-group col-md-6">
                              <label for="gender"><b>Services</b></label>
                              <p><?php echo "$agency_shift->Services";?></p>
                            </div>
                            <div class="form-group col-6">
                              <label for=""><b>Location</b></label>
                              <p><?php echo "$agency_shift->Location";?></p>
                            </div>
                          </div>

                        <div class="row">
                          <div class="form-group col-6">
                              <label for="language"><b>Hourly rate($)</b></label>
                            <p><?php echo "$agency_shift->Rate";?></p>
                          </div>

 
                          </div>
                      
                      <div class="modal-footer">

                        <button type="button" class="button" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <button style = "color:<?php if ($shift->approved ==1) {
              echo "green";
            }else if ($shift->approved ==0) {
              echo "red";

          }else{
            echo "gray"; 
          } 
          ?>" class="accordion" data-toggle = "modal" data-target = "#<?php echo $shift->Id."more"; ?>" data-backdrop = "true"><?php echo $shift->Shift; ?><span style = "margin-left: 20px;">(<?php 
            if($shift->approved ==1){ echo "approved"; } else if($shift->approved == 0){ echo "rejected"; } else {echo "pending";}
        ?>)</span></button>


          <?php
            }
          ?>
        </div>
        </div>
      </div>
  </div>
 
  <div class='card w-75'> 
  <div class='card-body'>
    <h3 class='card-title'>Completed shifts</h3>
    <!-- <p class='card-text'></p> -->
    <table class='table'>
  <thead> 
    <tr>
      <th scope='col'>#</th>
      <th scope='col'>Shift</th>
      <th scope='col'>Description</th>
      <th scope='col'>Starting date</th>
      <th scope='col'>Status</th>
    </tr>
  </thead>
  <?php foreach($agency_shifts as $shift){  ?>
    <?php if($shift->Status == 'closed' && (in_array($shift->Id, $closed, TRUE))){ ?>
  <tbody>
    <tr>
      <th scope='row'>1</th>
      <td><?php echo "$shift->Shift" ?></td>
      <td><?php echo"$shift->Description" ?></td>
      <td><?php echo"$shift->Start" ?></td>
      <td><span class="badge rounded-pill bg-danger"><?php echo"$shift->Status" ?></span></td>
    
    </tr>
  </tbody>
<?php } } ?>
</table>
  </div>
</div>
