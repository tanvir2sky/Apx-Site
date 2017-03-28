<!--main-container-part-->
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?php echo base_url(); ?>dashboard" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="javascript:void(0)" class="current"><?php if(isset($breadcromb)){echo $breadcromb;} ?></a> </div>
    <h1><?php if(isset($header)){echo $header;} ?></h1>
  </div>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
     <?php 
        if(is_array(validation_errors_array())){
          echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>".current(validation_errors_array())."</div>";
        }
        ?>
        <div class="widget-box">
         <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5><?php if(isset($title)){echo $title;} ?></h5>
            </div>
            <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="<?php echo base_url(); ?>add-balance-action">
             <div class="control-group">
                  <label class="control-label">Date Select</label>
                  <div class="controls">
                    <input type="text" name="date" value="<?php echo set_value('date'); ?>" placeholder="Select Date" id="dp" class="datepicker span5">
                  </div>
            </div>
            <div class="control-group">
              <label class="control-label">Account Select</label>
              <div class="controls">
                 <select name="acc_num" class="span5">
                  <?php if(isset($customer) && !empty($customer)){
                        echo '<option value="">-Select Account-</option>';
                        foreach ($customer as $key => $value) {
                          echo '<option '.(isset($_POST['Balance'])?set_select("acc_num",$value->accountNumber, TRUE):'').' value="'.$value->accountNumber.'">'.$value->companyName.'</option>';
                        }
                     }
                    ?>
                  </select>
              </div>
            </div>
            <div class="control-group">
                  <label class="control-label">Post Payment</label>
                  <div class="controls">
                    <input type="text" name="amount" value="<?php echo set_value('amount'); ?>" placeholder="Amount" class="span5">
                  </div>
            </div>
            <div class="control-group">
                  <label class="control-label">Description</label>
                  <div class="controls">
                    <textarea name="descript" class="span5"><?php echo set_value('descript'); ?></textarea>
                  </div>
            </div>
            <div class="form-actions">
              <div class="span3">
                <input type="hidden" name="type" value="Payment">
                <input name="Balance" value="Save" class="btn btn-success pull-right" type="submit">
                <a href="<?php echo base_url(); ?>shipment-ledger"><button class="btn btn-info pull-right"  type="button" style="margin-right:5px;">Go Back</button></a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--end-main-container-part-->