<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<script type ="text/javascript">

   var table= '<?php echo $table_name; ?>';

   function addShift()
   {
      var name = document.getElementById("name").value;
      var desc = document.getElementById("desc").value;

      if (name == '' || desc == '' ) {
         alert('Please enter all fields');
      } else {
        var add = document.getElementById("add");
        add.submit(); 
      }
   } 

   
   function deleteShift(id)
   {
      var ajaxurl = '<?php echo admin_url('admin-ajax.php');?>';
      var data = {
          action: 'processing',
          type: 'delete',
          id: id,
          table: 'shifts'
      };

      $.post(ajaxurl, data, function(response) {
        location.reload(true);
        //alert(response);
      }); 
   }

   function updateShift(id, name, desc)
   {
      var ajaxurl = '<?php echo admin_url('admin-ajax.php');?>';
      var name = document.getElementById(name).value;
      var desc = document.getElementById(desc).value;

      if (name == '' || desc == '' ) {
         alert('Please enter all fields');
      } else {
        var data = {
            action: 'processing',
            type: 'update',
            id: id,
            name: name,
            desc: desc,
            table: 'shifts'
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
        <h4 class="modal-title">Add New Shift</h4>
      </div>

      <form method="POST" id = "add">
        <div class="input">
          <div class="form-group col-md-12">
            <label>Shift name</label>
            <input type="text" class="form-control" id="name" name = "name" placeholder = "shift name..">
          </div>

          <div class="form-group col-md-12">
            <label>Shift description</label>
            <textarea name="desc" id="desc"  rows="3" style = "width: 100%;"></textarea>
          </div>
          <input type="hidden" name = "add" value = "add">
        </div>
      </form>

      <div class="modal-footer">
        <button type="button" class="button" onclick ="addShift()">Save</button>
        <button type="button" class="button" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<div class = "card">
  <div class = "card-header" style = "border-top-left-radius: 20px; border-top-right-radius: 20px;">
      <h5><b>Shifts Categories</b></h5>
  </div>

  <div>
    <div class = "card-body table-responsive">
        <table id = "table" class="table table-striped" border = "0">
            <tr class = "header">
                <td class = "text"><b>Id</b></td>
                <td class = "text"><b>Shifts</b></td>
                <td class = "text"style = "min-width: 200px;"><b>Description</b></td>
                <td class = "text" colspan ="2"><b>Actions</b></td>
            </tr>

            <?php
            if($shifts){
              $i = 1;
              foreach ($shifts as $shift) {
            ?>

                <div id="<?php echo $shift->Id."delete"; ?>" class="modal fade" role="dialog">
                  <div class="modal-dialog modal-dialog-centered">
                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Delete Record</h4>
                      </div>
                      <div class="modal-body">
                        <p>Are sure you want to delete this record?</p>
                        <button class="button" style = "width: 100%;" onclick ="deleteShift(<?php echo $shift->Id; ?>)">Delete</button>
                      </div>                      
                    </div>
                  </div>
                </div>


                <div id="<?php echo $shift->Id."update"; ?>" class="modal fade" role="dialog">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Update Shift</h4>
                      </div>

                      <form>
                        <div class="input">
                          <div class="form-group col-md-12">
                            <label>Shift name</label>
                            <input type="text" id="<?php echo $shift->Id."name"; ?>"  class="form-control" name = "name" placeholder = "shift name.." value ="<?php echo $shift->Shift; ?>" >
                          </div>

                          <div class="form-group col-md-12">
                            <label>Shift description</label>
                            <textarea name="desc" id="<?php echo $shift->Id."desc"; ?>"  rows="3" style = "width: 100%;"><?php echo $shift->Description; ?></textarea>
                          </div>
                        </div>
                      </form>
                      
                      <div class="modal-footer">
                        <button type="button" class="button" onclick ='updateShift(<?php echo $shift->Id; ?>, "<?php echo $shift->Id."name"; ?>", "<?php echo $shift->Id."desc"; ?>")'>Save</button>
                        <button type="button" class="button" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>

                <tr>
                  <td class = "data"><?php echo $i; ?></td>
                  <td class = "data"><?php echo $shift->Shift; ?></td>
                  <td class = "data"><?php echo $shift->Description; ?></td>
                  
                  <td class = "action">
                      <button type = "button" class = "button" data-toggle = "modal" data-target = "#<?php echo $shift->Id."update"; ?>" data-backdrop = "true">Update</button>
                  </td>

                  <td class = "action">
                      <button type = "button" class = "button" data-toggle = "modal" data-target = "#<?php echo $shift->Id."delete"; ?>" data-backdrop = "true">Delete</button>
                  </td>
                </tr>
                
            <?php
                $i++;
              }
            } else {
              ?>
              <tr>
                  <td colspan ="4" style = "text-align: center;">No data to show</td>
              </tr>
              <?php            
            } 
            ?>
        </table>
    </div>
  </div>
  
  <div class = "card-footer" style = "border-bottom-left-radius: 20px; border-bottom-right-radius: 20px;">
      <button type = "button" style = "margin-left : 5px;" class = "button" data-toggle = "modal" data-target = "#myModal" data-backdrop = "true"><span class = "add">&plus;</span>Add Shift</button>
  </div>
</div>
