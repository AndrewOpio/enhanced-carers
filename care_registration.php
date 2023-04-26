<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<?php 
    $login = get_page_by_path("caregiver-login");
    $id = $login->ID; 
    $login_perma = get_permalink($id);

    global $wpdb; 

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

?>


<script>
   function Register()
   {
      var ajaxurl = '<?php echo admin_url('admin-ajax.php');?>';
      var btn = document.getElementById("btn");
      btn.innerHTML = "Registering...";
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
      var health_pref = document.getElementById("health").value;
      var care_cred = document.getElementById("care_cred").value;
      var dob = document.getElementById("dob").value;
      var password = document.getElementById("password").value;
      var password2 = document.getElementById("password2").value;
      var image = document.getElementById("profile").value;
      if (password == password2) {
        var data = {
          action: 'register_caregivers',
          name: name,
          address: address,
          email: email,
          dob: dob,
          id_type: id_type,
          id_num: id_num,
          language: language,
          services: service,
          gender: gender,
          care_cred: care_cred,
          gender_pref: gender_pref,
          shift_pref: shift_pref,
          health_pref: health_pref,
          password: password,
          image: image
        };

        $.post(ajaxurl, data, function(response) {
            if (response == 'true') {
              btn.innerHTML = "Register";
              location.href='<?php echo $login_perma; ?>';

            }else if(response == 'high_age'){ 
              alert('Please enter a valid age');
              btn.innerHTML = "Register";
            }else if(response == 'under_age'){
              alert('You are under age');
            }else {
              alert(response);
              btn.innerHTML = "Register";
            }
        }); 

      } else {
        alert('Password do not match');
      }
   }

</script>


<div class="row">
  <div class="card" style = "max-width: 100%;">
    <div class="card-body">
      <form>
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
        <div class="form-group col-6">
            <label for="id">ID type</label>
            <select id = "id_type" class="form-control custom-select" name="id_type" required>
               <?php 
                 foreach ($ids as $id){
                ?>
                  <option value="<?php echo $id->ID_type; ?>"><?php echo $id->ID_type; ?></option>
                <?php
                 }
               ?> 
            </select>
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
            <select id = "health" class="form-control custom-select" name="health" required>
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
            <label for="care_cred">Care credentials</label>
            <!-- <input id="care_cred" type="text" class="form-control" name="care_cred" autofocus required> -->
            <textarea name="care_cred" id="care_cred" cols="30" rows="10" autofocus required></textarea>
          </div>
          <div class="form-group col-6">
            <label for="language">Upload profile picture</label>
            <input type="file" 
                   name="uploadfile" 
                   value="" id="profile"/>
        </div>
       </div>
      <div class="row">
        <div class="form-group col-12">
            <label for="service">Services</label>
            <select id = "service" class="form-control custom-select" name="service" required>
               <?php 
                 foreach ($services as $service){
                ?>
                  <option value="<?php echo $service->Service; ?>"><?php echo $service->Service; ?></option>
                <?php
                 }
               ?> 
            </select>
        </div>
        </div>

        <div class="row">
        <div class="form-group col-12">
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
<!--         <div class="row">
            <div class="g-recaptcha" data-sitekey="6Lfkx9YbAAAAAPBXth6gm2ZLLwtVVJNUhxTpqUhK" ></div>
        </div> -->
      </form>

      <div class="form-group">
          <button id = "btn" onclick = "Register()" class="btn btn-primary btn-lg btn-block">
            Register
          </button>
        </div>
    </div>
    <div class="mb-4 text-muted text-center">
      Already Registered? <a href="<?php echo $login_perma;?>">Login</a>
    </div>
  </div>
</div>













































