
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-center text-sm-left d-block d-sm-inline-block">Copyright © 2022<a href="https://nexdee.com/" target="_blank" class="ml-1">Nexdee</a>. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Designed by: Sparks To Ideas<i class="ti-heart text-danger ml-1"></i></span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- base:js -->
  <script src="<?php echo base_url();?>/admin_assets/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src="<?php echo base_url();?>/admin_assets/vendors/flot/jquery.flot.js"></script>
  <script src="<?php echo base_url();?>/admin_assets/vendors/flot/jquery.flot.resize.js"></script>
  <script src="<?php echo base_url();?>/admin_assets/vendors/chart.js/Chart.min.js"></script>
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="<?php echo base_url();?>/admin_assets/js/off-canvas.js"></script>
  <script src="<?php echo base_url();?>/admin_assets/js/hoverable-collapse.js"></script>
  <script src="<?php echo base_url();?>/admin_assets/js/template.js"></script>
  <script src="<?php echo base_url();?>/admin_assets/js/settings.js"></script>
  <script src="<?php echo base_url();?>/admin_assets/js/todolist.js"></script>
 
  <script src="<?php echo base_url();?>/admin_assets/js/dashboard.js"></script>
  
    <!-- plugin js for this page -->
  <script src="<?php echo base_url();?>/admin_assets/vendors/datatables.net/jquery.dataTables.js"></script>
  <script src="<?php echo base_url();?>/admin_assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
  <!-- End plugin js for this page -->
  <!-- Custom js for this page-->
  <script src="<?php echo base_url();?>/admin_assets/js/data-table.js"></script>
  <!-- End custom js for this page-->
  
    <script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyDNAAErLgm2_3zKxXHtuHriJCBKkeU5KRo&amp;libraries=places'></script>
	  
  <!-- plugin js for this page -->
  <script src="<?php echo base_url();?>/admin_assets/vendors/typeahead.js/typeahead.bundle.min.js"></script>
  <script src="<?php echo base_url();?>/admin_assets/vendors/select2/select2.min.js"></script>
  <!-- End plugin js for this page -->
  <!-- Custom js for this page-->
  <script src="<?php echo base_url();?>/admin_assets/js/file-upload.js"></script>
  <script src="<?php echo base_url();?>/admin_assets/js/iCheck.html"></script>
  <script src="<?php echo base_url();?>/admin_assets/js/typeahead.js"></script>
  <script src="<?php echo base_url();?>/admin_assets/js/select2.js"></script>


  <script src="<?php echo base_url();?>/admin_assets/vendors/summernote/dist/summernote-bs4.min.js"></script>
  <script src="<?php echo base_url();?>/admin_assets/vendors/tinymce/tinymce.min.js"></script>
  <script src="<?php echo base_url();?>/admin_assets/vendors/quill/quill.min.js"></script>
  <script src="<?php echo base_url();?>/admin_assets/vendors/simplemde/simplemde.min.js"></script>
   <script src="<?php echo base_url();?>/admin_assets/js/editorDemo.js"></script>
	

<script type="text/javascript">
$("#sid").change(function() {
    const pro_id = $("#sid").val();
    console.log(pro_id);
    $.ajax({
        method: "POST",
        url: "<?php echo base_url("admin/aj_fetch_data") ?>",
        data: { s_id: pro_id },
        success: function(data) {
            console.log(data);
             console.log(did);
            $("#did").html(data.html);
        }
    });
});

</script>

<script type="text/javascript">
$("#did").change(function() {
    const did = $("#did").val();
    const sid = $("#sid").val();
    console.log(did);
    $.ajax({
        method: "POST",
        url: "<?php echo base_url("admin/color_fetch") ?>",
        data: { s_id: sid,d_id: did, },
        success: function(data) {
            console.log(data);
             console.log(did);
            $("#c_id").html(data.html);
        }
    });
});

</script>

<script type="text/javascript">
jQuery(function() {
  jQuery("#cat_value").change(function() {
    var ids = $(this).val();
    console.log(ids);
    jQuery.ajax({
      url: "<?php echo base_url("admin/get_sub_cat") ?>",
      type: "POST",
      data: {
        "ids": ids
      },
      success: function(data) {
        console.log(data);
		$("#sub_cat_value").html(data.html);
      }
    });
  });
});

</script>
	
 <script>
     // Prepare location info object.
var locationInfo = {
  geo: null,
  country: null,
  state: null,
  city: null,
  postalCode: null,
  street: null,
  streetNumber: null,
  reset: function() {
    this.geo = null;
    this.country = null;
    this.state = null;
    this.city = null;
    this.postalCode = null;
    this.street = null;
    this.streetNumber = null;
  }
};

googleAutocomplete = {
  autocompleteField: function(fieldId) {
    (autocomplete = new google.maps.places.Autocomplete(
      document.getElementById(fieldId)
    )),
      { types: ["geocode"] };
    google.maps.event.addListener(autocomplete, "place_changed", function() {
      // Segment results into usable parts.
      var place = autocomplete.getPlace(),
        address = place.address_components,
        lat = place.geometry.location.lat(),
        lng = place.geometry.location.lng();

      // Reset location object.
      locationInfo.reset();

      // Save the individual address components.
      locationInfo.geo = [lat, lng];
      for (var i = 0; i < address.length; i++) {
        var component = address[i].types[0];
        switch (component) {
          case "country":
            locationInfo.country = address[i]["long_name"];
            break;
          case "administrative_area_level_1":
            locationInfo.state = address[i]["long_name"];
            break;
          case "locality":
            locationInfo.city = address[i]["long_name"];
            break;
          case "postal_code":
            locationInfo.postalCode = address[i]["long_name"];
            break;
          case "route":
            locationInfo.street = address[i]["long_name"];
            break;
          case "street_number":
            locationInfo.streetNumber = address[i]["long_name"];
            break;
          default:
            break;
        }
      }

      // Preview map.
      var src =
          "https://maps.googleapis.com/maps/api/staticmap?key=AIzaSyAILGVlt-SOiL381JT3TQ9dxxoNIUuxrV8&center=" +
          lat +
          "," +
          lng +
          "&zoom=14&size=480x125&maptype=roadmap&sensor=false",
        img = document.createElement("img");

      img.src = src;
      img.className = "absolute top-0 left-0 z-20";
      document.getElementById("js-preview-map").appendChild(img);

      // Preview JSON output.
      document.getElementById("js-preview-json").innerHTML = JSON.stringify(
        locationInfo,
        null,
        4
      );
    });
  }
};

// Attach listener to address input field.
googleAutocomplete.autocompleteField("address");
googleAutocomplete.autocompleteField("citya");
 </script>
  <script>
  $(".extra-fields-customer").click(function () {
  $(".customer_records").clone().appendTo(".customer_records_dynamic");
  $(".customer_records_dynamic .customer_records").addClass("single remove");
  $(".single .extra-fields-customer").remove();
  $(".single").append(
    '<a href="#" class="remove-field btn-remove-customer btn btn-gradient-danger mb-2 mt-3">Remove Fields</a>'
  );
  $(".customer_records_dynamic > .single").attr("class", "remove");

  $(".customer_records_dynamic input").each(function () {
    var count = 0;
    var fieldname = $(this).attr("name");
    $(this).attr("name", fieldname + count);
    count++;
  });
});

$(document).on("click", ".remove-field", function (e) {
  $(this).parent(".remove").remove();
  e.preventDefault();
});

  </script>
    <script>
  $(".extra-fields-color").click(function () {
  $(".color_records").clone().appendTo(".color_records_dynamic");
  $(".color_records_dynamic .color_records").addClass("single remove");
  $(".single .extra-fields-color").remove();
  $(".single").append(
    '<a href="#" class="remove-field btn-remove-color btn btn-gradient-danger mb-2 mt-3">Remove Fields</a>'
  );
  $(".color_records_dynamic > .single").attr("class", "remove");

  $(".color_records_dynamic input").each(function () {
    var count = 0;
    var fieldname = $(this).attr("color_name");
    var fieldname = $(this).attr("color_code");
    var fieldname = $(this).attr("color_images");
	
    $(this).attr("color_name","color_code","color_images", fieldname + count);
    count++;
  });
});

$(document).on("click", ".remove-field", function (e) {
  $(this).parent(".remove").remove();
  e.preventDefault();
});

  </script>
 <script>
    $(document).ready(function(){
      
      var count = 0;

      $(document).on('click', '.add', function(){
		  
        
        var html = '';
        html += '<tr>';
        html += '<td><input type="text" name="variant_name[]" class="form-control " required/></td>';
        html += '<td><input type="text" name="variant_code[]" class="form-control " required/></td>';
        html += '<td><input type="file" name="img_'+count+'" class="form-control " required/></td>';
        html += '<td><button type="button" name="remove" class="btn btn-danger btn-xs remove"><span> <i class="ti-minus"></i></span></button></td>';
        $('tbody').append(html);
		count++;
      });

      $(document).on('click', '.remove', function(){
        $(this).closest('tr').remove();
      });

      

    });
</script> 
</body>



</html>

