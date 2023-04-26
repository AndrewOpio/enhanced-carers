<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<?php 
    $login = get_page_by_path("agency-login");
    $id = $login->ID;
    $login_perma = get_permalink($id);

    global $wpdb; 

    $cat_table = $wpdb->prefix . "categories"; 
    $categories = $wpdb->get_results("SELECT * FROM $cat_table");

    $services_table = $wpdb->prefix . "services"; 
    $services = $wpdb->get_results("SELECT * FROM $services_table");


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
      var category = document.getElementById("category").value;
      var password = document.getElementById("password").value;
      var password2 = document.getElementById("password2").value;

      if (password == password2) {
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
              btn.innerHTML = "Register";
              location.href='<?php echo $login_perma; ?>';

            } else {
              alert('An error occurred');
              btn.innerHTML = "Register";
            }
        }); 

      } else {
        alert('Password mismatch');
        btn.innerHTML = "Register";
      }
   }

</script>


<div class="row">
<div class="col-md-8" style = "margin: auto;">
  <div class="card" style = "max-width: 100%;">
    <div class="card-body">
      <form>
        <div class="row">
          <div class="form-group col-md-6">
            <label for="frist_name">Agency Name</label>
            <input id="name" type="text" class="form-control" name="name" autofocus required>
          </div>
          <div class="form-group col-6">
            <label for="email">Address</label>
            <input id="address" type="text" class="form-control" name="address" required>
          </div>
        </div>
        <div class="form-group">
          <label for="last_name">Email</label>
          <input id="email" type="email" class="form-control" name="email" required>
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
</div>













































