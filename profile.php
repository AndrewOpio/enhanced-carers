<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>


<?php

    $page = get_page_by_path("agency-account");
    $id = $page->ID;
    $perma = get_permalink($id);
    
    if(!$_SESSION['email']){
        wp_redirect($perma);
    }

    global $wpdb; 
    $table_name = $wpdb->prefix."agencies"; 
    $user = $wpdb->get_row("SELECT * FROM $table_name WHERE Email = '$_SESSION[email]'");

    $cat_table = $wpdb->prefix . "categories"; 
    $categories = $wpdb->get_results("SELECT * FROM $cat_table");

    $services_table = $wpdb->prefix . "services"; 
    $services = $wpdb->get_results("SELECT * FROM $services_table");

?>


<script>
   function Save()
   {
      var ajaxurl = '<?php echo admin_url('admin-ajax.php');?>';
      var btn = document.getElementById("btn1");
      btn.innerHTML = "Saving...";

      var name = document.getElementById("name").value;
      var address = document.getElementById("address").value;
      var email = document.getElementById("email").value;
      var init_email = document.getElementById("init_email").value;
      var category = document.getElementById("category").value;
      //var service = document.getElementById("services").value;
      //var password = document.getElementById("password").value;

      if (name != '' && address != '' && email != '' && category != '') {

        var data = {
          action: 'edit',
          name: name,
          address: address,
          email: email,
          category: category,
          init_email: init_email
          //service: service,
          //password: password
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

      } else {
        alert('Please enter all required fields');
        btn.innerHTML = "Save";
      }
   }


   function logout(){
    var ajaxurl = '<?php echo admin_url('admin-ajax.php');?>';
       //alert(id);
      var data = {
          action: 'session',
          type : 'unset'
      };

      $.post(ajaxurl, data, function(response) {
        location.href='<?php echo $perma; ?>';
      }); 
  }

</script>



<div>    
    <div class="row gutters-sm">
    <div class="col-md-4 mb-3">
        <div class="card" >
        <div class="card-body">
            <div class="d-flex flex-column align-items-center text-center">
            <img src="<?php echo plugin_dir_url( __FILE__ ) . '/images/avatar.png'?>" alt="Admin" class="rounded-circle" width="150">
            <div class="mt-3">
                <h4><?php echo $user->Name; ?></h4>
                <p class="text-secondary mb-1" aria-placeholder="full names"></p>
                <p class="text-muted font-size-sm">Partner</p>
                <div class="form-group">
                <button type="submit" id = "btn2" onclick = "logout()" style="background-color: #34beb9; border-color: #34beb9;" class="btn btn-primary btn-lg btn-block">
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
                <h6 class="mb-0"><b>Agency Name:</b></h6>
            </div>
            <div class="col-sm-9 text-secondary">
                <?php echo $user->Name; ?>
            </div>
            </div>
            <hr>
            <div class="row">
            <div class="col-sm-3">
                <h6 class="mb-0"><b>Email:</b></h6>
            </div>
            <div class="col-sm-9 text-secondary">
                <?php echo $user->Email; ?>
            </div>
            </div>
            <hr>
            <div class="row">
            <div class="col-sm-3">
                <h6 class="mb-0"><b>Category:</b></h6>
            </div>
            <div class="col-sm-9 text-secondary">
                <?php echo $user->Category; ?>
            </div>
            </div>
            <hr>
            <div class="row">
            <div class="col-sm-3">
                <h6 class="mb-0"><b>Address:</b></h6>
            </div>
            <div class="col-sm-9 text-secondary">
                <?php echo $user->Address; ?>
            </div>
            </div>                  
            <hr>
            <br/>
            <br/>
            <br/>
            <h4 style="text-align: center;"><b>Edit Profile</b></h4>

            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="name">Agency Name</label>
                    <input id="name" type="name" class="form-control" name="name" required value = "<?php echo $user->Name; ?>">
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-12">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="email" required  value = "<?php echo $user->Email; ?>">
                    <input id="init_email" type="hidden" value = "<?php echo $user->Email; ?>">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="email">Category</label>
                    <select id="category" name="category" class="form-control custom-select" name="category" required>
                            <option selected value="<?php echo $user->Category; ?>"><?php echo $user->Category; ?></option>

                        <?php
                            foreach ($categories as $cat) {
                        ?>
                            <option value="<?php echo $cat->Category; ?>"><?php echo $cat->Category; ?></option>
                        <?php
                            }
                        ?>
                        </select>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="">Address</label>
                    <input id="address" type="text" class="form-control" name="address" required  value = "<?php echo $user->Address; ?>">
                </div>
            </div>
            </form>

            <div class="form-group">
                <button type="submit" id = "btn1" onclick = "Save()" style="background-color: #34beb9; border-color: #34beb9;" class="btn btn-primary btn-lg btn-block">
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































































