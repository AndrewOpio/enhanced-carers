<?php
//include 'exclude_in.php';

$login = get_page_by_path("agency-account");
$login_id = $login->ID;
$login_perma = get_permalink($login_id);

if(!$_SESSION['email']){
    wp_redirect($login_perma);
}

global $wpdb; 
$table = $wpdb->prefix."agencies";   
$email = $_SESSION['email'];
$user = $wpdb->get_row("SELECT * FROM $table WHERE Email='$email'");
 
?>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<script type ="text/javascript">

   var table= '<?php echo $table_name; ?>';

   function addShift() 
   { 
      var ajaxurl = '<?php echo admin_url('admin-ajax.php');?>';
      var name = document.getElementById("name").value;
      var desc = document.getElementById("desc").value;
      var cat = document.getElementById("category").value;

      var date = document.getElementById("date").value;
      var language = document.getElementById("language").value;
      var service = document.getElementById("service").value;
      var health = document.getElementById("health").value;
      var place = document.getElementById("location").value;
      var rate = document.getElementById("rate").value;

      if (name == '' || desc == '' || cat == '' || date == '' ||
         language == '' || service == '' || health == ''  || rate == ''  || place == ''  ) {

         alert('Please enter all fields');
      } else {
        var data = {
            action: 'agency_shifts',
            type: 'add',
            name: name,
            desc: desc,
            cat : cat,
            date: date,
            language: language,
            service: service,
            health: health,
            location: place,
            rate: rate,
        };

        $.post(ajaxurl, data, function(response) {
          if(response == "bad_date"){
            alert("Please enter a valid date.");

          } else if(response == "true") {
            alert("Shift added successfully");
            location.reload(true);

          } else if(response == "false") {
            alert("An error occured while adding shift");
            location.reload(true);
          }
        });
      }
   } 

   

   function deleteShift(id)
   {
      var ajaxurl = '<?php echo admin_url('admin-ajax.php');?>';
      var data = {
          action: 'agency_shifts',
          type: 'delete',
          id: id,
      };

      $.post(ajaxurl, data, function(response) {
        location.reload(true);
        //alert(response);
      }); 
   }


   function updateShift( id, place, rate, name, desc, cat, date, language, service, health)
   {
      var ajaxurl = '<?php echo admin_url('admin-ajax.php');?>';
      var name = document.getElementById(name).value;
      var desc = document.getElementById(desc).value;
      var cat = document.getElementById(cat).value;

      var date = document.getElementById(date).value;
      var language = document.getElementById(language).value;
      var service = document.getElementById(service).value;
      var health = document.getElementById(health).value;
      var place = document.getElementById(place).value;
      var rate = document.getElementById(rate).value;

      if (name == '' || desc == '' || cat == '' || date == '' ||
         language == '' || service == '' || health == '' || rate == '' || place == '' ) {
         alert('Please enter all fields');

      } else {
        var data = {
            action: 'agency_shifts',
            type: 'update',
            id: id,
            name: name,
            desc: desc,
            cat : cat,
            date: date,
            language: language,
            service: service,
            health: health,
            location: place,
            rate: rate,
        };

        $.post(ajaxurl, data, function(response) {
          location.reload(true);
        });
      }
   }


   function closeShift(id)
   {
      var ajaxurl = '<?php echo admin_url('admin-ajax.php');?>';
      var data = {
          action: 'agency_shifts',
          type: 'close',
          id: id,
      };

      $.post(ajaxurl, data, function(response) {
        location.reload(true);
        //alert(response);
      }); 
   }

</script>

<?php if($user->approved == 5){ ?>
<div class="alert alert-danger" role="alert">
  You have not yet been approved to post shifts, please wait!
</div>
<?php } elseif ($user->approved == 0) {?>
  <div class="alert alert-danger" role="alert">
        Your  application was rejected, please contact admin for more information.
  </div>
<?php } else { ?>
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add New Shift</h4>
      </div>

      <form method="POST" id = "add">
        <div class="input">
          <div class="form-group col-md-12">
            <label>Shift name</label>
            <input type="text" class="form-control" id="name" name = "name" placeholder = "shift name..">
          </div>

          <div class="form-group col-md-12">
            <label>Shift description</label>
            <textarea name="desc" id="desc"  rows="3" style = "width: 100%;"></textarea>
          </div>

          <div class="form-group col-md-12">
            <label>Shift start date</label>
            <input type="date" class="form-control" id="date" name = "date">
          </div>

          <div class="form-group col-md-12">
            <label>Shift category</label>
            <select  id = "category" class="form-control custom-select" name="category" required>

            <?php
                foreach ($shift_category as $shift_cat) {
            ?>
                  <option value="<?php echo $shift_cat->Shift; ?>"><?php echo $shift_cat->Shift; ?></option>
            <?php
                }
            ?>
            </select>
          </div>


          <div class="form-group col-md-12">
            <label> Language</label>
            <select  id = "language" class="form-control custom-select" name="language" required>

            <?php
                foreach ($languages as $language) {
            ?>
                    <option value="<?php echo $language->Language; ?>"><?php echo $language->Language; ?></option>
            <?php
                }
            ?>

            </select>
          </div>

          <div class="form-group col-md-12">
            <label>Service</label>
            <select  id = "service" class="form-control custom-select" name="service" required>

            <?php
                foreach ($services as $service) {
            ?>
                    <option value="<?php echo $service->Service; ?>"><?php echo $service->Service; ?></option>
            <?php
                }
            ?>

            </select>
          </div>

          <div class="form-group col-md-12">
            <label>Health Condition</label>
            <select  id = "health" class="form-control custom-select" name="health" required>

            <?php
                foreach ($health_condition as $health) {
            ?>
                    <option value="<?php echo $health->Condtn; ?>" ><?php echo $health->Condtn; ?></option>
            <?php
                }
            ?>

            </select>
          </div>

          <div class="form-group col-md-12">
            <label>Location</label>
            <input type="text" class="form-control" id="location" name = "location" placeholder = "shift location..">
          </div>

          <div class="form-group col-md-12">
            <label>Shift Hourly Rate</label>
            <input type="text" class="form-control" id="rate" name = "rate" placeholder = "shift rate..">
          </div>

          <input type="hidden" name = "add" value = "add">
        </div>
      </form>

      <div class="modal-footer">
        <button type="button" class="button" onclick ="addShift()">Save</button>
        <button type="button" class="button" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<div class = "card cards">
  <div class = "card-header" style = "border-top-left-radius: 20px; border-top-right-radius: 20px;">
      <h5><b>My Shifts</b></h5>
  </div>

  <div>
    <div class = "card-body table-responsive">
        <table id = "table" class="table table-striped" border = "0">
            <tr class = "header">
              <td class = "text"><b>Id</b></td>
              <td class = "text"><b>Shifts</b></td>
              <td class = "text"><b>Category</b></td>
              <td class = "text"><b>Service</b></td>
              <td class = "text"><b>Location</b></td>
              <td class = "text"><b>Rate ($)</b></td>
              <td class = "text"><b>Status</b></td>
              <td class = "text"><b>Actions</b></td>
            </tr>

            <?php
            if($shifts){
              $i = 1;
              foreach ($shifts as $shift) {
            ?>

                <div id="<?php echo $shift->Id."delete"; ?>" class="modal fade" role="dialog">
                  <div class="modal-dialog modal-dialog-centered">
                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Delete Record</h4>
                      </div>
                      <div class="modal-body">
                        <p>Are sure you want to delete this record?</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="button" onclick ='deleteShift(<?php echo $shift->Id; ?>)'>Delete</button>
                        <button type="button" class="button" data-dismiss="modal">Close</button>
                      </div>                      
                    </div>
                  </div>
                </div>


                <div id="<?php echo $shift->Id."close"; ?>" class="modal fade" role="dialog">
                  <div class="modal-dialog modal-dialog-centered">
                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Close Shift</h4>
                      </div>
                      <div class="modal-body">
                        <p>Are sure you want to close this shift?</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="button" onclick ='closeShift(<?php echo $shift->Id; ?>)'>Close</button>
                        <button type="button" class="button" data-dismiss="modal">Cancel</button>
                      </div>                                            
                    </div>
                  </div>
                </div>


                <div id="<?php echo $shift->Id."update"; ?>" class="modal fade" role="dialog">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Update Shift</h4>
                      </div>

                      <form>
                        <div class="input">
                          <div class="form-group col-md-12">
                            <label>Shift name</label>
                            <input type="text" id="<?php echo $shift->Id."name"; ?>"  class="form-control" name = "name" placeholder = "shift name.." value ="<?php echo $shift->Shift; ?>" >
                          </div>

                          <div class="form-group col-md-12">
                            <label>Shift description</label>
                            <textarea name="desc" id="<?php echo $shift->Id."desc"; ?>"  rows="3" style = "width: 100%;"><?php echo $shift->Description; ?></textarea>
                          </div>
                          
                          <div class="form-group col-md-12">
                            <label>Shift start date</label>
                            <input type="date" class="form-control" id = "<?php echo $shift->Id."date"?>" name = "date" value ="<?php echo $shift->Start; ?>">
                          </div>

                          <div class="form-group col-md-12">
                              <label>Shift category</label>
                              <select  id = "<?php echo $shift->Id."cat"; ?>" class="form-control custom-select" name="category" required>
                                <?php
                                    foreach ($shift_category as $shift_cat) {
                                ?>
                                    <option value="<?php echo $shift_cat->Shift; ?>" <?php echo $shift_cat->Shift == $shift->Category ? "selected": ""?>><?php echo $shift_cat->Shift; ?></option>
                                <?php
                                  }
                                ?>
                              </select>
                            </div>
                            <div class="form-group col-md-12">
                              <label> Language</label>
                              <select  id = "<?php echo $shift->Id."language"?>" class="form-control custom-select" name="language" required>
                              <?php
                                  foreach ($languages as $language) {
                              ?>
                                      <option value="<?php echo $language->Language; ?>" <?php echo $language->Language == $shift->Language ? "selected": ""?>><?php echo $language->Language; ?></option>
                              <?php
                                  }
                              ?>

                              </select>
                            </div>

                            <div class="form-group col-md-12">
                              <label>Service</label>
                              <select  id = "<?php echo $shift->Id."service"?>" class="form-control custom-select" name="service" required>

                              <?php
                                  foreach ($services as $service) {
                              ?>
                                    <option value="<?php echo $service->Service; ?>" <?php echo $service->Service == $shift->Services ? "selected": ""?>><?php echo $service->Service; ?></option>
                              <?php
                                  }
                              ?>
                              </select>
                            </div>

                            <div class="form-group col-md-12">
                              <label>Health Condition</label>
                              <select  id = "<?php echo $shift->Id."health"?>" class="form-control custom-select" name="health" required>
                              <?php
                                  foreach ($health_condition as $health) {
                              ?>
                                   <option value="<?php echo $health->Condtn; ?>" <?php echo $health->Condtn == $shift->Condtn ? "selected": ""?>><?php echo $health->Condtn; ?></option>
                              <?php
                                  }
                              ?>
                              </select>
                            </div>

                            <div class="form-group col-md-12">
                              <label>Location</label>
                              <input type="text" class="form-control" id = "<?php echo $shift->Id."location"?>" name = "location" placeholder = "shift location.." value ="<?php echo $shift->Location; ?>">
                            </div>

                            <div class="form-group col-md-12">
                              <label>Shift Hourly Rate</label>
                              <input type="text" class="form-control" id = "<?php echo $shift->Id."rate"?>" name = "rate" placeholder = "shift rate.." value ="<?php echo $shift->Rate; ?>">
                            </div>

                        </div>
                      </form>
                      
                      <div class="modal-footer">
                        <button type="button" class="button" onclick ='updateShift(<?php echo $shift->Id; ?>, "<?php echo $shift->Id."location"?>", "<?php echo $shift->Id."rate"?>",
                        "<?php echo $shift->Id."name"; ?>", "<?php echo $shift->Id."desc"; ?>", "<?php echo $shift->Id."cat"; ?>", 
                        "<?php echo $shift->Id."date"?>", "<?php echo $shift->Id."language"?>", "<?php echo $shift->Id."service"?>", "<?php echo $shift->Id."health"?>")'>Save</button>
                        <button type="button" class="button" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>




                <tr>
                  <td class = "data"><?php echo $i; ?></td>
                  <td class = "data"><?php echo $shift->Shift; ?></td>
                  <td class = "data"><?php echo $shift->Category; ?></td>
                  <td class = "data"><?php echo $shift->Services; ?></td>
                  <td class = "data"><?php echo $shift->Location; ?></td>
                  <td class = "data"><?php echo $shift->Rate; ?></td>
                  <td class = "data"><?php echo $shift->Status; ?></td>

                  <td class = "action">
                      <div class="dropdown">
                            <a href="#" data-toggle="dropdown" class=" btn dropdown-toggle" style = "border-width : 1px; border-color: #e2e2e2;">Options</a>
                            <div class="dropdown-menu">
                                 <button type = "button" style = "border-width : 1px; border-color: #e2e2e2;" class = "btn" data-toggle = "modal" data-target = "#<?php echo $shift->Id."close"; ?>" data-backdrop = "false">Close</button>
                                 <button type = "button" style = "border-width : 1px; border-color: #e2e2e2;" class = "btn" data-toggle = "modal" data-target = "#<?php echo $shift->Id."update"; ?>" data-backdrop = "false">Update</button>
                                 <button type = "button" style = "border-width : 1px; border-color: #e2e2e2;" class = "btn" data-toggle = "modal" data-target = "#<?php echo $shift->Id."delete"; ?>" data-backdrop = "false">Delete</button>
                            </div>
                      </div>
                    </td>                  
                </tr>
                
            <?php
                $i++;
              }
            } else {
              ?>
              <tr>
                  <td colspan ="6" style = "text-align: center;">No data to show</td>
              </tr>
              <?php            
            } 
            ?>
        </table>
    </div>
  </div>
  
  <div class = "card-footer" style = "border-bottom-left-radius: 20px; border-bottom-right-radius: 20px;">
      <button type = "button" style = " margin-left : 5px;" class = "button" data-toggle = "modal" data-target = "#myModal" data-backdrop = "false"><span class = "add">&plus;</span>Add Shift</button>
  </div>
</div>
<?php } ?>