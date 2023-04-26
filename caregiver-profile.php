<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>


<?php
    //include 'exclude_in.php';
    $page = get_page_by_path("caregiver-account");
    $id = $page->ID;
    $perma = get_permalink($id);
    
    if(!$_SESSION['caregiver']){
        wp_redirect($perma);
    }

    global $wpdb; 
    $table_name = $wpdb->prefix."caregiver"; 
    $user = $wpdb->get_row("SELECT * FROM $table_name WHERE email = '$_SESSION[caregiver]'");

    $health_table = $wpdb->prefix . "health"; 
    $health = $wpdb->get_results("SELECT * FROM $health_table");

    $services_table = $wpdb->prefix . "services"; 
    $services = $wpdb->get_results("SELECT * FROM $services_table");

    $languages_table = $wpdb->prefix . "languages"; 
    $languages = $wpdb->get_results("SELECT * FROM $languages_table");

?>

<script>
   function Save()
   { 
      var ajaxurl = '<?php echo admin_url('admin-ajax.php');?>';
      var btn = document.getElementById("btn");
      btn.innerHTML = "Saving...";

      var name = document.getElementById("name").value;
      var address = document.getElementById("address").value;
      var email = document.getElementById("email").value;
      var id_type = document.getElementById("id_type").value;
      var id_num = document.getElementById("id_number").value;
      var language = document.getElementById("language").value;
      var service = document.getElementById("service").value;
      var gender = document.getElementById("gender").value;
      var gender_pref = document.getElementById("gender_pref").value;
      var shift_pref = document.getElementById("shift_pref").value;
      var health_pref = document.getElementById("health_pref").value;
      var dob = document.getElementById("dob").value;
      var password = document.getElementById("password").value;

        var data = {
          action: 'editcaregiver',
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
          password: password
        };

        $.post(ajaxurl, data, function(response) {
            if (response == 'true') {
                location.reload(true);
                btn.innerHTML = "Save";
                alert('Saved');

            } else {
              alert('An error occurred');
              btn.innerHTML = "Save";
            }
        }); 
   }


   function logout(){
    var ajaxurl = '<?php echo admin_url('admin-ajax.php');?>';
       //alert(id);
      var data = {
          action: 'caresession',
          type : 'unset'
      };

      $.post(ajaxurl, data, function(response) {
        location.href='<?php echo $perma; ?>';
      }); 
  }

</script>



<div class="main-body">    
    <div class="row gutters-sm">
    <div class="col-md-4 mb-3">
        <div class="card" >
        <div class="card-body">
            <div class="d-flex flex-column align-items-center text-center">
            <img src="<?php echo plugin_dir_url( __FILE__ ) . '/images/avatar.png'?>" alt="Admin" class="rounded-circle" width="150">
            <div class="mt-3">
                <h4><?php echo $user->name; ?></h4>
                <p class="text-secondary mb-1" aria-placeholder="full names"></p>
                <p class="text-muted font-size-sm"></p>
                <div class="form-group">
                <button type="submit" id = "btn" onclick = "logout()" style = "border: none; background-color: #34beb9;" class="btn btn-primary btn-lg btn-block">
                  logout
                </button>
            </div>

            </div>
            </div>
        </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card mb-3">
        <div class="card-body">
            <div class="row">
            <div class="col-sm-3">
                <h6 class="mb-0"><b>Name:</b></h6>
            </div>
            <div class="col-sm-9 text-secondary">
                <?php echo $user->name; ?>
            </div>
            </div>
            <hr>
            <div class="row">
            <div class="col-sm-3">
                <h6 class="mb-0"><b>Email:</b></h6>
            </div>
            <div class="col-sm-9 text-secondary">
                <?php echo $user->email; ?>
            </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-3">
                    <h6 class="mb-0"><b>Address:</b></h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    <?php echo $user->address; ?>
                </div>
            </div>                  
            <hr>

            <div class="row">
                <div class="col-sm-3">
                    <h6 class="mb-0"><b>D.O.B:</b></h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    <?php echo $user->DOB; ?>
                </div>
            </div>
            <hr>

            <div class="row">
                <div class="col-sm-3">
                    <h6 class="mb-0"><b>ID Type:</b></h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    <?php echo $user->ID_type; ?>
                </div>
            </div>
            <hr>

            <div class="row">
                <div class="col-sm-3">
                    <h6 class="mb-0"><b>ID Number:</b></h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    <?php echo $user->ID_number; ?>
                </div>
            </div>
            <hr>

            <div class="row">
                <div class="col-sm-3">
                    <h6 class="mb-0"><b>Gender:</b></h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    <?php echo $user->gender; ?>
                </div>
            </div>
            <hr>  

            <div class="row">
                <div class="col-sm-3">
                    <h6 class="mb-0"><b>Gender preference:</b></h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    <?php echo $user->gender_pref; ?>
                </div>
            </div>
            <hr>

            <div class="row">
                <div class="col-sm-3">
                    <h6 class="mb-0"><b>Shift preference:</b></h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    <?php echo $user->shift_pref; ?>
                </div>
            </div>
            <hr>

            <div class="row">
                <div class="col-sm-3">
                    <h6 class="mb-0"><b>Health preference:</b></h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    <?php echo $user->health_pref; ?>
                </div>
            </div>
            <hr>

            <div class="row">
                <div class="col-sm-3">
                    <h6 class="mb-0"><b>Language:</b></h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    <?php echo $user->languages; ?>
                </div>
            </div>
            <hr>

            <div class="row">
                <div class="col-sm-3">
                    <h6 class="mb-0"><b>Service:</b></h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    <?php echo $user->services; ?>
                </div>
            </div>
            <hr>

            <br/>
            <br/>
            <br/>
            <h4 style="text-align: center;"><b>Edit Profile</b></h4>

            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="name">Name</label>
                    <input id="name" type="name" class="form-control" name="name" required value = "<?php echo $user->name; ?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="email" required  value = "<?php echo $user->email; ?>">
                </div>
            </div>

            <div class="row">
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="email">Gender</label>
                    <select id="gender" name="gender" class="form-control custom-select" name="category" required>
                        <option <?php echo $user->gender == "Male"? "selected" : ""?> value="Male">M</option>
                        <option <?php echo $user->gender == "Female"? "selected" : ""?> value="Female">F</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="">D.O.B</label>
                    <input id="dob" type="text" class="form-control" name="address" required  value = "<?php echo $user->DOB; ?>">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="">Address</label>
                    <input id="address" type="text" class="form-control" name="address" required  value = "<?php echo $user->address; ?>">
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="">ID Type</label>
                    <input id="id_type" type="text" class="form-control" name="id_type" required  value = "<?php echo $user->ID_type; ?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="">ID Number</label>
                    <input id="id_number" type="text" class="form-control" name="id_type" required  value = "<?php echo $user->ID_number; ?>">
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-12">
                    <label for="">Gender preference</label>
                    <select id="gender_pref" name="gender_pref" class="form-control custom-select" name="gender_pref" required>
                        <option <?php echo $user->gender_pref == "Male"? "selected" : ""?> value="Male">M</option>
                        <option <?php echo $user->gender_pref == "Female"? "selected" : ""?> value="Female">F</option>
                    </select>
                </div>
            </div>


            <div class="row">
                <div class="form-group col-md-6">
                    <label for="">Shift Preference</label>
                    <select id="shift_pref" name="shift_pref" class="form-control custom-select" name="gender_pref" required>
                        <option <?php echo $user->shift_pref == "Male"? "selected" : ""?> value="Fixed">Fixed</option>
                        <option <?php echo $user->shift_pref == "Female"? "selected" : ""?> value="Flexible">Flexible</option>
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label for="">Health Preference</label>
                    <select id="health_pref" name="health_pref" class="form-control custom-select" name="health_pref" required>
                        <?php
                            foreach ($health as $health) {
                        ?>
                            <option value="<?php echo $health->Condtn; ?>" <?php echo $health->Condtn == $user->health_pref ? "selected": ""?>><?php echo $health->Condtn; ?></option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="">Services</label>
                    <select id="service" name="service" class="form-control custom-select" name="category" required>
                        <?php
                            foreach ($services as $service) {
                        ?>
                            <option value="<?php echo $service->Service; ?>" <?php echo $service->Service == $user->services ? "selected": ""?>><?php echo $service->Service; ?></option>
                        <?php
                            }
                        ?>
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label for="">Language</label>
                    <select id="language" name="language" class="form-control custom-select" name="category" required>
                        <?php
                            foreach ($languages as $language) {
                        ?>
                            <option value="<?php echo $language->Language; ?>"<?php echo $language->Language == $user->languages ? "selected": ""?> ><?php echo $language->Language; ?></option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-12">
                    <label for="">Password</label>
                    <input id="password" type="text"  class="form-control" name="password" required value = "<?php echo $user->password; ?>">
                </div>
            </div>
            </form>

            <div class="form-group">
                <button type="submit" id = "btn" onclick = "Save()" style = "border: none; background-color: #34beb9;" class="btn btn-primary btn-lg btn-block">
                    Save
                </button>
            </div>

        </div>
        </div>
    </div>
    </div>
</div>

<style type="text/css">
.main-body {
    padding: 15px;
}
.card {
    box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06);
}

.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0 solid rgba(0,0,0,.125);
    border-radius: .25rem;
}

.card-body {
    flex: 1 1 auto;
    min-height: 1px;
    padding: 1rem;
}

.gutters-sm {
    margin-right: -8px;
    margin-left: -8px;
}

.gutters-sm>.col, .gutters-sm>[class*=col-] {
    padding-right: 8px;
    padding-left: 8px;
}
.mb-3, .my-3 {
    margin-bottom: 1rem!important;
}

.bg-gray-300 {
    background-color: #e2e8f0;
}
.h-100 {
    height: 100%!important;
}
.shadow-none {
    box-shadow: none!important;
}

</style>































































