<!--main-container-part-->
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?php echo base_url(); ?>dashboard" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="javascript:void(0)" class="current"><?php if(isset($breadcromb)){echo $breadcromb;} ?></a> </div>
  </div>
  <div class="container-fluid">
  <?php if(isset($ship_detail) && $ship_detail!=""){ ?>
    <div class="row-fluid">
      <div class="span4">
      <div id="ship-logo">   
         <img src="<?php echo base_url(); ?>uisrc/img/APX.gif"  alt="AWb" class="img-responsive">
       </div>
     </div>
     <div class="span4">
      <div class="widget-content text-center" id="barcode2">   
          <div class="controls">
          <div class="span11 inputbox"><?php echo $ship_detail->air_way_number; ?></div>
         </div>
      </div>
    </div>
    <div class="span4">
    <div class="widget-content text-center" id="barcode2"> 
          <div class="controls">
          <div class="span11 inputbox"><?php echo $ship_detail->tracking_number; ?></div>
          </div>        
      </div>
    </div>
  </div>
  <div class="row-fluid">
    <div class="span6">
      <div class="widget-box">
        <div class="widget-content">
         <div class="control-group">
            <div class="controls">
        <div class="span5 inputbox"><?php echo $ship_detail->accountNumber; ?></div>
        <div class="span6 inputbox"><?php echo $ship_detail->companyName; ?></div>
        </div>
        </div>
         <div class="control-group">
            <div class="controls">
        <div class="span11 inputbox"><?php echo $ship_detail->shiperName; ?></div>
        </div>
        </div>
         <div class="control-group">
            <div class="controls">
        <div class="span11 inputbox"><?php echo $ship_detail->address1; ?></div>
        </div></div>
         <div class="control-group">
            <div class="controls">
        <div class="span11 inputbox"><?php echo $ship_detail->address2; ?></div>
        </div></div>
          <div class="control-group">
            <div class="controls">
              <div class="span6 inputbox"><?php echo $ship_detail->city; ?></div>
              <div class="span5 inputbox"><?php echo $ship_detail->state; ?></div>
            </div>
          </div>
          <div class="control-group">
            <div class="controls">
             <div class="span6 inputbox"><?php echo $ship_detail->country; ?></div>
              <div class="span5 inputbox"><?php echo $ship_detail->zipCode; ?></div>
            </div>
          </div>
          <div class="control-group">
            <div class="controls">
              <div class="span11 inputbox"><?php echo $ship_detail->phone; ?></div>
            </div>
          </div>
          <div class="control-group">
            <div class="controls">
              <div class="span3 inputbox"><?php echo $ship_detail->userName; ?></div>
              <div class="span3 inputbox"><?php echo $ship_detail->date; ?></div>
              <div class="span3 inputbox"><?php echo $ship_detail->time; ?></div>
              <div class="span2 inputbox"><?php echo $ship_detail->shiper_ref; ?></div>
            </div>
          </div>
          <div class="control-group">
            <div class="controls">
              <div class="span11 inputbox textareabox"><?php echo $ship_detail->shiper_content; ?></div>
            </div>
          </div>
          <div class="control-group">
            <div class="controls">
              <div class="span11 inputbox"><?php echo $ship_detail->shiper_value; ?></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="span6">
      <div class="widget-box">
        <div class="widget-content">
            <div class="control-group">
	            <div class="controls">
	            	<div class="span11 inputbox"><?php echo $ship_detail->receiverCompany; ?></div>
	            </div>
            </div>
           <div class="control-group">
	            <div class="controls">
	            	<div class="span11 inputbox"><?php echo $ship_detail->receiverName; ?></div>
	            </div>
            </div>
            <div class="control-group">
	            <div class="controls">
	            	<div class="span11 inputbox"><?php echo $ship_detail->receiverAddress1; ?></div>
	            </div>
            </div>
            <div class="control-group">
	            <div class="controls">
	            	<div class="span11 inputbox"><?php echo $ship_detail->receiverAddress2; ?></div>
	            </div>
            </div>
            <div class="control-group">
	            <div class="controls">
	            	<div class="span6 inputbox"><?php echo $ship_detail->receiverCity; ?></div>
	            	<div class="span5 inputbox"><?php echo $ship_detail->receiverState; ?></div>
	            </div>
            </div>
             <div class="control-group">
	            <div class="controls">
	                <div class="span3 inputbox"><?php echo $ship_detail->shipPriceList; ?></div>
	            	<div class="span4 inputbox"><?php echo $ship_detail->receiverCountry; ?></div>
	            	<div class="span4 inputbox"><?php echo $ship_detail->receiverZipcode; ?></div>
	            </div>
            </div>
            <div class="control-group">
	            <div class="controls">
	            	<div class="span11 inputbox"><?php echo $ship_detail->receiverPhone; ?></div>
	            </div>
            </div>
           <div class="control-group">
	            <div class="controls">
	            	<div class="span11 inputbox"><?php echo $ship_detail->receiverMobile; ?></div>
	            </div>
            </div>
           <div class="control-group">
	            <div class="controls">
	            	<div class="span3 inputbox"><?php echo $ship_detail->shipType; ?></div>
	            	<div class="span4 inputbox"><?php echo $ship_detail->shipWeight; ?></div>
	            	<div class="span4 inputbox"><?php echo $ship_detail->shipPcs; ?></div>
	            </div>
            </div>
           <div class="control-group">
	            <div class="controls">
	            	<div class="span3 inputbox"><?php echo $ship_detail->shipPayment; ?></div>
	            	<div class="span4 inputbox"><?php echo $ship_detail->shipPaid; ?></div>
	            	<div class="span4 inputbox"><?php echo $ship_detail->shipBalance; ?></div>
	            </div>
            </div>
            <div class="control-group">
	            <div class="controls">
	            	<div class="span11 inputbox textareabox"><?php echo $ship_detail->shipInstruction; ?></div>
	            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php }else{
    	echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>No data Found.</div>';
    	} ?>
  </div>
</div>
</div>
<!--end-main-container-part-->