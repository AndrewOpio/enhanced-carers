<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
<script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>


<?php
    global $wpdb; 
    $table_name = $wpdb->prefix."caregiver_apply"; 

    $caregiver_report = $wpdb->get_results("SELECT * FROM $table_name WHERE approved = 1");
?>
 
<script>
    function CreatePDFfromHTML() {
      var HTML_Width = $(".card").width();
      var HTML_Height = $(".card").height();
      var top_left_margin = 15;
      var PDF_Width = HTML_Width + (top_left_margin * 2);
      var PDF_Height = (PDF_Width * 1.5) + (top_left_margin * 2);
      var canvas_image_width = HTML_Width;
      var canvas_image_height = HTML_Height;

      var totalPDFPages = Math.ceil(HTML_Height / PDF_Height) - 1;

      html2canvas($(".card")[0]).then(function (canvas) {
          var imgData = canvas.toDataURL("image/jpeg", 1.0);
          var pdf = new jsPDF('p', 'pt', [PDF_Width, PDF_Height]);
          pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin, canvas_image_width, canvas_image_height);
          for (var i = 1; i <= totalPDFPages; i++) { 
              pdf.addPage(PDF_Width, PDF_Height);
              pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
          }
          pdf.save("Caregivers.pdf");
         // $(".card").hide();
      });
  }
</script>
 
<div class="card">
    <div class="card-header" style = "border-top-left-radius: 20px; border-top-right-radius: 20px;">
    <h4>Caregiver Report</h4>
    </div>
    <div class="card-body">
        <ul class="list-unstyled">
            <?php
               foreach ($caregiver_report as $caregiver){
            ?>
            <li class="media">
                <img width = "70" height ="70" class="mr-3" src="<?php echo plugin_dir_url( __FILE__ ) . '/images/enhanced_carers.png'?>" alt="Generic placeholder image">
                <div class="media-body">
                    <h5
                     style = "color: green" class="mt-0 mb-1"><?php echo $caregiver->caregiver; ?></h5>
                    <h6><?php echo $caregiver->Shift; ?></h6>
                    <h6><?php echo $caregiver->starting_date; ?></h6>
                </div>
            </li>
            <hr>
            <?php
            }
            ?>
        </ul>
    </div>
</div>
<button class = "button" style = "margin-top: 15px" onclick = "CreatePDFfromHTML()">Download pdf</button>













































































































