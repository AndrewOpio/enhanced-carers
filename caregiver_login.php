<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<?php
//include "exclude.php";

$page = get_page_by_path("caregiver registration");
$id = $page->ID;
$perma = get_permalink($id);

$caregiver_dash = get_page_by_path("caregiver dashboard");
$caregiver_dash_id = $caregiver_dash->ID;
$caregiver_dash_perma = get_permalink($caregiver_dash_id);
 
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
    if(response == 'true'){
      //alert("Logged in");
      location.href='<?php echo $caregiver_dash_perma; ?>';
      butn.innerHTML = "Login";
    }else{
      alert("Wrong email or password");
      butn.innerHTML = "Login";
    }
  });
}
</script>



<div class="row">
<div class="col-md-6" style = "margin: auto;">
  <div class="card">
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
        <div class="form-group">
          <button type="submit" id="btn" class="btn btn-primary btn-lg btn-block" onclick="login_care()">
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






































































































































