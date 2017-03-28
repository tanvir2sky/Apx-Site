<!--Footer-part-->
<div class="row-fluid">
  <div id="footer" class="span12"> <?php echo date('Y'); ?>&copy; APX | Powered by  <a href="http://smxoft.com">Smxoft Solution</a></div>
</div>
<!--end-Footer-part-->
<script src="<?php echo base_url(); ?>uisrc/js/excanvas.min.js"></script> 
<script src="<?php echo base_url(); ?>uisrc/js/jquery.min.js"></script> 
<script src="<?php echo base_url(); ?>uisrc/js/jquery.ui.custom.js"></script> 
<script src="<?php echo base_url(); ?>uisrc/js/bootstrap.min.js"></script> 
<script src="<?php echo base_url(); ?>uisrc/js/bootstrap-datepicker.js"></script> 
<?php if($this->uri->segment(1)=='dashboard'){ ?>
<script src="<?php echo base_url(); ?>uisrc/js/jquery.flot.min.js"></script> 
<script src="<?php echo base_url(); ?>uisrc/js/jquery.flot.resize.min.js"></script> 
<script src="<?php echo base_url(); ?>uisrc/js/jquery.peity.min.js"></script> 
<script src="<?php echo base_url(); ?>uisrc/js/fullcalendar.min.js"></script>
<?php }?>
<script src="<?php echo base_url(); ?>uisrc/js/matrix.js"></script> 
<?php if($this->uri->segment(1)=='dashboard'){ ?>
<script src="<?php echo base_url(); ?>uisrc/js/matrix.dashboard.js"></script> 
<script src="<?php echo base_url(); ?>uisrc/js/jquery.gritter.min.js"></script> 
<script src="<?php echo base_url(); ?>uisrc/js/matrix.interface.js"></script> 
<script src="<?php echo base_url(); ?>uisrc/js/matrix.chat.js"></script>
<?php }?>
<script src="<?php echo base_url(); ?>uisrc/js/jquery.validate.js"></script> 
<script src="<?php echo base_url(); ?>uisrc/js/matrix.form_validation.js"></script> 
<script src="<?php echo base_url(); ?>uisrc/js/jquery.wizard.js"></script> 
<script src="<?php echo base_url(); ?>uisrc/js/jquery.uniform.js"></script> 
<script src="<?php echo base_url(); ?>uisrc/js/select2.min.js"></script> 
<script src="<?php echo base_url(); ?>uisrc/js/matrix.popover.js"></script> 
<script src="<?php echo base_url(); ?>uisrc/js/jquery.dataTables.min.js"></script> 
<script src="<?php echo base_url(); ?>uisrc/js/matrix.tables.js"></script> 
<?php if($this->uri->segment(1)=='new-shipment' || $this->uri->segment(1)=='edit-shipment' || $this->uri->segment(1)=='add-shipment-action'){?> 
<script src="<?php echo base_url(); ?>uisrc/datetimepicker/src/wickedpicker.js"></script> 
<script src="<?php echo base_url(); ?>uisrc/js/ajax/ajax_shipment.js"></script> 
<script type="text/javascript">
      var options = {
        now: "<?php if(isset($edit_view)){ echo $edit_view->time;}else{ echo date('H-m-i');} ?>",
        showSeconds: true
        };
      $('.timepicker').wickedpicker(options);
</script>
<?php } ?>
<script type="text/javascript">
$(document).ready(function(){
  $('.datepicker').datepicker({
    format: 'yyyy-mm-dd'
  });
});
$(document).ready(function(){
  $('#ship_table').DataTable({
    //serverSide:true,
   /* oLanguage:{
    sProcessing:"<img src='http://www.floridavoterdata.com/assets/frontsrc/img/waiting.gif' width='200' height='200'>"
    },*/
    "bJQueryUI": true,
    "bProcessing": true,
    "oLanguage":{
    "sProcessing":"<img src='<?php echo base_url(); ?>uisrc/img/processing.gif' style='z-index: 1011; position: absolute; padding: 0px; margin: 0px;  top: 150px; left: 40%; text-align: center; color: rgb(0, 0, 0); border: 0px none; cursor: default;' alt='Loading...'>"
     },
    "bServerSide": true,
    "sPaginationType" : "full_numbers",
    "sAjaxSource":"<?php echo base_url(); ?>list-data",
    "sServerMethod": "POST",
     "aaSorting": [[ 1, "asc" ]],
     "aoColumns":[
              { "bSortable": false },
              { "bSortable": true },
              { "bSortable": true},
              { "bSortable": true },
              { "bSortable": true },
              { "bSortable": true },
              { "bSortable": true },
              { "bSortable": true },
              { "bSortable": false },
              { "bSortable": false },
          ] 
  });
  $("#ship_table_info").addClass("span7");
  $('select').select2();
});
  // This function is called from the pop-up menus to transfer to
  // a different page. Ignore if the value returned is a null string:
  function goPage (newURL) {

      // if url is empty, skip the menu dividers and reset the menu selection to default
      if (newURL != "") {

          // if url is "-", it is this page -- reset the menu:
          if (newURL == "-" ) {
            resetMenu();            
          } 
          // else, send page to designated URL            
          else {  
            document.location.href = newURL;
          }
        }
      }
// resets the menu selection upon entry to this page:
function resetMenu() {
 document.gomenu.selector.selectedIndex = 2;
}
</script>
</body>
</html>
