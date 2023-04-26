<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<?php
    if (isset($_SESSION['email'])) {
        unset($_SESSION['email']);

        header("Refresh:0");
    }

    $caregiver_dash = get_page_by_path("caregiver dashboard");
    $caregiver_dash_id = $caregiver_dash->ID;
    $caregiver_dash_perma = get_permalink($caregiver_dash_id);

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


<script type ="text/javascript">

function login_care(){
  var ajaxurl = '<?php echo admin_url('admin-ajax.php');?>';
  var butn = document.getElementById('btn');

  butn.innerHTML = "Logging in ...";
  var email = document.getElementById('email_care').value;
  var password = document.getElementById('password_care').value;

  var data = {
    action: 'logincare',
    email: email,
    password: password
  };

  $.post(ajaxurl, data, function(response){
    if(response == 'approved'){
      //alert("Logged in");
      location.href='<?php echo $caregiver_dash_perma; ?>';
      butn.innerHTML = "Login";
    }else if(response == 'pending'){
       alert("Please check your email to activate your account"); 
       butn.innerHTML = "Login";  
   } else{
      alert("Wrong email or password");
      butn.innerHTML = "Login";
    }
  });
}
</script>


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

              alert('Check your email for account activation link');

              btn.innerHTML = "Register";
              document.getElementById('signin').style.display = 'block';
              document.getElementById('signup').style.display = 'none';
              document.getElementById('bn2').style.color = 'black';
              document.getElementById('bn1').style.color = '#34beb9';

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


<script>

 function Tab(id){
    if(id == 1){
      document.getElementById('signin').style.display = 'block';
      document.getElementById('signup').style.display = 'none';
      document.getElementById('bn2').style.color = 'black';
      document.getElementById('bn1').style.color = '#34beb9';
    } else {
      document.getElementById('signup').style.display = 'block';
      document.getElementById('signin').style.display = 'none';
      document.getElementById('bn1').style.color = 'black';
      document.getElementById('bn2').style.color = '#34beb9';
    }
 }
</script>


<div class="row">
<div class="col-md-6" style = "margin: auto;">
  <div class="card" style = "padding: 10px;">
    <table  border = "0" style = "border-collapse:collapse;">
      <tr style = "background-color: white;">
         <td style = "text-align: center"><button id = "bn1" style = "outline: none; border: none; background-color: white; color: #34beb9;" onclick = "Tab(1)">Sign in</button></td>
         <td style = "text-align: center;"><button id = "bn2" style = " outline: none; border: none; background-color: white; color: black;"onclick = "Tab(2)">Sign up</button></td>
      </tr>
      <tr style = "background-color: white;">
        <td colspan ="2">
          <div  id = "signin">
            <div class="card-body">
                <form id='login_care'>
                    <div class="row">
                        <div class="form-group col-md-12">
                        <label for="email">Email</label>
                        <input id="email_care" type="email" class="form-control" name="email" required placeholder ="enter email..">
                        <div class="invalid-feedback">
                        </div>
                        </div>
                    </div>

                    <div class="row">
                    <div class="form-group col-md-12">
                    <label for="email">Password</label>
                    <input id="password_care" type="password" class="form-control" name="password" required placeholder ="enter password..">
                    <div class="invalid-feedback">
                    </div>
                    </div> 
                    </div>
                </form>
                <div class="form-group">
                  <button type="submit" id="btn" style = "border: none; background-color: #34beb9;" class="btn btn-primary btn-lg btn-block" onclick="login_care()">
                      Login
                  </button>
                </div>
            </div>
          </div>

          <div id = "signup" style = "display: none;">
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
                              <textarea name="care_cred" id="care_cred" cols="30" rows="5" autofocus required></textarea>
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
                        <label for="password2" class="d-block">Confirmation</label>
                        <input id="password2" type="password" class="form-control" name="password-confirm" required>
                    </div>
                    </div>
            <!--         <div class="row">
                        <div class="g-recaptcha" data-sitekey="6Lfkx9YbAAAAAPBXth6gm2ZLLwtVVJNUhxTpqUhK" ></div>
                    </div> -->
                </form>

                <div class="form-group">
                    <button id = "btn" onclick = "Register()" style = "border: none; background-color: #34beb9;" class="btn btn-primary btn-lg btn-block">
                        Register
                    </button>
                    </div>
                </div>
          </div>
        </td>
      </tr>
    </table>
  </div>
  </div>
</div>
















































































































































