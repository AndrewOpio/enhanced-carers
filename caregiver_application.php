<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<script type ="text/javascript">

   var table= '<?php echo $table_name; ?>';

   id
   function deleteAgency(id)
   {
      var ajaxurl = '<?php echo admin_url('admin-ajax.php');?>';
      var data = {
          action: 'shift',
          type: 'delete',
          id: id,
          table: 'caregiver_apply'
      };

      $.post(ajaxurl, data, function(response) {
        location.reload(true);
  
      }); 
   }
 
   function updateShift(id, name, desc)
   {
      var ajaxurl = '<?php echo admin_url('admin-ajax.php');?>';
      var name = document.getElementById(name).value;
      var desc = document.getElementById(desc).value;
 
      var data = {
          action: 'shift',
          type: 'update',
          id: id,
          name: name,
          desc: desc,
          table: 'agencies'
      }; 

      $.post(ajaxurl, data, function(response) {
        location.reload(true);
      }); 
   }
   function changeStatus(id, status){
    var ajaxurl = '<?php echo admin_url('admin-ajax.php');?>';

    var data = {
          action: 'shift',
          type: 'approve',
          id: id,
          status: status,
          table: 'caregiver_apply' 
      };

      $.post(ajaxurl, data, function(response) {
        location.reload(true);
      }); 
   }

</script>

<div class = "frame" style = "width : 95%; margin auto; border-radius: 20px;">
  <div class = "card-header" style = "margin-top : 20px; border-top-left-radius: 20px; border-top-right-radius: 20px;">
      <h4 style = "margin-top : 10px;"><b>Caregivers</b></h4>
  </div>
 
  <div style = "margin-left : 5px; margin-right : 5px;">
    <div class = "card-body table-responsive" style = "margin-top : 20px padding 10px;">
        <table class="table table-striped" border = "0" style = "overflow-x: hidden;">
            <tr class = "header">
                <td class = "text"><b>Id</b></td>
                <td class = "text"><b>Applicant</b></td>
                <td class = "text"style = "min-width: 200px;"><b>Starting date</b></td>
                <td class = "text"style = "min-width: 200px;"><b>Time</b></td>
                <td class = "text"style = "min-width: 200px;"><b>Languages</b></td>
                <td class = "text" colspan ="2"><b>Actions</b></td>
            </tr>

            <?php
            if($caregivers){
              $i = 1;
              foreach ($caregivers as $caregiver) {
            ?>

                <div id="<?php echo $caregiver->id."delete"; ?>" class="modal fade" role="dialog">
                  <div class="modal-dialog modal-dialog-centered">
                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Delete Application</h4>
                      </div>
                      <div class="modal-body">
                        <p>Are sure you want to delete this application?</p>
                        <button class="button" style = "width: 100%;" onclick ="deleteAgency(<?php echo $caregiver->id; ?>)">Delete</button>
                      </div>                      
                    </div>
                  </div>
                </div>

                <div id="<?php echo $caregiver->id."approve"; ?>" class="modal fade" role="dialog">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Message</h4>
                      </div>

                        <div class="input">
                          <div class="form-group col-md-12">
                            <label>Condition name</label>
                            <p class="font-weight-normal">You have approved <?php echo $caregiver->caregiver; ?></p>
                          </div>                      
                      <div class="modal-footer">
                        <button type="button" class="button" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div> 
                </div> 

                <tr>
                  <td class = "data"><?php echo $i; ?></td>
                  <td class = "data"><?php echo $caregiver->caregiver; ?></td>
                  <td class = "data"><?php echo $caregiver->starting_date; ?></td>
                  <td class = "data"><?php echo $caregiver->Time; ?></td>
                  <td class = "data"><?php echo $caregiver->languages; ?></td>
                 <?php  
                 if($caregiver->approved == '5'){
                 ?>
                  <td class = "action">
                      <button type = "button" class = "btn btn-success" data-toggle = "modal" data-target = "#<?php echo $caregiver->id."approve"; ?>" data-backdrop = "true" onclick ='changeStatus("<?php echo $caregiver->id;?>","approve")'>Approve</button>
                  </td>

                  <td class = "action">
                      <button type = "button" class = "btn btn-secondary" data-toggle = "modal" data-target = "#<?php echo $caregiver->id."update"; ?>" data-backdrop = "true" onclick ='changeStatus("<?php echo $caregiver->id;?>","reject")'>Reject</button>
                  </td>
              <?php }else if($caregiver->approved == '0'){ ?>
              <td>
                <button type="button" class="btn btn-outline-danger">Rejected.</button>
                
                </td> 
              
              <?php } else { ?>
              <td>
              <button type="button" class="btn btn-outline-success">Already approved.</button>
                </td> 
                <?php } ?>
                  <td class = "action">
                      <button type = "button" class = "btn btn-danger" data-toggle = "modal" data-target = "#<?php echo $caregiver->id."delete"; ?>" data-backdrop = "true">Delete</button>
                  </td>

                  
                </tr>
                
            <?php
                $i++;
              }
            } 
            ?>
        </table>
     </div>
  </div>
  
</div>


