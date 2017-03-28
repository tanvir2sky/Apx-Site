<!--Footer-part-->
<div class="modal"><!-- Place at bottom of page --></div>
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
<script src="<?php echo base_url(); ?>uisrc/js/ajax/ajax_apx.js"></script> 
</body>
</html>
