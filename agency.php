<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<script type ="text/javascript">

 
    
   function deleteAgency(id)
   {
      var ajaxurl = '<?php echo admin_url('admin-ajax.php');?>';
      var data = {
          action: 'processing', 
          type: 'delete',
          id: id, 
          table: 'agency_shifts'
      };

      $.post(ajaxurl, data, function(response) {
        location.reload(true);
        // alert(response);
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
   function changeState(id, status){
    var ajaxurl = '<?php echo admin_url('admin-ajax.php');?>';
 
    var data = {
          action: 'approval',
          type: 'approve_agency',
          id: id,
          status: status,
          table: 'agency_shifts'
      };

      $.post(ajaxurl, data, function(response) {
        location.reload(true);
      }); 
   }

</script>

<div class = "frame" style = "width : 95%; margin auto; border-radius: 20px;">
  <div class = "card-header" style = "margin-top : 20px; border-top-left-radius: 20px; border-top-right-radius: 20px;">
      <h4 style = "margin-top : 10px;"><b>Agency shifts</b></h4>
  </div>
 
  <div style = "margin-left : 5px; margin-right : 5px;">
    <div class = "card-body table-responsive" style = "margin-top : 20px padding 10px;">
        <table class="table table-striped" border = "0" style = "overflow-x: hidden;">
            <tr class = "header">
                <td class = "text"><b>Id</b></td>
                <td class = "text"><b>Email</b></td>
                <td class = "text"style = "min-width: 200px;"><b>Service</b></td>
                <td class = "text"style = "min-width: 200px;"><b>Starting date</b></td>
                <td class = "text"style = "min-width: 200px;"><b>Shift</b></td>
                <td class = "text" colspan ="3"><b>Actions</b></td>
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
                        <h4 class="modal-title">Delete Shift</h4>
                      </div>
                      <div class="modal-body">
                        <p>Are sure you want to delete this shift?</p>
                        <button class="button" style = "width: 100%;" onclick ="deleteAgency(<?php echo $agency->Id; ?>)">Delete</button>
                      </div>                      
                    </div>
                  </div>
                </div>

                <div id="<?php echo $agency->Id."approve"; ?>" class="modal fade" role="dialog">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Message</h4>
                      </div>

                        <div class="input">
                          <div class="form-group col-md-12">
                            <label>Condition name</label>
                            <p class="font-weight-normal">You have approved shift from <?php echo $agency->Email; ?></p>
                          </div>                      
                      <div class="modal-footer">
                        <button type="button" class="button" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>

                <tr>
                  <td class = "data"><?php echo $i; ?></td>
                  <td class = "data"><?php echo $agency->Email; ?></td>
                  <td class = "data"><?php echo $agency->Services; ?></td>
                  <td class = "data"><?php echo $agency->Start; ?></td>
                  <td class = "data"><?php echo $agency->Shift; ?></td>
                  <?php   
                 if($agency->approved == '5'){
                 ?>
                  <td class = "action">
                      <button type = "button" class = "btn btn-success"  onclick ='changeState("<?php echo $agency->Id;?>","approve")'>Approve</button>
                  </td>

                  <td class = "action">
                      <button type = "button" class = "btn btn-secondary"  onclick ='changeState(<?php echo $agency->Id; ?>,"reject")'>Reject</button>
                  </td>
              <?php }else if($agency->approved == '0'){ ?>
              <td>
                <button type="button" class="btn btn-outline-danger">Rejected.</button>
                
                </td> 
              
              <?php } else { ?>
              <td>
              <button type="button" class="btn btn-outline-success">Already approved.</button>
                </td> 
                <?php } ?>
                  <td>
                      <button type = "button" class = "btn btn-danger" data-toggle = "modal" data-target = "#<?php echo $agency->Id."delete"; ?>" data-backdrop = "true">Delete</button>
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


