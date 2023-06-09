<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<?php

  if (isset($_SESSION['caregiver'])) {
      unset($_SESSION['caregiver']);
      header("Refresh:0");
  }
  
  $dash = get_page_by_path("dashboard");
  $dash_id = $dash->ID;
  $dash_perma = get_permalink($dash_id);

  global $wpdb; 
  
  $cat_table = $wpdb->prefix . "categories"; 
  $categories = $wpdb->get_results("SELECT * FROM $cat_table");

  $services_table = $wpdb->prefix . "services"; 
  $services = $wpdb->get_results("SELECT * FROM $services_table");  
?>


<script>
   function Login()
   {
      var ajaxurl = '<?php echo admin_url('admin-ajax.php');?>';
      var btn1 = document.getElementById("btn1");
      btn1.innerHTML = "Logging in...";
      var email = document.getElementById("email1").value;
      var password = document.getElementById("password").value;

      if (email != '' && password != '') {

        var data = {
          action: 'login',
          email: email,
          password: password
        };

        $.post(ajaxurl, data, function(response) {
            //alert(response);
            if (response == 'approved') {
              btn1.innerHTML = "Login";
              location.href='<?php echo $dash_perma; ?>';

            } else if (response == 'pending') {
              alert("Please check your email to activate your account"); 
               btn1.innerHTML = "Login";  

            } else {
              alert('Wrong Email or Password');
              btn1.innerHTML = "Login";
            }
        }); 

      } else {
        btn1.innerHTML = "Login";
        alert('Please enter all required fields');
      }
   }

</script>


<script>
   function Register()
   {
      var ajaxurl = '<?php echo admin_url('admin-ajax.php');?>';
      var btn2 = document.getElementById("btn2");
      btn2.innerHTML = "Registering...";
      var name = document.getElementById("name").value;
      var address = document.getElementById("address").value;
      var email = document.getElementById("email2").value;
      var category = document.getElementById("category").value;
      var password = document.getElementById("password1").value;
      var password2 = document.getElementById("password2").value;

      if (password == password2) {
        if (name != '' && address != '' && email != '' && category != '' && password != '') {

          var data = {
            action: 'register',
            name: name,
            address: address,
            email: email,
            category: category,
            //service: service,
            password: password
          };

          $.post(ajaxurl, data, function(response) {
              if (response == 'true') {

                alert('Check your email for account activation link');

                btn2.innerHTML = "Register";
                document.getElementById('signin').style.display = 'block';
                document.getElementById('signup').style.display = 'none';
                document.getElementById('bn2').style.color = 'black';
                document.getElementById('bn1').style.color = '#34beb9';

              } else if (response == 'exists') {
                btn2.innerHTML = "Register";
                alert('This email already exist');

              } else {
                alert('An error occurred');
                btn2.innerHTML = "Register";
              }
          }); 

        }else {
          btn2.innerHTML = "Register";
          alert('Please enter all required fields');
        }

      } else {
        alert('Password mismatch');
        btn2.innerHTML = "Register";
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
  <div class="card cards" style = "padding: 10px;">
    <table  border = "0" style = "border-collapse:collapse;">
      <tr style = "background-color: white;">
         <td style = "text-align: center"><button id = "bn1" style = "outline: none; border: none; background-color: white; color: #34beb9;" onclick = "Tab(1)">Sign in</button></td>
         <td style = "text-align: center;"><button id = "bn2" style = " outline: none; border: none; background-color: white; color: black;"onclick = "Tab(2)">Sign up</button></td>
      </tr>
      <tr style = "background-color: white;">
        <td colspan ="2">
          <div  id = "signin">
            <div class="card-body">
              <form>
                <div class="row">
                    <div class="form-group col-md-12">
                    <label for="email">Email</label>
                    <input id="email1" type="email" class="form-control" name="email" required placeholder ="enter email..">
                    <div class="invalid-feedback">
                    </div>
                    </div>
                </div>

                <div class="row">
                  <div class="form-group col-md-12">
                  <label for="">Password</label>
                  <input id="password" type="password" class="form-control" name="password" required placeholder ="enter password..">
                  <div class="invalid-feedback">
                  </div>
                  </div>
                </div>
              </form>
              <div class="form-group">
                <button type="submit" id="btn1" onclick = "Login()"  style="background-color: #34beb9; border-color: #34beb9;" class="btn btn-primary btn-lg btn-block">
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
                    <label for="frist_name">Agency Name</label>
                    <input id="name" type="text" class="form-control" name="name" autofocus required placeholder ="enter name..">
                  </div>
                  <div class="form-group col-6">
                    <label for="">Address</label>
                    <input id="address" type="text" class="form-control" name="address" required placeholder ="enter address..">
                  </div>
                </div>
                <div class="form-group">
                  <label for="last_name">Email</label>
                  <input id="email2" type="email" class="form-control" name="email" required placeholder ="enter email..">
                  <div class="invalid-feedback">
                  </div>
                </div>

                <div class="row">
                  <div class="form-group col-md-12">
                    <label for="frist_name">Category of Agency</label>
                    <select id = "category" class="form-control custom-select" name="category" required>
                    <?php 
                        foreach ($categories as $category){
                        ?>
                          <option value="<?php echo $category->Category; ?>"><?php echo $category->Category; ?></option>
                        <?php
                        }
                      ?>
                    </select>
                  </div>
                </div>

                <div class="row">
                  <div class="form-group col-6">
                    <label for="password" class="d-block">Password</label>
                    <input id="password1" type="password" class="form-control pwstrength" data-indicator="pwindicator"
                      name="password1" required placeholder ="enter password..">
                    <div id="pwindicator" class="pwindicator">
                      <div class="bar"></div>
                      <div class="label"></div>
                    </div>
                  </div>
                  <div class="form-group col-6">
                    <label for="password2" class="d-block">Confirm</label>
                    <input id="password2" type="password" class="form-control" name="password-confirm" required placeholder ="confirm password..">
                  </div>
                </div>
              </form>

              <div class="form-group">
                <button id = "btn2" onclick = "Register()" style="background-color: #34beb9; border-color: #34beb9;" class="btn btn-primary btn-lg btn-block">
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






































































































































