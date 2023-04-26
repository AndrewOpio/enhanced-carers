<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

<?php
    $login = get_page_by_path("agency-account");
    $login_id = $login->ID;
    $login_perma = get_permalink($login_id);

    if(!$_SESSION['email']){
        wp_redirect($login_perma);
    }

    $page = get_page_by_path("assigned-caregiver");
    $id = $page->ID;
    $perma = get_permalink($id);
 
    global $wpdb; 
    $table_name = $wpdb->prefix."agency_shifts"; 

    $shifts = $wpdb->get_results("SELECT * FROM $table_name WHERE Email = '$_SESSION[email]'");
    $new  = 0;
    $running = 0;
    $closed = 0;
    $pending = 0;

    foreach ($shifts as $shift) {
      if($shift->Status == "new"){
         $new++;

      }else if($shift->Status == "running"){
        $running++;

      }else if($shift->Status == "closed"){
        $closed++;

      }else if($shift->Status == "pending"){
        $pending++;
      }
    }
?>


<script>
  function careGivers(id, name, status){
    var ajaxurl = '<?php echo admin_url('admin-ajax.php');?>';
       //alert(id);
      var data = {
          action: 'session',
          id: id,
          name : name,
          status: status,
          type : 'set'
      };

      $.post(ajaxurl, data, function(response) {
        location.href='<?php echo $perma; ?>';
      }); 
  }
</script>



<!-- Main Content -->
    <div class="row ">
      <div class="col-md-3">
        <div class="card cards" style = "height: 150px;">
          <div class="row ">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pl-4 pt-3 pr-4">
              <div class="card-content">
                <h5 class="font-15" style = "color: gray;">Pending Shifts</h5>
                <h6>Shifts waiting for approval</h6>
                <h2 class="mb-3 font-18"><?php echo $pending;?></h2>
              </div>
            </div>
          </div>
        </div>
      </div>

    <div class="col-md-3">
      <div class="card cards" style = "height: 150px;">
          <div class="row ">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pl-4 pt-3 pr-4">
              <div class="card-content">
                <h5 class="font-15" style = "color: blue;">New Shifts</h5>
                <h6>New shifts that were approved</h6>
                <h2 class="mb-3 font-18"><?php echo $new;?></h2>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="card cards" style = "height: 150px;">
          <div class="row ">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pl-4 pt-3 pr-4">
              <div class="card-content">
                <h5 class="font-15" style = "color: green;">Running Shifts</h5>
                <h6>Shifts already in progress</h6>
                <h2 class="mb-3 font-18"><?php echo $running;?></h2>
              </div>
            </div>
          </div>
        </div>
        </div>

        <div class="col-md-3">
        <div class="card cards" style = "height: 150px;">
          <div class="row ">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pl-4 pt-3 pr-4">
              <div class="card-content">
                <h5 class="font-15" style = "color: black;">Closed Shifts</h5>
                <h6>Shifts that you ended</h6>
                <h2 class="mb-3 font-18"><?php echo $closed;?></h2>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>

<div class="row">
  <div class="col-md-12">
      <div class="card cards" style = "margin: auto; margin-top: 20px;">
        <div class="card-header" style = "border-top-left-radius: 20px; border-top-right-radius: 20px;">
          <h4>Caregivers for the different shifts</h4>
        </div>
        <div class="card-body">
          <?php
            if($shifts){
              foreach ($shifts as $shift) {
                global $wpdb; 
                $table_name = $wpdb->prefix."caregiver_apply"; 
                $id = $shift->Id;
                $care = $wpdb->get_row("SELECT * FROM $table_name WHERE shift_id = $id AND approved = 1");

          ?>
                <button data-toggle="collapse" data-target = "#<?php echo $shift->Id."caregiver"; ?>" style = "color:<?php if ($shift->Status =="new") {
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
            ?>" class="accordion"><?php echo $shift->Shift; ?><span style = "margin-left: 20px;">(<?php echo $shift->Status;?>)</span></button>

            <div id = "<?php echo $shift->Id."caregiver"; ?>" class="collapse">
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
                    <p style = "text-align: center; margin-top: 5px;">No approved caregiver</p>
                <?php } ?>
                </ul>
            </div>
            
            <?php
              }
            }else {?>
                <h6 style = "text-align: center;">No data to show</h6>
            <?php
            }
          ?>
        </div>
        </div>
      </div>
  </div>





















































































































































