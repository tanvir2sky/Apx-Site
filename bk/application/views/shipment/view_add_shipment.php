<!--main-container-part-->
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?php echo base_url(); ?>dashboard" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="javascript:void(0)" class="current"><?php if(isset($breadcromb)){echo $breadcromb;} ?></a> </div>
  </div>
  <div class="container-fluid">
   <form action="<?php echo base_url(); ?>add-shipment-action" method="post" class="shipmentfrom">
    <?php 
          if(is_array(validation_errors_array())){
            echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>".current(validation_errors_array())."</div>";
              }
            ?>
    <div class="row-fluid">
      <div class="span4">
      <div id="ship-logo">   
         <img src="<?php echo base_url(); ?>uisrc/img/APX.gif"  alt="AWb" class="img-responsive">
       </div>
     </div>
     <div class="span4">
      <div class="widget-content text-center" id="barcode2">   
          <div class="controls">
            <input type="text" name="airway_bill_number" value="<?php echo set_value('airway_bill_number'); ?>" class="span9"  placeholder="Air Way Bill Number" />
          </div>
      </div>
    </div>
    <div class="span4">
    <div class="widget-content text-center" id="barcode2"> 
          <div class="controls">
            <input type="text" name="track_number" value="<?php echo set_value('track_number'); ?>" class="span9" placeholder="Tracking Number" />
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
             <select name="shiper_code" id="shiper_code" class="span4" required>
                   <option value="ACN">Account Number</option>
                    <?php if(isset($customer)){foreach ($customer as $key => $value) {?>
                    <option <?php if(isset($_POST['add'])){ echo  set_select('shiper_code',$value->accountNumber, TRUE);}?> value="<?php echo $value->accountNumber; ?>"><?php echo $value->accountNumber; ?></option>
                    <?php }} ?>
                  </select>&nbsp;&nbsp;&nbsp;&nbsp;
              <input type="text" id="shiper_company" name="shiper_company" value="<?php echo set_value('shiper_company'); ?>"  class="span7" placeholder="Account Holder Name" />
            </div>
          </div>
          <div class="control-group">
            <div class="controls">
              <input type="text" id="shiper_name" name="shiper_name" value="<?php echo set_value('shiper_name'); ?>" class="span11" placeholder="Shipper Name"/>
            </div>
          </div>
          <div class="control-group">
            <div class="controls">
              <input type="text" id="shiper_address1" name="shiper_address1" value="<?php echo set_value('shiper_address1'); ?>"  class="span11" placeholder="Address Line 1" />
            </div>
          </div>
          <div class="control-group">
            <div class="controls">
              <input type="text" id="shiper_address2" name="shiper_address2" value="<?php echo set_value('shiper_address2'); ?>"  class="span11" placeholder="Address Line 1" />
            </div>
          </div>
          <div class="control-group">
            <div class="controls">
              <input type="text" id="shiper_city" name="shiper_city" value="<?php echo set_value('shiper_city'); ?>" class="span6" placeholder="City Name" />&nbsp;&nbsp;&nbsp;&nbsp;
              <input type="text" id="shiper_state" name="shiper_state" value="<?php echo set_value('shiper_state'); ?>" class="span5" placeholder="State Name"/>
            </div>
          </div>
          <div class="control-group">
            <div class="controls">
              <input type="text" id="shiper_country" name="shiper_country" value="<?php echo set_value('shiper_country'); ?>" class="span6" placeholder="Coutry Name"/>&nbsp;&nbsp;&nbsp;&nbsp;
              <input type="text" id="shiper_zip" name="shiper_zip" value="<?php echo set_value('shiper_zip'); ?>" class="span5" placeholder="Zip Code"/>
            </div>
          </div>
          <div class="control-group">
            <div class="controls">
              <input type="text" id="shiper_phone" name="shiper_phone" value="<?php echo set_value('shiper_phone'); ?>"  class="span11" placeholder="Phone Number" />
            </div>
          </div>
          <div class="control-group">
            <div class="controls">
              <input type="text" id="ship_user" name="ship_user" value="<?php echo set_value('ship_user'); ?>" class="span3" placeholder="User Name" readonly/>&nbsp;&nbsp;&nbsp;&nbsp;
              <input type="text" id="ship_date" name="ship_date" value="<?php echo date('Y-m-d'); ?>" class="span2" placeholder="Date"  readonly/>&nbsp;&nbsp;&nbsp;&nbsp;
              <input type="text" id="ship_time" name="ship_time" value="<?php echo date('H:i:s'); ?>" class="span2" placeholder="Time" readonly/>&nbsp;&nbsp;&nbsp;&nbsp;
              <input type="text" id="shiper_ref" name="shiper_ref" value="<?php echo set_value('shiper_ref'); ?>" class="span3" placeholder="Shiper Reference" />
            </div>
          </div>
          <div class="control-group">
            <div class="controls">
              <textarea class="span11" id="ship_des" name="ship_des" rows="6" placeholder="Shipment Contents (6 line paragraph)"><?php echo set_value('ship_des'); ?></textarea>
            </div>
          </div>
          <div class="control-group">
            <div class="controls">
              <input type="text" id="ship_val" name="ship_val" value="<?php echo set_value('ship_val'); ?>" class="span3" placeholder="Shipment Value" />&nbsp;&nbsp;&nbsp;&nbsp;
              <input type="file" id="ship_sample" name="ship_sample" class="span5"/>
              <span class="span3 pull-right text-success"><br/>Sample Invoice</span>
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
                <input type="text" name="receiver_company" value="<?php echo set_value('receiver_company'); ?>" class="span11" placeholder="Receiver's Company Name" />
              </div>
            </div>
            <div class="control-group">
              <div class="controls">
                <input type="text" name="receiver_name" value="<?php echo set_value('receiver_name'); ?>"  class="span11" placeholder="Receiver's Name"  />
              </div>
            </div>
            <div class="control-group">
              <div class="controls">
                <input type="text" name="receiver_address1" value="<?php echo set_value('receiver_address1'); ?>"  class="span11" placeholder="Address Line 1"  />
              </div>
            </div>
            <div class="control-group">
              <div class="controls">
                <input type="text" name="receiver_address2" value="<?php echo set_value('receiver_address2'); ?>"  class="span11" placeholder="Address Line 2"  />
              </div>
            </div>
            <div class="control-group">
              <div class="controls">
                <input type="text" name="receiver_city" value="<?php echo set_value('receiver_city'); ?>" class="span6" placeholder="City Name" />&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="text" name="receiver_state" value="<?php echo set_value('receiver_state'); ?>" class="span5" placeholder="State Name" />
              </div>
            </div>
            <div class="control-group">
              <div class="controls">
              <select name="ship_service" id="ship_service" class="span3">
                   <option value="Service">Service</option>
                    <?php if(isset($price_list)){foreach ($price_list as $key => $value) {?>
                    <option <?php if(isset($_POST['add'])){ echo  set_select('ship_service',$value->list_id, TRUE); }?> value="<?php echo $value->list_id; ?>"><?php echo $value->listCode; ?></option>
                    <?php }} ?>
                  </select>
                  <select name="receiver_country" id="receiver_country" class="span4">
                   <option value="Country">Country</option>
                    <?php if(isset($country)){foreach ($country as $key => $value) {?>
                    <option  <?php if(isset($_POST['add'])){ echo  set_select('receiver_country',$value->countryCode, TRUE); }?> value="<?php echo $value->countryCode; ?>"><?php echo $value->countryName; ?></option>
                    <?php }} ?>
                  </select>&nbsp;&nbsp;&nbsp;&nbsp;
                   <input type="text" name="receiver_zip" value="<?php echo set_value('receiver_zip'); ?>" class="span4" placeholder="Zip Code"/>
              </div>
            </div>
            <div class="control-group">
              <div class="controls">
                <input type="text" name="receiver_phone" value="<?php echo set_value('receiver_phone'); ?>"  class="span11" placeholder="Phone Number"  />
              </div>
            </div>
            <div class="control-group">
              <div class="controls">
                <input type="text" name="receiver_mobile" value="<?php echo set_value('receiver_mobile'); ?>"  class="span11" placeholder="Mobile Number"  />
              </div>
            </div>
            <div class="control-group">
              <div class="controls">
              <div class="span11 pull-left">
              <select name="ship_type" class="span3">
              <option value="Ship-Type">Ship Type</option>
                <option <?php if(isset($_POST['add'])){ echo  set_select('ship_type','Dox', TRUE); }?> value="Dox">Dox</option>
                <option <?php if(isset($_POST['add'])){ echo  set_select('ship_type','N-Dox', TRUE); }?>  value="N-Dox">N-Dox</option>
              </select>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="text" name="ship_weight" id="ship_weight" value="<?php echo set_value('ship_weight'); ?>" class="span4" placeholder="Weight" />&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="text" name="ship_pcs" id="ship_pcs" value="<?php echo set_value('ship_pcs'); ?>" class="span4" placeholder="PCS" />             
                  </div>
              </div>
            </div>
            <div class="control-group">
              <div class="controls">
                <input type="text" name="total_payment" value="<?php echo set_value('total_payment'); ?>" class="span4" id="total_payment" placeholder="Total Payment" readonly />&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="text" name="total_payed" value="<?php echo set_value('total_payed'); ?>" class="span3" id="total_payed" placeholder="Total Paid" />
                &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="text" name="total_balance" value="<?php echo set_value('total_balance'); ?>" class="span3" id="total_balance" placeholder="Balance" readonly/>
              </div>
            </div>
            <div class="control-group">
            <span id="errorMsg" style="color:red;">&nbsp;</span>
              <div class="controls">
                <textarea class="span11" name="ship_instruction" rows="2" placeholder="Shipment/Service Instruction"><?php echo set_value('ship_instruction'); ?></textarea>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row-fluid">
    <div class="form-actions">
      <div class="control-group">
        <div class="controls">
        <label class="span6"><input id="notes_read" name="notes_read" type="checkbox">Read Internal Notes</label>
        <button type="submit" name="add" class="btn btn-success span2 pull-right">Save</button>
         <button class="btn btn-info pull-right" onclick="history.go(-1);" type="button" style="margin-right:5px;">Go Back</button>
        </div>
      </div>
      </div>
      </div>
      </form>
      <div class="row-fluid" id="internal_notes" style="display: none;">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-refresh"></i> </span>
            <h5>Notes</h5>
          </div>
          <div class="widget-content nopadding updates" style="overflow-y:scroll;max-height:250px;">
            <div class="new-update clearfix"><i class="icon-ok-sign"></i>
              <div class="update-done"><strong>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</strong><span>dolor sit amet, consectetur adipiscing eli</span> </div>
              <div class="update-date"><span class="update-day">20</span>jan</div>
            </div>
            <div class="new-update clearfix"> <i class="icon-gift"></i> <span class="update-notice"> <a href="#" title=""><strong>Congratulation Maruti, Happy Birthday </strong></a> <span>many many happy returns of the day</span> </span> <span class="update-date"><span class="update-day">11</span>jan</span> </div>
            <div class="new-update clearfix"> <i class="icon-move"></i> <span class="update-alert"> <a href="#" title=""><strong>Maruti is a Responsive Admin theme</strong></a> <span>But already everything was solved. It will ...</span> </span> <span class="update-date"><span class="update-day">07</span>Jan</span> </div>
            <div class="new-update clearfix"> <i class="icon-leaf"></i> <span class="update-done"> <a href="#" title=""><strong>Envato approved Maruti Admin template</strong></a> <span>i am very happy to approved by TF</span> </span> <span class="update-date"><span class="update-day">05</span>jan</span> </div>
            <div class="new-update clearfix"> <i class="icon-question-sign"></i> <span class="update-notice"> <a href="#" title=""><strong>I am alwayse here if you have any question</strong></a> <span>we glad that you choose our template</span> </span> <span class="update-date"><span class="update-day">01</span>jan</span> </div>
          </div>
        </div>
      <div class="form-actions">
        <div class="control-group">
          <div class="controls">
            <input type="text"  class="span8" placeholder="Type Internal Note Here"  />
            <button type="submit" class="btn btn-info pull-right">Add Note</button>
          </div>
        </div>
        </div>
      </div>
 
  </div>
</div>
</div>
<!--end-main-container-part-->