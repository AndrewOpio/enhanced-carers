<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<?php
  //include "exclude.php";
  $page = get_page_by_path("agency-registration");
  $id = $page->ID;
  $perma = get_permalink($id);

  $dash = get_page_by_path("dashboard");
  $dash_id = $dash->ID;
  $dash_perma = get_permalink($dash_id);

?>


<script>
   function Login()
   {
      var ajaxurl = '<?php echo admin_url('admin-ajax.php');?>';
      var btn = document.getElementById("btn");
      btn.innerHTML = "Logging in...";
      var email = document.getElementById("email").value;
      var password = document.getElementById("password").value;

        var data = {
          action: 'login',
          email: email,
          password: password
        };

        $.post(ajaxurl, data, function(response) {
            if (response == 'true') {
              btn.innerHTML = "Login";
              location.href='<?php echo $dash_perma; ?>';

            } else {
              alert('Wrong Email or Password');
              btn.innerHTML = "Login";
            }
        }); 
   }

</script>

<div class="row">
<div class="col-md-6" style = "margin: auto;">
  <div class="card">
    <div class="card-body">
      <form>
        <div class="row">
            <div class="form-group col-md-12">
            <label for="email">Email</label>
            <input id="email" type="email" class="form-control" name="email" required placeholder ="enter email..">
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
        <div class="form-group">
          <button type="submit" id="btn" onclick = "Login()" class="btn btn-primary btn-lg btn-block">
            Login
          </button>
        </div>
      </form>
    </div>
    <div class="mb-4 text-muted text-center">
      Dont have an account? <a href="<?php echo $perma;?>">Register</a>
    </div>
  </div>
  </div>
</div>






































































































































