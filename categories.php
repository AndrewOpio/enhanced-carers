<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<script type ="text/javascript">

   function addCategory()
   {
      var name = document.getElementById("name").value;

      if (name == '') {
        alert('Please enter all fields');
      } else {
          var add = document.getElementById("add");
          add.submit(); 
      }
   } 



   function deleteCategory(id)
   {
      var ajaxurl = '<?php echo admin_url('admin-ajax.php');?>';
       //alert(id);
      var data = {
          action: 'processing',
          type: 'delete',
          table : "categories",
          id: id,
      };

      $.post(ajaxurl, data, function(response) {
        location.reload(true);
      }); 
   }


   function updateCategory(id, name)
   {
      var ajaxurl = '<?php echo admin_url('admin-ajax.php');?>';
      var name = document.getElementById(name).value;
      
      if (name == '') {
         alert('Please enter all fields');
      } else {
        var data = {
            action: 'processing',
            type: 'update',
            id: id,
            name: name,
            table: "categories"
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
        <h4 class="modal-title">Add New Category</h4>
      </div>

      <form method="POST" id = "add">
        <div class="input">
          <div class="form-group col-md-12">
            <label>Category name</label>
            <input type="text" class="form-control" id = "name" name = "name" placeholder = "category name..">
          </div>
          <input type="hidden" name = "add" value = "add">
        </div>
      </form>

      <div class="modal-footer">
        <button type="button" class="button" onclick ="addCategory()">Save</button>
        <button type="button" class="button" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



<div class = "card">
  <div class = "card-header" style = "border-top-left-radius: 20px; border-top-right-radius: 20px;">
      <h5><b>Categories of Agencies/Partners </b></h5>
  </div>

  <div>
    <div class = "card-body table-responsive">
        <table class="table table-striped" border = "0">
            <tr class = "header">
                <td class = "text"><b>Id</b></td>
                <td class = "text"><b>Category</b></td>
                <td class = "text" colspan ="2"><b>Actions</b></td>
            </tr>

            <?php
            if($categories){
              $i = 1;
              foreach ($categories as $category) {
            ?>

                <div id="<?php echo $category->Id."delete"; ?>" class="modal fade" role="dialog">
                  <div class="modal-dialog modal-dialog-centered">
                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Delete Record</h4>
                      </div>
                      <div class="modal-body">
                        <p>Are sure you want to delete this record?</p>
                        <button class="button" style = "width: 100%;" onclick ="deleteCategory(<?php echo $category->Id; ?>)">Delete</button>
                      </div>                      
                    </div>
                  </div>
                </div>


                <div id="<?php echo $category->Id."update"; ?>" class="modal fade" role="dialog">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Update Category</h4>
                      </div>

                      <form>
                        <div class="input">
                          <div class="form-group col-md-12">
                            <label>Category name</label>
                            <input type="text" id="<?php echo $category->Id."name"; ?>"  class="form-control" name = "name" placeholder = "shift name.." value ="<?php echo $category->Category; ?>" >
                          </div>
                        </div>
                      </form>
                      
                      <div class="modal-footer">
                        <button type="button" class="button" onclick ='updateCategory(<?php echo $category->Id; ?>, "<?php echo $category->Id."name"; ?>")'>Save</button>
                        <button type="button" class="button" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>

                <tr>
                  <td class = "data"><?php echo $i; ?></td>
                  <td class = "data"><?php echo $category->Category; ?></td>
                  
                  <td class = "action">
                      <button type = "button" class = "button" data-toggle = "modal" data-target = "#<?php echo $category->Id."update"; ?>" data-backdrop = "true">Update</button>
                  </td>

                  <td class = "action">
                      <button type = "button" class = "button" data-toggle = "modal" data-target = "#<?php echo $category->Id."delete"; ?>" data-backdrop = "true">Delete</button>
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
      <button type = "button" style = "margin-left : 5px;" class = "button" data-toggle = "modal" data-target = "#myModal" data-backdrop = "true"><span class = "add">&plus;</span>Add Category</button>
  </div>
</div>


