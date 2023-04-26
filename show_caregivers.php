<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<script type ="text/javascript">
   function addCaregiver()
   {

      var name = document.getElementById("name").value;
      var password = document.getElementById("password").value;
      var password2 = document.getElementById("password2").value;

      if (password != password2) {
         alert('Password mismatch');

      } else {
       /* if(name == '' || name == '' || name == '' || name == '' || name == '' || 
         name == '' || name == '' || name == '' || name == '' || name == '' || 
         name == '' || name == '' || name == '' || name == '' || ){
            alert('Password mismatch');

         } else {

         }*/

        var add = document.getElementById("add");
        add.submit(); 
      }
   } 

   
   function deleteCaregiver(id)
   {
      var ajaxurl = '<?php echo admin_url('admin-ajax.php');?>';
       //alert(id);
      var data = {
          action: 'processing',
          type: 'delete',
          id: id,
          table: "caregiver"
      };

      $.post(ajaxurl, data, function(response) {
        location.reload(true);
      }); 
   }


   function updateCaregiver(id, name, email, dob, gender, address, id_type, id_number, gender_pref, shift_pref, health_pref, languages, services, approved)
   {
      var ajaxurl = '<?php echo admin_url('admin-ajax.php');?>';
      var name = document.getElementById(name).value;
      var address = document.getElementById(address).value;
      var email = document.getElementById(email).value;
      var id_type = document.getElementById(id_type).value;
      var id_num = document.getElementById(id_number).value;
      var language = document.getElementById(languages).value;
      var service = document.getElementById(services).value;
      var gender = document.getElementById(gender).value;
      var gender_pref = document.getElementById(gender_pref).value;
      var shift_pref = document.getElementById(shift_pref).value;
      var health_pref = document.getElementById(health_pref).value;
      var dob = document.getElementById(dob).value;
      var approved = document.getElementById(approved).value;
 
      if(name == '' || address == '' || email == '' || id_type == '' || id_num == '' || 
         language == '' || service == '' || gender == '' || gender_pref == '' || shift_pref == '' || 
         health_pref == '' || dob == '' || approved == ''){
            alert('Fill in all required fields');

         } else {

            var data = {
              action: 'processing',
              type: 'update',
              id: id,
              name: name,
              address: address,
              email: email,
              dob: dob,
              id_type: id_type,
              id_num: id_num,
              language: language,
              services: service,
              gender: gender,
              gender_pref: gender_pref,
              shift_pref: shift_pref,
              health_pref: health_pref,
              approved: approved,
              table: 'caregiver',
            };

            $.post(ajaxurl, data, function(response) {
              location.reload(true);
            }); 
      }

   }
 
</script>


<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add New Caregiver</h4>
      </div>

      <form method="POST" id = "add">
        <div class="input">
          <div class="row">
            <div class="form-group col-md-6">
              <label for="name">Name</label>
              <input id="name" type="text" class="form-control" name="name" autofocus required>
            </div>
            <div class="form-group col-6">
              <label for="address">Address</label>
              <input id="address" type="text" class="form-control" name="address" required>
            </div>
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input id="email" type="email" class="form-control" name="email" required>
            <div class="invalid-feedback">
            </div>
          </div>

          <div class="form-group">
            <label for="dob">Enter your birthday:</label>
            <input type="date" name="dob" id="dob" class="form-control">
          </div>

          <div class="row">
            <div class="form-group col-md-6">
                <label for="frist_name">ID Types</label>
                <input id="id_type" type="text" class="form-control" name="id_type" autofocus required>
              </div>
              <div class="form-group col-6">
                <label for="id_number">ID Number</label>
                <input id="id_number" type="text" class="form-control" name="id_number" required>
              </div>
            </div>

            <div class="row">
              <div class="form-group col-md-6">
                <label for="gender">Gender</label>
                <select id = "gender" class="form-control custom-select" name="gender" required>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
              </div>
              <div class="form-group col-6">
                <label for="">Gender preference</label>
                <select id = "gender_pref" class="form-control custom-select" name="gender_pref" required>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                </select>
              </div>
            </div>

          <div class="row">
            <div class="form-group col-6">
                <label for="language">Language</label>
                <select id = "language" class="form-control custom-select" name="language" required>
                  <?php 
                    foreach ($languages as $language){
                    ?>
                      <option value="<?php echo $language->Language; ?>"><?php echo $language->Language; ?></option>
                    <?php
                    }
                  ?> 
                </select>
            </div>
              <div class="form-group col-6">
                <label for="health">Health preferences</label>
                <select id = "health_pref" class="form-control custom-select" name="health_pref" required>
                  <?php 
                    foreach ($health as $hlth){
                    ?>
                      <option value="<?php echo $hlth->Condtn; ?>"><?php echo $hlth->Condtn; ?></option>
                    <?php
                    }
                  ?> 
                </select>
              </div>
            </div>

            <div class="row">
              <div class="form-group col-md-6">
                  <label for="service">Services</label>
                  <select id = "services" class="form-control custom-select" name="services" required>
                    <?php 
                      foreach ($services as $service){
                      ?>
                        <option value="<?php echo $service->Service; ?>"><?php echo $service->Service; ?></option>
                      <?php
                      }
                    ?> 
                  </select>
               </div>

               <div class="form-group col-6">
                  <label for="shift_pref">Shift preference</label>
                  <select id = "shift_pref" class="form-control custom-select" name="shift_pref" required>
                        <option value="Fixed">Fixed</option>
                        <option value="Flexible">Flexible</option>
                  </select>
                </div>

              </div>

            <div class="row">
              <div class="form-group col-6">
                <label for="password" class="d-block">Password</label>
                <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator"
                  name="password" required>
                <div id="pwindicator" class="pwindicator">
                  <div class="bar"></div>
                  <div class="label"></div>
                </div>
              </div>
              <div class="form-group col-6">
                <label for="password2" class="d-block">Password Confirmation</label>
                <input id="password2" type="password" class="form-control" name="password-confirm" required>
              </div>
            </div>
            <input type="hidden" name = "add" value = "add">
        </div>
      </form>

      <div class="modal-footer">
        <button type="button" class="button" onclick ="addCaregiver()">Save</button>
        <button type="button" class="button" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



<div class = "card">
  <div class = "card-header" style = "border-top-left-radius: 20px; border-top-right-radius: 20px;">
      <h5><b>Registered Caregivers</b></h5>
  </div>

  <div>
    <div class = "card-body table-responsive">
        <table class="table table-striped" border = "0">
            <tr class = "header">
                <td class = "text"><b>Id</b></td>
                <td class = "text"><b>Name</b></td>
                <td class = "text" ><b>Email</b></td>
                <td class = "text" ><b>Gender</b></td>
                <td class = "text"><b>Address</b></td>

                <td class = "text" ><b>Shift Preference</b></td>
                <td class = "text" ><b>Health Preference</b></td>
                <td class = "text" ><b>Language</b></td>
                <td class = "text" ><b>Service</b></td>
                <td class = "text" ><b>Account status</b></td>

                <td class = "text" colspan ="3"><b>Actions</b></td>
            </tr>

            <?php
            if($caregivers){
              $i = 1;
              foreach ($caregivers as $caregiver) {
            ?>

                <div id="<?php echo $caregiver->Id."delete"; ?>" class="modal fade" role="dialog">
                  <div class="modal-dialog modal-dialog-centered">
                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Delete Record</h4>
                      </div>
                      <div class="modal-body">
                        <p>Are sure you want to delete this record?</p>
                        <button class="button" style = "width: 100%;" onclick ="deleteCaregiver(<?php echo $caregiver->Id; ?>)">Delete</button>
                      </div>                      
                    </div>
                  </div>
                </div>


                <div id="<?php echo $caregiver->Id."update"; ?>" class="modal fade" role="dialog">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Update Caregiver</h4>
                      </div>

                      <form>
                        <div class="input">
                        <div class="row">
                          <div class="form-group col-md-6">
                            <label for="name">Name</label>
                            <input id="<?php echo $caregiver->Id."name";?>" type="text" class="form-control" name="name" value = "<?php echo $caregiver->name;?>" autofocus required>
                          </div>
                          <div class="form-group col-6">
                            <label for="address">Address</label>
                            <input id="<?php echo $caregiver->Id."address";?>" type="text" class="form-control" name="address" value = "<?php echo $caregiver->address;?>" required>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="email">Email</label>
                          <input id="<?php echo $caregiver->Id."email";?>" type="email" class="form-control" name="email" value = "<?php echo $caregiver->email;?>" required>
                          <div class="invalid-feedback">
                          </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                            <label for="approved">Account status</label>
                            <select id = "<?php echo $caregiver->Id."approved";?>" class="form-control custom-select" name="approved" required>
                              <option <?php echo $caregiver->approved == 1 ? "selected" : ""?> value="1">Activate</option>
                              <option <?php echo $caregiver->approved == 0? "selected" : ""?> value="0">Deactivated</option>
                              </select>
                            </div>

                          </div>

                        <div class="form-group">
                          <label for="dob">Enter your birthday:</label>
                          <input type="date" name="dob" id="<?php echo $caregiver->Id."dob";?>" class="form-control" value = "<?php echo $caregiver->DOB;?>">
                        </div>

                        <div class="row">
                          <div class="form-group col-md-6">
                              <label for="frist_name">ID Types</label>
                              <select id="<?php echo $caregiver->Id."id_type";?>" class="form-control custom-select" name="id_type" required>
                                <?php 
                                    foreach ($ids as $id){
                                    ?>
                                    <option value="<?php echo $id->ID_type; ?>" <?php echo $caregiver->ID_type == $id->ID_type? "selected": "";?>><?php echo $id->ID_type; ?></option>
                                    <?php
                                    }
                                ?> 
                              </select>

                            </div>
                            <div class="form-group col-6">
                              <label for="id_number">ID Number</label>
                              <input id="<?php echo $caregiver->Id."id_number";?>" type="text" class="form-control" name="id_number" value = "<?php echo $caregiver->ID_number;?>" required>
                            </div>
                          </div>

                          <div class="row">
                            <div class="form-group col-md-6">
                              <label for="gender">Gender</label>
                              <select id = "<?php echo $caregiver->Id."gender";?>" class="form-control custom-select" name="gender" required>
                                <option <?php echo $caregiver->gender == "Male"? "selected" : ""?> value="Male">M</option>
                                <option <?php echo $caregiver->gender == "Female"? "selected" : ""?> value="Female">F</option>
                              </select>
                            </div>
                            <div class="form-group col-6">
                              <label for="">Gender preference</label>
                              <select id = "<?php echo $caregiver->Id."gender_pref";?>" class="form-control custom-select" name="gender_pref" required>
                                <option <?php echo $caregiver->gender_pref == "Male"? "selected" : ""?> value="Male">M</option>
                                <option <?php echo $caregiver->gender_pref == "Female"? "selected" : ""?> value="Female">F</option>
                              </select>
                            </div>
                          </div>

                        <div class="row">
                          <div class="form-group col-6">
                              <label for="language">Language</label>
                              <select id = "<?php echo $caregiver->Id."languages";?>" class="form-control custom-select" name="language" required>
                              <?php
                                  foreach ($languages as $language) {
                              ?>
                                  <option value="<?php echo $language->Language; ?>"<?php echo $language->Language == $caregiver->languages ? "selected": ""?> ><?php echo $language->Language; ?></option>
                              <?php
                                  }
                              ?>
                              </select>
                          </div>

                            <div class="form-group col-6">
                              <label for="health">Health preferences</label>
                              <select id = "<?php echo $caregiver->Id."health_pref";?>" class="form-control custom-select" name="health_pref" required>
                                <?php
                                    foreach ($health as $hlth) {
                                ?>
                                    <option value="<?php echo $hlth->Condtn; ?>" <?php echo $hlth->Condtn == $caregiver->health_pref ? "selected": ""?>><?php echo $hlth->Condtn; ?></option>
                                <?php
                                    }
                                ?>
                              </select>
                            </div>
                          </div>

                          <div class="row">
                            <div class="form-group col-md-6">
                                <label for="service">Services</label>
                                <select id = "<?php echo $caregiver->Id."services";?>" class="form-control custom-select" name="services" required>
                                  <?php
                                      foreach ($services as $service) {
                                  ?>
                                      <option value="<?php echo $service->Service; ?>" <?php echo $service->Service == $caregiver->services ? "selected": ""?>><?php echo $service->Service; ?></option>
                                  <?php
                                      }
                                  ?>
                                </select>
                            </div>

                            <div class="form-group col-6">
                                <label for="shift_pref">Shift preference</label>
                                <select id = "<?php echo $caregiver->Id."shift_pref";?>" class="form-control custom-select" name="shift_pref" required>
                                  <option <?php echo $caregiver->shift_pref == "Male"? "selected" : ""?> value="Fixed">Fixed</option>
                                  <option <?php echo $caregiver->shift_pref == "Female"? "selected" : ""?> value="Flexible">Flexible</option>
                                </select>
                              </div>
                            </div>

                        </div>
                      </form>
                      
                      <div class="modal-footer">
                        <button type="button" class="button" onclick ='updateCaregiver(<?php echo $caregiver->Id; ?>, "<?php echo $caregiver->Id."name"; ?>",
                         "<?php echo $caregiver->Id."email"; ?>", "<?php echo $caregiver->Id."dob"; ?>", "<?php echo $caregiver->Id."gender"; ?>", 
                         "<?php echo $caregiver->Id."address"; ?>", "<?php echo $caregiver->Id."id_type"; ?>", "<?php echo $caregiver->Id."id_number"; ?>",
                         "<?php echo $caregiver->Id."gender_pref"; ?>", "<?php echo $caregiver->Id."shift_pref"; ?>", "<?php echo $caregiver->Id."health_pref"; ?>",
                         "<?php echo $caregiver->Id."languages"; ?>", "<?php echo $caregiver->Id."services"; ?>", "<?php echo $caregiver->Id."approved"; ?>")'>Save</button>
                        <button type="button" class="button" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>

                 <div id="<?php echo $caregiver->Id."more"; ?>" class="modal fade" role="dialog">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">More details</h4>
                      </div>

                     
                        <div class="input">
                        <div class="row">
                          <div class="form-group col-md-6">
                            <label for="name">Name</label>
                            <p><?php echo "$caregiver->name";?></p>
                          </div>
                          <div class="form-group col-6">
                            <label for="address">Address</label>
                            <p><?php echo "$caregiver->address";?></p>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="email">Email</label>
                          <p><?php echo "$caregiver->email";?></p>
                          <div class="invalid-feedback">
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="dob">Enter your birthday:</label>
                          <p><?php echo "$caregiver->DOB";?></p>
                        </div>

                        <div class="row">
                          <div class="form-group col-md-6">
                              <label for="frist_name">ID Types</label>
                              <p><?php echo "$caregiver->ID_type";?></p>
                            </div>
                            <div class="form-group col-6">
                              <label for="id_number">ID Number</label>
                              <p><?php echo "$caregiver->ID_number";?></p>
                            </div>
                          </div>

                          <div class="row">
                            <div class="form-group col-md-6">
                              <label for="gender">Gender</label>
                              <p><?php echo "$caregiver->gender";?></p>
                            </div>
                            <div class="form-group col-6">
                              <label for="">Gender preference</label>
                              <p><?php echo "$caregiver->gender_pref";?></p>
                            </div>
                          </div>

                        <div class="row">
                          <div class="form-group col-6">
                              <label for="language">Language</label>
                            <p><?php echo "$caregiver->languages";?></p>
                          </div>

                            <div class="form-group col-6">
                              <label for="health">Health preferences</label>
                            <p><?php echo "$caregiver->health_pref";?></p>
                            </div>
                          </div>

                          <div class="row">
                            <div class="form-group col-md-6">
                                <label for="service">Services</label>
                              <p><?php echo "$caregiver->services";?></p>
                            </div>

                            <div class="form-group col-6"> 
                                <label for="shift_pref">Shift preference</label>
                                <p><?php echo "$caregiver->shift_pref";?></p>
                            </div>

                        </div>
                      
                      
                      <div class="modal-footer">

                        <button type="button" class="button" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>

                <tr>
                  <td class = "data"><?php echo $i; ?></td>
                  <td class = "data"><?php echo $caregiver->email; ?></td>
                  <td class = "data"><?php echo $caregiver->name; ?></td>
                  <td class = "data" ><?php echo $caregiver->gender; ?></td>
                  <td class = "data" style = "min-width: 200px;"><?php echo $caregiver->address; ?></td>

                  <td class = "data" ><?php echo $caregiver->shift_pref; ?></td>
                  <td class = "data" ><?php echo $caregiver->health_pref; ?></td>
                  <td class = "data" ><?php echo $caregiver->languages; ?></td>
                  <td class = "data" ><?php echo $caregiver->services; ?></td>
                  <td class = "data" ><?php if($caregiver->approved == 0){ ?>
                  <span class="badge bg-warning text-dark">Not activated</span>
                  <?php } else if($caregiver->approved == 1){ ?>
                  <span class="badge bg-success">Active</span>      
                  <?php } ?>
                  </td>

                  <td class = "action">
                  <button type = "button" class = "button" data-toggle = "modal" data-target = "#<?php echo $caregiver->Id."more"; ?>" data-backdrop = "true">More</button>
                  </td>

                  <td class = "action">
                      <button type = "button" class = "button" data-toggle = "modal" data-target = "#<?php echo $caregiver->Id."update"; ?>" data-backdrop = "true">Update</button>
                  </td>

                  <td class = "action">
                      <button type = "button" class = "button" data-toggle = "modal" data-target = "#<?php echo $caregiver->Id."delete"; ?>" data-backdrop = "true">Delete</button>
                  </td>

                </tr>
                
            <?php
                $i++;
              }
            }else {
            ?>
            <tr>
               <td colspan ="16" style = "text-align: center;">No data to show</td>
            </tr>
           <?php            
            } 
            ?>
        </table>
     </div>
  </div>
  
  <div class = "card-footer" style = "border-bottom-left-radius: 20px; border-bottom-right-radius: 20px;">
      <button type = "button" style = "margin-left : 5px;" class = "button" data-toggle = "modal" data-target = "#myModal" data-backdrop = "true"><span class = "add">&plus;</span>Add Caregiver</button>
  </div>
</div>











