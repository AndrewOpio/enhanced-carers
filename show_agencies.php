<?php
  if ($status == "exists") {
?>
  <script>
      alert('This email already exist');
  </script>
<?php
  }
?>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<script type ="text/javascript">
   function addAgency()
   {

      var name = document.getElementById("name").value;
      var email = document.getElementById("email").value;
      var category = document.getElementById("category").value;
      var address = document.getElementById("address").value;
      var pass1 = document.getElementById("pass1").value;
      var pass2 = document.getElementById("pass2").value;

      if (name == '' || address == '' || email == '' || category == '' || pass1 == '') {
         alert('Please enter all fields');

      } else {
        if (pass1 == pass2) {
          var add = document.getElementById("add");
          add.submit();

        } else {
          alert('Password mismatch');
        }
      }
   } 

   
   function deleteAgency(id)
   {
      var ajaxurl = '<?php echo admin_url('admin-ajax.php');?>';
       //alert(id);
      var data = {
          action: 'processing',
          type: 'delete',
          id: id,
          table: "agencies"
      };

      $.post(ajaxurl, data, function(response) {
        location.reload(true);
      }); 
   }


   function updateAgency(init_email, status, id, name, email, category, address)
   {
      var ajaxurl = '<?php echo admin_url('admin-ajax.php');?>';
      var name = document.getElementById(name).value;
      var email = document.getElementById(email).value;
      var category = document.getElementById(category).value;
      var address = document.getElementById(address).value;
      var status = document.getElementById(status).value;
      var init_email = document.getElementById(init_email).value;
      if (name == '' || address == '' || email == '' || category == '' || status == '') {
         alert('Please enter all fields');

      } else {
        var data = {
            action: 'processing',
            type: 'update',
            id: id,  
            name: name,
            email: email,
            init_email: init_email,
            category:category,
            address: address,
            status: status,
            table: "agencies"
        };

        $.post(ajaxurl, data, function(response) {
          //alert(response);
          if (response == 'exists') {
            alert('This email already exist');
            
          } else {
            location.reload(true);
          }
        }); 
      }
   }

   
  function allowAgency(id, status){
    var ajaxurl = '<?php echo admin_url('admin-ajax.php');?>';

    var data = { 
          action: 'allow_agent',
          id: id,
          status: status
      };

      $.post(ajaxurl, data, function(response) {
        location.reload(true);
      }); 
   }

</script>


<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add New Agency</h4>
      </div>

      <form method="POST" id = "add">
        <div class="input">
          <div class="form-group col-md-12">
            <label>Agency name</label>
            <input type="text" id="name"  class="form-control" name = "name" placeholder = "agency name..">
          </div>

          <div class="form-group col-md-12">
            <label>Email</label>
            <input type="text" id="email"  class="form-control" name = "email" placeholder = "agency email..">
          </div>

          <div class="form-group col-md-12">
            <label>Category</label>
            <select id="category" name="category" class="form-control custom-select" name="category" required>
            <?php
                foreach ($categories as $cat) {
            ?>
                <option value="<?php echo $cat->Category; ?>"><?php echo $cat->Category; ?></option>
            <?php
                }
            ?>
            </select>

          </div>

          <div class="form-group col-md-12">
            <label>Address</label>
            <input type="text" id="address"  class="form-control" name = "address" placeholder = "address..">
          </div>


          <div class="form-group col-md-12">
            <label>Password</label>
            <input type="password" id="pass1"  class="form-control" name = "pass1" placeholder = "password..">
          </div>

          <div class="form-group col-md-12">
            <label>Confirm</label>
            <input type="password" id="pass2"  class="form-control" name = "pass2" placeholder = "confirm password..">
          </div>

          <input type="hidden" name = "add" value = "add">
        </div>
      </form>

      <div class="modal-footer">
        <button type="button" class="button" onclick ="addAgency()">Save</button>
        <button type="button" class="button" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



<div class = "card">
  <div class = "card-header" style = "border-top-left-radius: 20px; border-top-right-radius: 20px;">
      <h5><b>Registered Agencies</b></h5>
  </div>

  <div>
    <div class = "card-body table-responsive">
        <table class="table table-striped" border = "0">
            <tr class = "header">
                <td class = "text"><b>Id</b></td>
                <td class = "text" ><b>Email</b></td>
                <td class = "text"><b>Name</b></td>
                <td class = "text"><b>Address</b></td>
                <td class = "text" ><b>Category</b></td>
                <td class = "text" ><b>Status</b></td>
                <td class = "text" colspan ="2"><b>Actions</b></td>
            </tr>

            <?php
            if($agencies){
              $i = 1;
              foreach ($agencies as $agency) {
            ?>

                <div id="<?php echo $agency->Id."delete"; ?>" class="modal fade" role="dialog">
                  <div class="modal-dialog modal-dialog-centered">
                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Delete Record</h4>
                      </div>
                      <div class="modal-body">
                        <p>Are sure you want to delete this record?</p>
                        <button class="button" style = "width: 100%;" onclick ="deleteAgency(<?php echo $agency->Id; ?>)">Delete</button>
                      </div>                      
                    </div>
                  </div>
                </div>


                <div id="<?php echo $agency->Id."update"; ?>" class="modal fade" role="dialog">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Update Agency</h4>
                      </div>

                      <form>
                        <div class="input">
                          <div class="form-group col-md-12">
                            <label>Agency name</label>
                            <input type="text" id="<?php echo $agency->Id."name"; ?>"  class="form-control" name = "name" placeholder = "agency name.." value ="<?php echo $agency->Name; ?>" >
                          </div>

                          <div class="form-group col-md-12">
                            <label>Email</label>
                            <input type="text" id="<?php echo $agency->Id."email"; ?>"  class="form-control" name = "email" placeholder = "agency email.." value ="<?php echo $agency->Email; ?>" >
                          </div>

                          <input type="hidden" id="<?php echo $agency->Id."init_email"; ?>"  class="form-control" value ="<?php echo $agency->Email; ?>" >

                          <div class="form-group col-md-12">
                            <label>Category</label>
                            <select id="<?php echo $agency->Id."category"; ?>" name="category" class="form-control custom-select" name="category" required>
                                <option selected value="<?php echo $agency->Category; ?>"><?php echo $agency->Category; ?></option>

                            <?php
                                foreach ($categories as $cat) {
                            ?>
                                <option value="<?php echo $cat->Category; ?>"><?php echo $cat->Category; ?></option>
                            <?php
                                }
                            ?>
                            </select>

                          </div>

                          <div class="form-group col-md-12">
                            <label>Status</label>
                            <select id="<?php echo $agency->Id."status"; ?>" name="category" class="form-control custom-select" name="category" required>
                                <option <?php echo $agency->approved == 1? "selected" : ""?> value="1">Approved</option>
                                <option <?php echo $agency->approved == 5? "selected" : ""?> value="5">Pending</option>
                                <option <?php echo $agency->approved == 0? "selected" : ""?> value="0">Rejected</option>
                            </select>

                          </div>

                          <div class="form-group col-md-12">
                            <label>Address</label>
                            <input type="text" id="<?php echo $agency->Id."address"; ?>"  class="form-control" name = "address" placeholder = "address.." value ="<?php echo $agency->Address; ?>" >
                          </div>
                        </div>
                      </form>
                      
                      <div class="modal-footer">
                        <button type="button" class="button" onclick ='updateAgency("<?php echo $agency->Id."init_email"; ?>", "<?php echo $agency->Id."status"; ?>", <?php echo $agency->Id; ?>, "<?php echo $agency->Id."name"; ?>", "<?php echo $agency->Id."email"; ?>", "<?php echo $agency->Id."category"; ?>", "<?php echo $agency->Id."address"; ?>", "<?php echo $agency->Id."password"; ?>")'>Save</button>
                        <button type="button" class="button" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>

                <tr>
                  <td class = "data"><?php echo $i; ?></td>
                  <td class = "data"><?php echo $agency->Email; ?></td>
                  <td class = "text"><?php echo $agency->Name; ?></td>
                  <td class = "text"><?php echo $agency->Address; ?></td>
                  <td class = "text" ><?php echo $agency->Category; ?></td>
                  <?php if($agency->approved == 5) {?>
                    <td class = "action">
                     <span class="badge bg-secondary">Pending</span>
                    </td>
                    <?php } else if($agency->approved == 1) {?>
                    <td class = "action">
                    <span class="badge bg-success">Approved</span>
                       </td>
                    <?php }else{?> 
                        <td class = "action">
                     <span class="badge bg-danger">Rejected</span>
                      <?php } ?> 
                       </td>
                  <td class = "action">
                      <button type = "button" class = "button" data-toggle = "modal" data-target = "#<?php echo $agency->Id."update"; ?>" data-backdrop = "true">Update</button>
                  </td>

                  <td class = "action">
                      <button type = "button" class = "button" data-toggle = "modal" data-target = "#<?php echo $agency->Id."delete"; ?>" data-backdrop = "true">Delete</button>
                  </td>
                </tr>
                
            <?php 
                $i++;
              }
            }else {
            ?>
            <tr>
               <td colspan ="8" style = "text-align: center;">No data to show</td>
            </tr>
           <?php            
            } 
            ?>
        </table>
     </div>
  </div>
  
  <div class = "card-footer" style = "border-bottom-left-radius: 20px; border-bottom-right-radius: 20px;">
      <button type = "button" style = "margin-left : 5px;" class = "button" data-toggle = "modal" data-target = "#myModal" data-backdrop = "true"><span class = "add">&plus;</span>Add Agency</button>
  </div>
</div>











